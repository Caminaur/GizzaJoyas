<?php

// https://www.youtube.com/watch?v=rw48FfNvGz4
// Para cambiar el contenido del email primero ejecutamos php artisan make:notification NombreDelArchivo
// Luego buscamos el archivo ResetPassowrd.php en este caso que estaria en illuminate\auth\notification\PasswordReset.php
// Copiamos el contenido de la clase unicamente y la pegamos aqui debajo de la llave de apertura de la clase, luego editamos los textos a eleccion.
// Luego buscamos el archivo CanResetPassword.php y copiamos el metodo sendPasswordResetNotification(); y lo pegamos al final de todo del modelo User.
// No olvidar colocar la referencia arriba de todo: use App\Notifications\ResetPasswordNotification;
// Para modificar El header o footer del email predeterminado visita resources/views/vendor/notifications/email.blade.php para mas info

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
  /**
   * The password reset token.
   *
   * @var string
   */
  public $token;

  /**
   * The callback that should be used to build the mail message.
   *
   * @var \Closure|null
   */
  public static $toMailCallback;

  /**
   * Create a notification instance.
   *
   * @param  string  $token
   * @return void
   */
  public function __construct($token)
  {
      $this->token = $token;
  }

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
      if (static::$toMailCallback) {
          return call_user_func(static::$toMailCallback, $notifiable, $this->token);
      }

      return (new MailMessage)
          ->subject(Lang::getFromJson('Restablecimiento de clave'))
          ->greeting('Hola ' . $notifiable->name)
          ->line(Lang::getFromJson('Recibes este correo porque se solicitó un restablecimiento de clave para tu cuenta de Gizza Joyas.'))
          ->action(Lang::getFromJson('Restablecer clave'), url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
          ->line(Lang::getFromJson('Este enlace expirará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
          ->line(Lang::getFromJson('Si tu no solicitaste este restablecimiento, no hace falta que realices ninguna acción.'))
          ->salutation('Saludos.');
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
