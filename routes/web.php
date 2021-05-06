<?php
use App\Models\Size;
use App\Models\Category;
use App\Models\Age;
use App\Models\Material;
use App\Models\Product;
use App\Models\Gender;
use Illuminate\Http\Request; // Por el formulario de contacto
use App\Mail\ContactMail; // Por el formulario de contacto
use App\Mail\PurchaseMail; // Por el email de compra realizada que le llega al comprador
use Illuminate\Support\Facades\Mail; // Por el formulario de contacto
use Carbon\Carbon;
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
Route::get('/', function() {
  $categories = Category::all();
  // Nos tiene que traer X cantidad de productos ordenados por fecha
  $nuevos = Product::all()->sortByDesc('created_at')->take(10);

  // Nos tiene que traer X cantidad de productos en oferta aleatoriamente
  $ofertas = Product::where('OnSale','=',1)->inRandomOrder()->limit(10)->get();

  return view('index',compact('categories','ofertas','nuevos'));
});

// Contacto

Route::get('/contacto', function() {
  return view('contacto');
});

Route::post('/contacto', 'ContactController@contactForm');
/*Route::post('/contacto', function(Request $request){
  Mail::send(new ContactMail($request));
  return redirect ('/');
});*/

// Nosotros

Route::get('/nosotros', function() {
  return view('nosotros');
});
// ->middleware('verified');

// Auth

Auth::routes();

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

Route::get('/preguntas', 'App\Http\Controllers\FaqController@view');

Route::get('/editpreguntas', 'App\Http\Controllers\FaqController@editView')->middleware('admin');

Route::put('/editfaq' ,'App\Http\Controllers\FaqController@editFaq')->middleware('admin');

Route::post('/faq/deleteimage' ,'App\Http\Controllers\FaqController@deleteImage')->middleware('admin');

Route::post('/deletefaq' ,'App\Http\Controllers\FaqController@deleteFaq')->middleware('admin');

Route::post('/createfaq' ,'App\Http\Controllers\FaqController@createFaq')->middleware('admin');


// Product


Route::get('/productos', 'App\Http\Controllers\ProductController@products');

Route::get('/productos/categoria/{category_name}', 'App\Http\Controllers\ProductController@productsByCategory');

Route::get('/productos/material/{material_name}', 'App\Http\Controllers\ProductController@productsByMaterial');

Route::get('/productos/age/{age_name}', 'App\Http\Controllers\ProductController@productsByAge');

Route::get('/productos/gender/{gender_name}', 'App\Http\Controllers\ProductController@productsByGender');

Route::get('/productos/{parametro_de_busqueda}','App\Http\Controllers\ProductController@onSale');

// Route::get('/live_search/action','App\Http\Controllers\LiveSearch@search_product'); // ajax buscador

// Route::get('/product/page/{id}', 'App\Http\Controllers\LiveSearch@paginate_search' ); // ajax paginador

// Route::get('/pricecontroller', 'App\Http\Controllers\ProductController@prices' ); // ajax paginador

Route::get('/live_search/add_favourite','App\Http\Controllers\LiveSearch@add_favourite'); // ajax favoritos desde productos

Route::get('/live_search/add_favourite_from_product','App\Http\Controllers\LiveSearch@add_favourite_from_product'); // ajax favoritos desde producto

Route::get('/busqueda/productos','App\Http\Controllers\ProductController@search'); // ajax favoritos desde productos

// Rutas /onsale /new

Route::get('/addproduct', 'App\Http\Controllers\ProductController@new')->middleware('admin');

Route::post('/addproduct', 'App\Http\Controllers\ProductController@store')->middleware('admin');

Route::get('/producto/{id}', 'App\Http\Controllers\ProductController@product');

Route::get('/editproduct/{id}', 'App\Http\Controllers\ProductController@edit')->middleware('admin');

Route::put('/editproduct/{id}', 'App\Http\Controllers\ProductController@update')->middleware('admin');

Route::post('/deleteproduct/{id}', 'App\Http\Controllers\ProductController@deleteproduct')->middleware('admin');

// Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct')->middleware('admin'); // este fue agregado porque sino se rompia el modal

Route::post('/deleteimage/{id}','App\Http\Controllers\ProductController@deleteImage')->middleware('admin');

Route::get('/exportexcel', 'App\Http\Controllers\ProductController@exportExcel')->middleware('admin');

Route::get('/exportexcel-stocks', 'App\Http\Controllers\ProductController@exportExcelStock')->middleware('admin');

Route::post('/importexcel', 'App\Http\Controllers\ProductController@importExcel')->middleware('admin');

Route::post('/importexcel-stocks', 'App\Http\Controllers\ProductController@importExcelStock')->middleware('admin');

Route::post('/updateprices', 'App\Http\Controllers\ProductController@updatePrice')->middleware('admin');


// Pagos

Route::post('/checkout', 'App\Http\Controllers\PaymentController@cartsUpdate')->name('checkoutUpdate')->middleware('auth');

Route::get('/checkout', 'App\Http\Controllers\PaymentController@index')->name('checkout')->middleware('auth');
// No se si es necesario mantener la ruta por get o juntarlo todo en una sola funcion

Route::post('/payments/pay', 'App\Http\Controllers\PaymentController@pay')->name('pay');


// Cateogry

Route::get('/editcategory/{id}','App\Http\Controllers\CategoryController@editview')->middleware('admin');

