<?php

// Este es el email que se le envia al dueño de la tienda con el detalle de una venta

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

class SoldMail extends Mailable
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
      return $this->subject('Venta Realizada Gizza Joyas')
                  ->from($this->purchases->email, Auth::user()->name) // Lo envia el comprador
                  ->to('info@gizzajoyas.com') // Lo recibe gizza
                  // ->bcc('taten210@gmail.com')
                  ->view('email.soldemail', compact('carts','payment', 'shipment'));
    }
}
