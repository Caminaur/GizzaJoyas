<?php
use App\Size;
use App\Category;
use App\Age;
use App\Material;
use App\Gender;


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

// Home

Route::get('/', 'HomeController@index');

// Contacto

Route::get('/contacto', function() {
  return view('contacto');
});

Route::post('/contacto', function(Request $request){
  Mail::send(new ContactMail($request));
  return redirect ('/');
});

// Nosotros

Route::get('/nosotros', function() {
  return view('nosotros');
});
// ->middleware('verified');

// Auth

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/nav', function () {
    return view('probandoNav');
});

// Users

Route::get('/test', function () {
    $size = Size::all();
    $category = Category::all()->first();
    dd($category->sizes);
});

// FAQs

Route::get('/preguntas', 'FaqController@view');

Route::get('/editpreguntas', 'FaqController@editView')->middleware('admin');

Route::put('/editfaq' ,'FaqController@editFaq')->middleware('admin');

Route::post('/faq/addimage' ,'FaqController@addImage')->middleware('admin');

Route::post('/faq/deleteimage' ,'FaqController@deleteImage')->middleware('admin');

Route::post('/deletefaq' ,'FaqController@deleteFaq')->middleware('admin');

Route::post('/createfaq' ,'FaqController@createFaq')->middleware('admin');


// Product


Route::get('/productos', 'ProductController@products');

Route::get('/productos/categoria/{category_name}', 'ProductController@productsByCategory');

Route::get('/productos/material/{material_name}', 'ProductController@productsByMaterial');

Route::get('/productos/age/{age_name}', 'ProductController@productsByAge');

Route::get('/productos/gender/{gender_name}', 'ProductController@productsByGender');

Route::get('/productos/{parametro_de_busqueda}','ProductController@onSale');
// Rutas /onsale /new


Route::get('/addproduct', 'ProductController@new');

Route::post('/addproduct', 'ProductController@store');

Route::get('/producto/{id}', 'ProductController@product');

Route::get('/editproduct/{id}', 'ProductController@edit')->middleware('admin');

Route::put('/editproduct/{id}', 'ProductController@update')->middleware('admin');

Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct')->middleware('admin');

Route::get('/deleteimage/{id}','ProductController@deleteImage')->middleware('admin');

Route::get('/importexcel', 'ProductController@importExcel')->middleware('admin');

Route::post('/updateprices', 'ProductController@updatePrice')->middleware('admin');

// Pagos

Route::post('/checkout', 'PaymentController@index')->name('checkout')->middleware('auth');

// Cateogry

Route::get('/editcategory/{id}','CategoryController@editview')->middleware('admin');

Route::put('/changeCategoryImage','CategoryController@imageUpdate')->middleware('admin');

Route::get('/editcategory', 'CategoryController@categoryselection')->middleware('admin');

Route::post('/deleteCategoryTag','CategoryController@deleteCategoryTag')->middleware('admin');

Route::post('/createtag','CategoryController@createTag')->middleware('admin');

Route::post('/selecttag','CategoryController@addTag')->middleware('admin');

Route::post('/changeName','CategoryController@changeName')->middleware('admin');

Route::get('/addcategory','CategoryController@createCategoryForm')->middleware('admin');

Route::post('/addcategory','CategoryController@createCategory')->middleware('admin');

Route::post('/deletecategory','CategoryController@delete')->middleware('admin');

// Size

Route::put('/editSize','SizeController@edit')->middleware('admin');

Route::post('/deleteSize','SizeController@delete')->middleware('admin');

Route::post('/addsize', 'SizeController@add')->middleware('admin');

// Tags

Route::get('/edittags','TagController@index')->middleware('admin');

Route::put('/edittag','TagController@edit')->middleware('admin');

Route::post('/addTag', 'TagController@store')->middleware('admin');

Route::post('/deletetag','TagController@delete')->middleware('admin');

// Brand

Route::get('/editbrands','BrandController@index')->middleware('admin');

Route::put('/editbrand','BrandController@edit')->middleware('admin');

Route::post('/addbrand','BrandController@store')->middleware('admin');

Route::post('/deletebrand','BrandController@delete')->middleware('admin');

// Colors

Route::get('/editcolors','ColorController@index')->middleware('admin');

Route::put('/editcolor','ColorController@edit')->middleware('admin');

Route::post('/addcolor','ColorController@store')->middleware('admin');

Route::post('/deletecolor','ColorController@delete')->middleware('admin');

// Materials

Route::get('/editmaterials','MaterialController@index')->middleware('admin');

Route::put('/editmaterial','MaterialController@edit')->middleware('admin');

Route::post('/addmaterial','MaterialController@store')->middleware('admin');

Route::post('/deletematerial','MaterialController@delete')->middleware('admin');

// Genders

Route::get('/editgenders','GenderController@index')->middleware('admin');

Route::put('/editgender','GenderController@edit')->middleware('admin');

Route::post('/addgender','GenderController@store')->middleware('admin');

Route::post('/deletegender','GenderController@delete')->middleware('admin');

// Admin & User

Route::get('/controlpanel','UserController@cpanel')->middleware('admin');

Route::get('/favoritos','UserController@favoritos')->middleware('auth');

Route::get('/deletefavorites','UserController@deleteFavourite')->middleware('auth');

Route::get('/addtofavs/{product_id}','UserController@addFav')->middleware('auth');

Route::get('/profile','UserController@indexProfile')->middleware('auth');
Route::get('/editar-perfil','UserController@editForm')->middleware('auth');
Route::put('/editar-perfil','UserController@editProfile')->middleware('auth');
Route::post('/borrar-perfil','UserController@deleteProfile')->middleware('auth');

Route::get('/searchproduct','ProductController@showallproducts');//->middleware('admin');

Route::get('/searchproduct/searchName', 'ProductController@searchProductByName');//->middleware('admin');

Route::get('/searchproduct/searchCategory', 'ProductController@searchProductByCategory');//->middleware('admin');

Route::get('/searchproduct/searchBrand', 'ProductController@searchProductByBrand');//->middleware('admin');

// carts

// Route::get('/cart', function () {
//   return view('cart');
// });
Route::get('/cart','CartController@show')->middleware('auth');

Route::post('/cart','CartController@addToCart')->middleware('auth');

Route::get('/deletecart/{id}','CartController@deleteOneCart')->middleware('auth');

Route::get('/deletecarts','CartController@deleteAllCarts')->middleware('auth');
