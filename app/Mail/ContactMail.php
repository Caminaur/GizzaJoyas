<?php

// Este es el email que le llega al dueño de la web cuando rellenan su formulario de contacto

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
      $this->email = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Email de contacto Gizza Joyas')
                  ->from($this->email->email, $this->email->name)
                  ->to('info@gizzajoyas.com')
                  ->view('email.contactmail');
    }
}
