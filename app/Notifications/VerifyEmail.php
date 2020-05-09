<?php

// https://www.youtube.com/watch?v=rw48FfNvGz4
// Para cambiar el contenido del email primero ejecutamos php artisan make:notification NombreDelArchivo
// Luego buscamos el archivo VerifyEmail.php en este caso que estaria en illuminate\auth\notification\VerifyEmail.php
// Copiamos el contenido de la clase unicamente y la pegamos aqui debajo de la llave de apertura de la clase, luego editamos los textos a eleccion.
// Luego buscamos el archivo MustVerifyEmail.php y copiamos el metodo sendEmailVerificationNotification(); y lo pegamos al final de todo del modelo User.
// No olvidar colocar las referencias arriba de todo: copiar los use del archivo original de VerifyEmail.php
// Para modificar El header o footer del email predeterminado visita resources/views/vendor/notifications/email.blade.php para mas info


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;

class VerifyEmail extends Notification
{

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Activación de cuenta'))
            ->greeting('Hola ' . $notifiable->name)
            ->line(Lang::getFromJson('Por favor haz click en el boton para activar tu cuenta.'))
            ->action(Lang::getFromJson('Activar cuenta'), $verificationUrl)
            ->line(Lang::getFromJson('Si tu no creaste la cuenta, ignora este correo.'))
            ->salutation('Saludos.');
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
