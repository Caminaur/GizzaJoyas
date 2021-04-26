<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; // Por el formulario de contacto
use App\Mail\ContactMail; // Por el formulario de contacto
use App\Mail\PurchaseMail; // Por el email de compra realizada que le llega al comprador
use Illuminate\Support\Facades\Mail; // Por el formulario de contacto

class ContactController extends Controller
{
    public function contactForm(Request $req){
        $reglas = [
              'g-recaptcha-response' => 'required'
              ];
    
          $mensajes = [
            "g-recaptcha-response.required" => "Por favor complete el CAPTCHA para enviar el formulario",
          ];

        $this->validate($req, $reglas, $mensajes);
          
        Mail::send(new ContactMail($req));
        
        return redirect ('/');
  }
    
       
}