<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

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
}
