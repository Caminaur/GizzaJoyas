<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Cart;
use App\PaymentPlatform;
use App\User;
use App\Image;
use App\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Resolvers\PaymentPlatformResolver;
use App\Traits\ReusableFunctions;

class PaymentController extends Controller
{

  use ReusableFunctions;

  protected $paymentPlatformResolver;

  public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
  {
      $this->middleware('auth');

      $this->paymentPlatformResolver = $paymentPlatformResolver;
  }


  // Lo que recibimos al entrar por GET a la vista Checkout.blade
  public function index(Request $request)
    {

        // Se usa para enviar info de compra via whatsapp
        $carts = Cart::where('user_id','=',Auth::user()->id)->get();

        $shipment = Shipment::first()->value;

        // Esta funcion obtiene el precio del total de los productos que tiene el usuario en el carrito,
        // teniendo en cuenta el descuento (si tiene). La utilizamos por seguridad para que no haya modificaciones del usuario
        $total = PaymentController::getRealPrice();

        $paymentPlatforms = PaymentPlatform::all();

        return view('checkout')->with([
          'paymentPlatforms' => $paymentPlatforms,
          'total' => $total,
          'carts' => $carts,
          'shipment' => $shipment
        ]);

    }

  public function pay(Request $request)
    {

      $rules = [
          // 'value' => ['required', 'numeric', 'min:5'],
          'payment_platform' => ['required', 'exists:payment_platforms,id'],
          'installments' => ['required', 'numeric', 'min:1']
          // 'currency' => ['required', 'exists:currencies,iso'],
      ];

        $request->validate($rules);

        $paymentPlatform = $this->paymentPlatformResolver
            ->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);

        return $paymentPlatform->handlePayment($request);
    }

    public function approval()
    {
        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }

        return redirect()
            ->route('checkout')
            ->withErrors('We cannot retrieve your payment platform. Try again, plase.');
    }

    public function cancelled()
    {
        return redirect()
            ->route('checkout')
            ->withErrors('You cancelled the payment');
    }

    public function compra()
    {
      $carts = Cart::where('user_id', '=', Auth::user()->id)->get();

      return view('compra', compact('carts'));
    }


}
