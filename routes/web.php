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

Route::get('/productos', function() {
  return view('productos');
});

Route::get('/asd', function() {
  return view('asd');
});

Route::post('/contacto', function(Request $request){
  Mail::send(new ContactMail($request));
  return redirect ('/');
});

Route::get('/test', function () {
    $size = Size::all();
    $category = Category::all()->first();
    dd($category->sizes);
});

Auth::routes(['verify' => true]);

// Product
Route::get('/addproduct', 'ProductController@index');
Route::post('/addproduct', 'ProductController@store');
Route::get('/deleteimage/{id}','ProductController@deleteImage');
Route::post('/deleteproduct/{id}', 'ProductController@delete');
Route::get('/editproduct/{id}', 'ProductController@editView');
Route::put('/editproduct', 'ProductController@update');

// Cateogry
Route::get('/editcategory/{id}','CategoryController@editview');
Route::put('/changeCategoryImage','CategoryController@imageUpdate');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/editcategory', 'CategoryController@categoryselection')->name('home');
Route::post('/deleteCategoryTag','CategoryController@deleteCategoryTag');
Route::post('/createtag','CategoryController@createTag');
Route::post('/selecttag','CategoryController@addTag');
Route::post('/changeName','CategoryController@changeName');

// Size
Route::put('/editSize','SizeController@edit');
Route::post('/deleteSize','SizeController@delete');
Route::post('/addsize', 'SizeController@add');

// Tags
Route::get('/edittags','TagController@index');
Route::put('/edittag','TagController@edit');
Route::post('/addTag', 'TagController@store');
Route::post('/deletetag','TagController@delete');

// Brand
Route::get('/editbrands','BrandController@index');
Route::put('/editbrand','BrandController@edit');
Route::post('/addbrand','BrandController@store');
Route::post('/deletebrand','BrandController@delete');

// Colors
Route::get('/editcolors','ColorController@index');
Route::put('/editcolor','ColorController@edit');
Route::post('/addcolor','ColorController@store');
Route::post('/deletecolor','ColorController@delete');

// Materials
Route::get('/editmaterials','MaterialController@index');
Route::put('/editmaterial','MaterialController@edit');
Route::post('/addmaterial','MaterialController@store');
Route::post('/deletematerial','MaterialController@delete');

// Admin
Route::get('/controlpanel','UserController@cpanel');

Route::get('/searchproduct','ProductController@showallproducts');//->middleware('admin');
Route::get('/searchproduct/searchName', 'ProductController@searchProductByName');//->middleware('admin');
Route::get('/searchproduct/searchCategory', 'ProductController@searchProductByCategory');//->middleware('admin');
Route::get('/searchproduct/searchBrand', 'ProductController@searchProductByBrand');//->middleware('admin');

Route::get('/nav', function () {
    return view('probandoNav');
});
