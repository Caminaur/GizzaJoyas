<?php
use App\Size;
use App\Category;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Auth::routes();

// GET      | login                    | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
// POST     | login                    | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
// POST     | logout                   | App\Http\Controllers\Auth\LoginController@logout                       | web          |
// POST     | password/email           | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
// POST     | password/reset           | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
// GET      | password/reset           | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
// GET      | password/reset/{token}   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
// POST     | register                 | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
// GET      | register                 | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |

*/

Route::get('/', function () {
    return view('index');
});

Route::get('/contacto', function() {
  return view('contacto');
});

Route::get('/nosotros', function() {
  return view('nosotros');
})->middleware('verified');

Route::post('/contacto', function(Request $request){
  Mail::send(new ContactMail($request));
  return redirect ('/');
});

Route::get('/test', function () {
    $size = Size::all();
    $category = Category::all()[3];
    dd(empty($category->sizes[0]));
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/nav', function () {
    return view('probandoNav');
});
