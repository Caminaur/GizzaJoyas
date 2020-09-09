<?php

// Este es el email que se le envia al cliente que compra con el detalle de su compra.

namespace App\Mail;

use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Image;
use App\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $purchases;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request,$payment)
    {
        $this->purchases = $request;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
      $payment = $this->payment;
      $shipment = Shipment::first()->value;
      return $this->subject('Compra realizada iL Nato tienda online')
                    ->from('info@gizzaJoyas.com','iL Nato tienda online') // Lo envia il nato
                    ->to($this->purchases->email) // Lo recibe el comprador direccion $this->purchases->email
                    ->bcc('taten210@gmail.com')
                    ->view('email.purchasemail', compact('carts','payment', 'shipment'));
    }
}