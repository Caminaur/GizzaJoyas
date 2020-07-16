<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Cart;
use App\PaymentPlatform;
use App\User;
use App\Image;
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

  public function cartsUpdate(Request $req){
    dd($req->all());
    // vamos a tener que actualizar los carts antes de continuar con el checkout
    foreach ($req->producto as $arrayCart) {
      $cart = Cart::find(intval($arrayCart['cart_id']));
      // actualizamos la cantidad pedida de cada producto en caso de que esta haya cambiado
      $cart->quantity = $arrayCart['cart_quantity'];
      // lo guardamos
      $cart->save();
    }
    return redirect('checkout');
  }
  // Lo que recibimos al entrar por GET a la vista Checkout.blade
  public function index(Request $req)
    {
        // Traemos los carritos
        $carts = Cart::where('user_id','=',Auth::user()->id)->get();

        // Esta funcion obtiene el precio del total de los productos que tiene el usuario en el carrito,
        // teniendo en cuenta el descuento (si tiene). La utilizamos por seguridad para que no haya modificaciones del usuario
        $total = getTotalPrice($carts);

        $paymentPlatforms = PaymentPlatform::all();

        return view('checkout')->with([
          'paymentPlatforms' => $paymentPlatforms,
          'total' => $total,
          'carts' => $carts,
        ]);

    }

  public function pay(Request $request)
    {
      dd($request->all());
      $rules = [
          // 'payment_platform' => ['required', 'exists:payment_platforms,id'],
          'installments' => ['required', 'numeric', 'min:1']
      ];

        $request->validate($rules);

        $paymentPlatform = $this->paymentPlatformResolver
            ->resolveService($request->payment_platform);

        dd($paymentPlatform);

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