Route::put('/changeCategoryImage','App\Http\Controllers\CategoryController@imageUpdate')->middleware('admin');

Route::get('/editcategory', 'App\Http\Controllers\CategoryController@categoryselection')->middleware('admin');

Route::post('/deleteCategoryTag','App\Http\Controllers\CategoryController@deleteCategoryTag')->middleware('admin');

Route::post('/createtag','App\Http\Controllers\CategoryController@createTag')->middleware('admin');

Route::post('/selecttag','App\Http\Controllers\CategoryController@addtag')->middleware('admin');

Route::put('/changeName','App\Http\Controllers\CategoryController@changeName')->middleware('admin');

Route::get('/addcategory','App\Http\Controllers\CategoryController@createCategoryForm')->middleware('admin');

Route::post('/addcategory','App\Http\Controllers\CategoryController@createCategory')->middleware('admin');

Route::post('/deletecategory','App\Http\Controllers\CategoryController@delete')->middleware('admin');

// Size

Route::put('/editSize','App\Http\Controllers\SizeController@edit')->middleware('admin');

Route::post('/deleteSize','App\Http\Controllers\SizeController@delete')->middleware('admin');

Route::post('/addsize', 'App\Http\Controllers\SizeController@add')->middleware('admin');

// Tags

Route::get('/edittags','App\Http\Controllers\TagController@index')->middleware('admin');

Route::put('/edittag','App\Http\Controllers\TagController@edit')->middleware('admin');

Route::post('/addTag', 'App\Http\Controllers\TagController@store')->middleware('admin');

Route::post('/deletetag','App\Http\Controllers\TagController@delete')->middleware('admin');

// Brand

Route::get('/editbrands','App\Http\Controllers\BrandController@index')->middleware('admin');

Route::put('/editbrand','App\Http\Controllers\BrandController@edit')->middleware('admin');

Route::post('/addbrand','App\Http\Controllers\BrandController@store')->middleware('admin');

Route::post('/deletebrand','App\Http\Controllers\BrandController@delete')->middleware('admin');

// Colors

Route::get('/editcolors','App\Http\Controllers\ColorController@index')->middleware('admin');

Route::put('/editcolor','App\Http\Controllers\ColorController@edit')->middleware('admin');

Route::post('/addcolor','App\Http\Controllers\ColorController@store')->middleware('admin');

Route::post('/deletecolor','App\Http\Controllers\ColorController@delete')->middleware('admin');

// Materials

Route::get('/editmaterials','App\Http\Controllers\MaterialController@index')->middleware('admin');

Route::put('/editmaterial','App\Http\Controllers\MaterialController@edit')->middleware('admin');

Route::post('/addmaterial','App\Http\Controllers\MaterialController@store')->middleware('admin');

Route::post('/deletematerial','App\Http\Controllers\MaterialController@delete')->middleware('admin');

// Genders

Route::get('/editgenders','App\Http\Controllers\GenderController@index')->middleware('admin');

Route::put('/editgender','App\Http\Controllers\GenderController@edit')->middleware('admin');

Route::post('/addgender','App\Http\Controllers\GenderController@store')->middleware('admin');

Route::post('/deletegender','App\Http\Controllers\GenderController@delete')->middleware('admin');

// Admin

Route::get('/adminpanel','App\Http\Controllers\UserController@cpanel')->middleware('admin');

Route::get('/favoritos','App\Http\Controllers\UserController@favoritos')->middleware('auth');

Route::post('/editshipment','App\Http\Controllers\UserController@editshipment')->middleware('auth');

Route::get('/deletefavorites','App\Http\Controllers\UserController@deleteFavourites');

Route::get('/deletefavourite','App\Http\Controllers\UserController@deleteFavourite');

Route::get('/addtofavs/{product_id}','App\Http\Controllers\UserController@addFav');


// User

Route::get('/profile','App\Http\Controllers\UserController@indexProfile')->middleware('auth');

Route::get('/editar-perfil','App\Http\Controllers\UserController@editForm')->middleware('auth');

Route::put('/editar-perfil','App\Http\Controllers\UserController@editProfile')->middleware('auth');

Route::post('/borrar-perfil','App\Http\Controllers\UserController@deleteProfile')->middleware('auth');

// Search

Route::get('/searchproduct','App\Http\Controllers\ProductController@showallproducts');//->middleware('admin');

Route::get('/searchproduct/searchName', 'App\Http\Controllers\ProductController@searchProductByName');//->middleware('admin');

Route::get('/searchproduct/searchCategory', 'App\Http\Controllers\ProductController@searchProductByCategory');//->middleware('admin');
Route::get('/searchproduct/searchCategoryId', 'App\Http\Controllers\ProductController@searchProductByCategoryId');//->middleware('admin');

Route::get('/searchproduct/searchBrand', 'App\Http\Controllers\ProductController@searchProductByBrand');//->middleware('admin');
Route::get('/searchproduct/searchBrandId', 'App\Http\Controllers\ProductController@searchProductByBrandId');//->middleware('admin');

// carts

Route::get('/cart','App\Http\Controllers\CartController@show')->middleware('auth');

Route::post('/cart','App\Http\Controllers\CartController@addToCart')->middleware('auth');

Route::get('/deletecart/{id}','App\Http\Controllers\CartController@deleteOneCart')->middleware('auth');

Route::get('/deletecarts','App\Http\Controllers\CartController@deleteAllCarts')->middleware('auth');
