<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ConsumesExternalServices;
use App\Services\CurrencyConversionService;
use App\Cart;
use App\Product;
use App\Stock;
use App\Size;
use App\Shipment;
use App\Mail\SoldMail; // Por email con detalle de venta que se le envia al vendedor
use App\Mail\PurchaseMail; // Por el email de compra realizada que le llega al comprador
use Illuminate\Support\Facades\Mail; // Por el formulario de contacto
use App\Traits\ReusableFunctions;

class MercadoPagoService
{
    use ConsumesExternalServices;
    use ReusableFunctions;

    protected $baseUri;

    protected $key;

    protected $secret;

    protected $baseCurrency;

    protected $converter;

    public function __construct(CurrencyConversionService $converter)
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->key = config('services.mercadopago.key');
        $this->secret = config('services.mercadopago.secret');
        $this->baseCurrency = config('services.mercadopago.base_currency');

        $this->converter = $converter;
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
      $queryParams['access_token'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
      return $this->secret;
    }

    public function handlePayment(Request $request)
    {
        // Chequeamos que haya productos en el carrito
        $carts = Cart::where('user_id', '=', Auth::user()->id)->get();

        if (count($carts)<1) {
          return redirect()
              ->route('checkout')
              ->withErrors('Tu carrito se encuentra vacio, no puedes realizar una compra');
        }

        $request->validate([
          'card_network' => 'required',
          'envio' => 'required',
          'card_token' => 'required',
          'email' => 'required',
          'installments' => 'required',
          'address' => 'required_if:envio,true',
          'zipcode' => 'required_if:envio,true'
        ]);

        // Para protegernos en caso de edicion del total
        if ($request->envio == "true") {
          $totalSinInteres = intval($request->amount) + intval($request->shipment);
        } else {
          $totalSinInteres = intval($request->amount);
        }

        $installments = intval($request->installments);

        $payment = $this->createPayment(
            $totalSinInteres, // Valor total con descuentos incluidos ( y envio y cuotas en caso de existir)
            $request->currency,
            $request->card_network,
            $request->card_token,
            $request->email,
            $installments
        );

        if ($payment->status === "approved") {

            $name = Auth::user()->name; // $payment->payer->first_name;
            $amount = number_format($payment->transaction_details->total_paid_amount, 2, ',', '.');
            // $currency = strtoupper($payment->currency_id);
            // $originalAmount = $request->value;
            // $originalCurrency = strtoupper($request->currency);

              // Enviar los 2 emails


                                      Mail::send(new PurchaseMail($request,$payment));
                                      Mail::send(new SoldMail($request,$payment));



              // Restar del stock
              $this->restarStock();
            if ($payment->installments>1) {
              return redirect()
                  ->route('checkout')
                  // ->withSuccess(['payment' => "Gracias {$name}. Tu pago de $ {$amount} fue aprobado. Se abonará en {$payment->installments} cuotas de $ {$payment->transaction_details->installment_amount}. Revisa tu casilla de email {$request->email}"]);
                  ->withSuccess(['payment' => "Gracias por tu compra {$name}. Revisa tu casilla de email {$request->email} para ver los detalles"]);
            }
            else {
              return redirect()
                  ->route('checkout')
                  // ->withSuccess(['payment' => "Gracias {$name}. Recibimos tu pago de $ {$amount} correctamente. Revisa tu casilla de email {$request->email}"]); // dejar espacio entre el signo $ y la variable
                  ->withSuccess(['payment' => "Gracias por tu compra {$name}. Revisa tu casilla de email {$request->email} para ver los detalles"]); // dejar espacio entre el signo $ y la variable
            }

        }

        return redirect()
            ->route('checkout')
            ->withErrors('No pudimos completar tu pago. Por favor, intente nuevamente');
    }

    public function handleApproval()
    {
        //
    }

    public function createPayment($value, $currency, $cardNetwork, $cardToken, $email, $installments = 1)//tiene currency
    {
        return $this->makeRequest(
            'POST',
            '/v1/payments',
            [],
            [
                'payer' => [
                    'email' => $email,
                ],
                'binary_mode' => true,
                'transaction_amount' => round($value), //round($value * $this->resolveFactor($currency))
                'payment_method_id' => $cardNetwork,
                'token' => $cardToken,
                'installments' => $installments,
                'statement_descriptor' => config('app.name'),
            ],
            [],
            $isJsonRequest = true
        );
    }

    public function resolveFactor($currency) // currency es la moneda que vamos a pasarle y se va a convertir en la predeterminada de MP
    {
      // Desde que moneda queremos convertir
        return $this->converter->convertCurrency($currency, $this->baseCurrency); // en baseCurrency nosotros establecimos (services.php) la moneda de mercadopago
    }

    // Al comprar, se descuenta la cantidad comprada del stock del producto/s comprado/s
    public function restarStock(){
      $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
      // El foreach recorre el array de ids
      foreach ($carts as $cart) {
        // Obtengo el valor del talle y lo guardo en una variable (Elejido por la persona M S L XL)
        $size = Size::find($cart->size_id);
        // Obtengo su objeto de tipo stock y lo guardo en una variable
        $stock = Stock::where('size_id','=',$size->id)
                      ->where('product_id','=',$cart->product_id)->get()->first();
        // Le restamos al stock de la talla elejida, la cantidad de objetos comprados
        $stock->quantity = $stock->quantity - $cart->quantity;
        // guardamos los cambios realizados en el stock
        $stock->save();
        // Por cada id, trae un carrito y lo elimina
        $cart->delete();
      }
      return redirect('/cart');
    }

}
