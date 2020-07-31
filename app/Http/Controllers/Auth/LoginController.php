<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Redirect; // Para poder redirigir a la pagina anterior al desloguear https://laracasts.com/discuss/channels/general-discussion/class-apphttpcontrollersredirect-not-found-1

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      session(['url.intended' => url()->previous()]); // Agregue estas dos lineas (38 y 39) para que al loguear me redirija a la ruta anterior https://stackoverflow.com/questions/15389833/laravel-redirect-back-to-original-destination-after-login
      $this->redirectTo = session()->get('url.intended');
      $this->middleware('guest')->except('logout');
    }

    // Para que nos redirija a la pagina anterior dsp de loguearnos tuve que pisar este metodo https://stackoverflow.com/questions/42326430/how-to-redirect-to-previous-page-after-successful-register-in-laravel
    protected function redirectTo()
    {
    return url()->previous();
    }

    // Para poder redirigir a la pagina anterior al desloguear https://stackoverflow.com/questions/43585416/how-to-logout-and-redirect-to-login-page-using-laravel-5-4/43586975
    public function logout(Request $request)
    {
    $this->guard()->logout();

    $request->session()->invalidate();

    return $this->loggedOut($request) ?: \Redirect::back();
    }

    // Una vez logueado si vamos a /login nos llevaba a /home, para cambiar esto hay que ir al middleware redirectIfAuthenticated https://laravel.io/forum/01-02-2017-logincontroller-keeps-redirecting-to-home-on-existing-session


}
