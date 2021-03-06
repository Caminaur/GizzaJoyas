<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Age;
use App\Models\Category;
use App\Models\Category_size;
use App\Models\Category_tag;
use App\Models\Product_tag;
use App\Models\Tag;
use App\Models\Stock;
use App\Models\Material;
use App\Models\Size;
use App\Models\Gender;
use App\Models\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Exports\StocksExport;
use App\Imports\ProductsImport;
use App\Imports\StocksImport;
use App\Traits\ReusableFunctions;
use Carbon\Carbon;

class ProductController extends Controller
{
  use ReusableFunctions;

  // Se muestra un form con los campos vacios para agregar un producto
  public function new(){
    $colors = Color::all();
    $brands = Brand::all();
    $ages = Age::all();
    $categories = Category::all();
    $category_sizes = Category_size::all();
    $category_tags = Category_tag::all();
    $tags = Tag::all();
    $stocks = Stock::all();
    $materials = Material::all();
    $sizes = Size::all();
    $genders = Gender::All();
    $images = Image::all();

    $vac = compact('colors','brands','ages','category_sizes','category_tags','tags','stocks','materials','sizes','genders','images','categories');

    return view('addProductForm',$vac);
  }
  // Traemos todos los productos con sus categorias
  public function products(){
    $products = Product::paginate(6);
    $categories = Category::all();
    $materials = Material::all();
    $vac = compact('products','categories','materials');
    return view('productos',$vac);
  }
  public function productsByCategory($category_name){
    // En caso de que haya algun espacio
    $category_name = str_replace('_', ' ', $category_name);
    // Buscamos la categoria con ese nombre
    $category = Category::where('name','=',$category_name)->first();
    // Buscamos los productos a partir del id de la categoria encontrada
    $products = Product::where('category_id','=',$category->id)
                       ->paginate(12);
    $materials = Material::all();
    $vac = compact('products','category','materials');
    return view('productos',$vac);
  }
  public function searchProductByCategoryId(Request $req){

    $category = Category::find($req->category_id);
    $categories = Category::All();
    // Buscamos los productos a partir del id de la categoria encontrada
    $products = Product::where('category_id','=',$category->id)
                       ->paginate(12);
    $materials = Material::all();
    $brands = Brand::all();
    $vac = compact('products','category','brands','categories','materials');
    return view('/searchproduct', $vac);
  }
  public function productsByMaterial($material_name){
    $material_name = str_replace('_', ' ', $material_name);
    $material = Material::where('name','=',$material_name)->first();
    $products = Product::where('material_id','=',$material->id)
                       ->paginate(12);
    $searchType = $material->name;
    $vac = compact('products','material','searchType');
    return view('productos',$vac);
  }
  public function search(Request $req){

    $reglas = [
        'search' => 'required|string|min:1|max:50',
        ];

    $mensajes = [
        "search.required" => "Ingrese lo que quiere buscar",
    ];

    $this->validate($req, $reglas, $mensajes);
    $products = Product::where('name','like','%'.$req->search.'%')
        ->orWhere('description','like','%'.$req->search.'%')
        ->paginate(6)
    // Es importante agregar la query para que el paginador se comporte correctamente
        ->withQueryString();
    // Le agregamos el Path
    $products->withPath('/busqueda/productos');

    $categories = Category::all();
    $materials = Material::all();
    $vac = compact('products','materials','categories');

    return view('productos',$vac);
  }
  public function searchProductByBrandId(Request $req){
    $brand = Brand::find($req->brand);
    $products = Product::where('brand_id','=',$brand->id)
                       ->paginate(12);
    $searchType = $brand->name;
    $categories = Category::all();
    $materials = Material::all();
    $brands = Brand::all();
    $vac = compact('products','brand','brands','materials','categories','searchType');
    return view('/searchproduct', $vac);
  }
  public function productsByAge($age_name){
    $age_name = str_replace('_', ' ', $age_name);
    $age = Age::where('name','=',$age_name)->first();
    $products = Product::where('age_id','=',$age->id)
                       ->paginate(12);
    $searchType = $age->name;
    $materials = Material::all();
    $vac = compact('products','age','searchType','materials');
    return view('productos',$vac);
  }
  public function productsByGender($gender_name){
    $gender_name = str_replace('_', ' ', $gender_name);
    $gender = Gender::where('name','=',$gender_name)->first();
    $products = Product::where('gender_id','=',$gender->id)
                       ->paginate(12);
    $searchType = $gender->name;
    $vac = compact('products','gender','searchType');
    return view('productos',$vac);
  }
  public function onSale($parametro_de_busqueda){
    if ($parametro_de_busqueda=="ofertas") {
      $products = Product::where('onSale','=',1)
      ->paginate(12);
      $searchType = 'Ofertas';
    }
    if ($parametro_de_busqueda=="nuevos") {
      // https://www.youtube.com/watch?v=1rgM4JH2vEo
      $products = Product::whereDate('created_at','>',now()->subDays(20))
      ->paginate(12);
      $searchType = 'Lo nuevo';
    }
    $vac = compact('products','searchType');
    return view('productos',$vac);
  }
  // agrega un producto y te redirige a la lista de productos
  public function store(Request $request){
        $reglas = [
          'title' => 'required|string|min:1|max:50',
          'price' => 'required|integer|min:50|max:150000',
          'model' => "max:255|required|unique:products,model",
          'discount' => 'required_if:onSale,1|integer|max:80|min:10|nullable',
          'gender_id' => 'required',
          'category_id' => 'required',
          'description' => 'max:2500',
          "images" => "required|array|min:1",
          "images.*" => 'image|mimes:jpg,jpeg,png|max:2048',
          ];

          $mensajes = [
            "title.required" => "Ingrese el nombre del producto",
            "price.required" => "Ingrese el precio del producto",
            "model.max" => "El nombre del modelo es muy largo",
            "model.unique" => "El nombre del modelo ya existe",
            "discount.max" => "El maximo descuento es del 80%, sino es un regalo.. :)",
            "discount.min" => "El minimo descuento es del 10%, si no queres descuento desactiva el campo 'En oferta'",
            "discount.integer" => "El numero debe ser entero",
            "discount.required_if" => "Si esta en oferta debe tener un valor de descuento",
            'string' => "El campo :attribute debe ser un texto",
            "price.min" => "El precio debe ser mayor a $50",
            "min" => "El campo :attribute tiene un minimo de :min caracteres",
            "max" => "El campo :attribute tiene un maximo de :max caracteres",
            "images.*.image" => "Debe ser un formato de imagen",
            "mimes" => "Formato de imagen invalido",
            "images.*.max" => 'La imagen es muy pesada',
            "images.min" => "Debes subir al menos una imagen",
            "images.required" => "Sube una imagen del producto",
            "discount.max" => "Debe tener como maximo 80% de descuento",
          ];

          $this->validate($request, $reglas, $mensajes);

          $product = new Product();
          $product->name = $request->title;
          $product->price = $request->price;
          $product->model = $request->model;
          $product->onSale = $request->onSale;
          if ($request->onSale==1) {
            $product->discount = $request->discount;
          }
          else {
            $product->discount = null;
          }
          $product->description = $request->description;
          $product->gender_id = $request->gender_id;
          $product->age_id = $request->age_id;
          $product->material_id = $request->material_id;
          $product->brand_id = $request->brand_id;

          // Buscamos la categoria seleccionada
          $category = Category::where('id', '=' , $request->category_id)->first()->id;

          // Seteamos la categoria del producto
          $product->category_id = $category;

          // guardo en la base de datos
          $product->save();

          // traigo el producto recien creado para obtener su ID
          $lastProduct = Product::all()->last();
          $productId = $lastProduct->id;

          if (!empty($request['images'])) { // si suben una o mas fotos, entonces comenzamos el proceso de guardado
          // obtengo el array de imagenes

          $images = $request->file('images');
          // traigo las imagenes y recorro el array
          foreach ($images as $image) {
            // guardo cada imagen en storage/public (no en la base de datos)
            $file = $image->store('public');
            // obtengo sus nombres
            $path = basename($file);


            // por cada imagen instancio un objeto de la clase imagen
            $image = new Image;
            // asigno las rutas correspondientes y asigno el id de la imagen que debe ser igual al id del ultimo producto creado
            $image->product_id = $productId;
            $image->path = $path;

            // guardo el objeto imagen instanciado en la base de datos
            $image->save();
          }
        }

        // Traigo el ultimo producto agregado y su id
        $lastProduct = Product::all()->last();

        // Traemos los talles especificos de la categoria seleccionada
        $sizes = $lastProduct->category->sizes;

        // STOCK
        foreach ($sizes as $size) {
          $stock = new Stock;
          // El name corresponde a la cantidad enviada de un talle de esa categoria
          $name = $size->name;
          $stock->product_id = $productId;
          $stock->size_id = $size->id;
          // En caso de que sea talle unico
          if (isset($request->Talle_Unico)) {
            $stock->quantity = $request->Talle_Unico;
          }
          // En caso de que haya varios talles buscamos en la request con los nombres de los talles
          else {
            $stock->quantity= $request->$name;
          }
          $stock->save();
        }

        // Traemos todos los tags correspondientes a la categoria del ultimo producto creado
        $tags = $lastProduct->category->tags;
        // TAGS
        foreach ($tags as $tag) {

          // Creamos la relacion con el producto
          $product_tag = new Product_tag;
          $product_tag->product_id = $productId;
          $product_tag->tag_id = $tag->id;

          // Necesitamos acomodar el nombre del tag a la referencia en la base de datos
          // comprobar la precencia del _ en el tag
          if (strpos($tag->name, '_') == false) {
            // Ya que nombres espaciados en un formulario pasan de "Hola Mundo" a "Hola_Mundo" en la request
            $tagAGuardar = str_replace(' ',"_", $tag->name);
            if (isset($request->$tagAGuardar)) {
              $product_tag->hasTag = 1;
              $product_tag->save();
            }
            else {
              $product_tag->hasTag = 0;
              $product_tag->save();
            }
          }
          else {
            $tagName = $tag->name;
            if (isset($request->$tagName)) {
              $product_tag->hasTag = 1;
              $product_tag->save();
            }
            else {
              $product_tag->hasTag = 0;
              $product_tag->save();
            }
          }
        } // for each tags in DB

          return redirect('/productos')
          ->with('status', 'Producto creado exitosamente!!!')
          ->with('operation', 'success');
      }

  // se muestran los datos del producto elegido
  public function product($id){
        $product = Product::find($id);
        $category = Category::find($product->category->id);
        // En caso de que haya algun espacio
        $category_name = str_replace(' ', '_', $category->name);


        // buscamos productos relacionados

        $productos_relacionados = Product::where('id','!=',$product->id)->where('category_id','=',$product->category_id)->take(12)->get();

        $chunk_1 = $productos_relacionados->chunk(1);

        $cantidad_faltante = 12 - count($chunk_1);

        if ($cantidad_faltante != 0) {
          $productos_relacionados = Product::where('id','!=',$product->id)
                                           ->where('category_id','!=',$product->category_id)
                                           ->where('material_id','=',$product->material_id)
                                           ->orWhere('brand_id','=',$product->material_id)
                                           ->take($cantidad_faltante)
                                           ->get();
        }

        $chunk_2 = $productos_relacionados->chunk(1);

        $array_chunks = [];
        foreach ($chunk_1 as $chunk) {
          $array_chunks[] = $chunk->first();
        }
        foreach ($chunk_2 as $chunk) {
          $array_chunks[] = $chunk->first();
        }
        // if (count($array_chunks)<5) {
        //   $array_chunks = Product::where('id','!=',$product->id)->take(12);
        // }
        return view('producto',compact('product','category_name','category','array_chunks'));
      }

  // se muestran los datos del producto elegido listo para editar
  public function edit($id){
    $colors = Color::all();
    $brands = Brand::all();
    $ages = Age::all();
    $categories = Category::all();
    $category_sizes = Category_size::all();
    $category_tags = Category_tag::all();
    $tags = Tag::all();
    $stocks = Stock::all();
    $materials = Material::all();
    $sizes = Size::all();
    $genders = Gender::All();
    $images = Image::all();
    $product = Product::find($id);
    $product_tags = Product_Tag::where('product_id','=',$id)->get();

    $vac = compact('colors','product_tags','brands','ages','category_sizes','category_tags','tags','stocks','materials','sizes','genders','images','categories','product');

    return view('/editproduct', $vac)->with('status', 'Producto editado exitosamente!');;
  }

  public function update(Request $request, int $id){

    $reglas = [
      'title' => 'required|string|min:1|max:50',
      'price' => 'required|integer|min:50|max:150000',
      'model' => 'max:255|required|unique:products,model,' . $id, // https://laracasts.com/discuss/channels/requests/problem-with-unique-field-validation-on-update
      'discount' => 'required_if:onSale,1|integer|max:80|min:10|nullable',
      'description' => 'string|max:2500',
      "images" => "array|min:1",
      "images.*" => 'image|mimes:jpg,jpeg,png|max:2048',
      ];

      $mensajes = [
        "title.required" => "Ingrese el nombre del producto",
        "price.required" => "Ingrese el precio del producto",
        "model.max" => "El nombre del modelo es muy largo",
        "model.unique" => "El nombre del modelo ya existe",
        "brand_id.required" => "Debe seleccionar la marca",
        "discount.max" => "El maximo descuento es del 80%, sino es un regalo.. :)",
        "discount.min" => "El minimo descuento es del 10%, si no queres descuento desactiva el campo 'En oferta'",
        "discount.integer" => "El numero debe ser entero",
        "discount.required_if" => "Si esta en oferta debe tener un valor de descuento",
        'string' => "El campo :attribute debe ser un texto",
        "price.min" => "El precio debe ser mayor a $50",
        "min" => "El campo :attribute tiene un minimo de :min caracteres",
        "max" => "El campo :attribute tiene un maximo de :max caracteres",
        "images.*.image" => "Debe ser un formato de imagen",
        "mimes" => "Formato de imagen invalido",
        "images.*.max" => 'La imagen es muy pesada',
        "images.min" => "Debes subir al menos una imagen",
        "images.required" => "Sube una imagen del producto",
        "discount.max" => "Debe tener como maximo 80% de descuento",
      ];

      $this->validate($request, $reglas, $mensajes);

      $product = Product::find($id);

      $product->name = $request->title; // alternativa $producto->name = $request->name;
      $product->price = $request->price;
      $product->model = $request->model;
      $product->onSale = $request->onSale;
      if ($request->onSale==1) {
        $product->discount = $request->discount;
      }
      else {
        $product->discount = null;
      }
      $product->description = $request->description;
      $product->gender_id = $request->gender_id;
      $product->age_id = $request->age_id;
      $product->material_id = $request->material_id;
      $product->brand_id = $request->brand_id;

      // Buscamos la categoria seleccionada
      $category = Category::all()->where('name', '=' , $request->category_id)->first()->id;

      // Seteamos la categoria del producto
      $product->category_id = $category;

      // guardo en la base de datos
      $product->save();

      if (!empty($request['images'])) { // si suben una o mas fotos, entonces comenzamos el proceso de guardado
        // obtengo el array de imagenes

        $images = $request->file('images');
        // traigo las imagenes y recorro el array
        foreach ($images as $image) {
          // guardo cada imagen en storage/public (no en la base de datos)
          $file = $image->store('public');
          // obtengo sus nombres
          $path = basename($file);


          // por cada imagen instancio un objeto de la clase imagen
          $image = new Image;
          // asigno las rutas correspondientes y asigno el id de la imagen que debe ser igual al id del ultimo producto creado
          $image->product_id = $product->id;
          $image->path = $path;

          // guardo el objeto imagen instanciado en la base de datos
          $image->save();
        }
      }

    // Traemos los talles especificos de la categoria seleccionada
    $sizes = $product->category->sizes;
    // STOCK
    foreach ($sizes as $size) {
      $stock = Stock::where('size_id','=',$size->id)->where('product_id','=',$product->id)->get()->first();

      // El name corresponde a la cantidad enviada de un talle de esa categoria
      $name = $size->name;
      $stock->product_id = $product->id;
      $stock->size_id = $size->id;
      // En caso de que sea talle unico
      if (isset($request->Talle_Unico)) {
        $stock->quantity = $request->Talle_Unico;
      }
      // En caso de que haya varios talles buscamos en la request con los nombres de los talles
      else {
        $stock->quantity= $request->$name;
      }
      $stock->save();
    }

    // Traemos todos los tags correspondientes a la categoria del ultimo producto creado
    $tags = $product->category->tags;

    // TAGS
    foreach ($tags as $tag) {

      // Creamos la relacion con el producto
      $product_tag = Product_tag::where('tag_id','=',$tag->id)->first();
      $product_tag->product_id = $product->id;
      $product_tag->tag_id = $tag->id;

      // Necesitamos acomodar el nombre del tag a la referencia en la base de datos
      // comprobar la precencia del _ en el tag
      if (strpos($tag->name, '_') == false) {
        // Ya que nombres espaciados en un formulario pasan de "Hola Mundo" a "Hola_Mundo" en la request
        $tagAGuardar = str_replace(' ',"_", $tag->name);
        if ($request->$tagAGuardar=='true') {
          $product_tag->hasTag = 1;
          $product_tag->save();
        }
        else {
          $product_tag->hasTag = 0;
          $product_tag->save();
        }
      }
      else {
        $tagName = $tag->name;
        if ($request->$tagName=='true') {
          $product_tag->hasTag = 1;
          $product_tag->save();
        }
        else {
          $product_tag->hasTag = 0;
          $product_tag->save();
        }
      }
    }
      return redirect('/editproduct/'.$product->id)
      ->with('status', 'Producto Editado exitosamente!!!')
      ->with('operation', 'success');
  }

  // Elimina el producto seleccionado
  public function deleteproduct($id){
    // llamamos al producto a eliminar mediante su id
    $product = Product::find($id);
    $product->delete();
    return back()->with('status', 'Producto eliminado correctamente');;
  }

  // Para borrar la imagen seleccionada
  public function deleteImage($id){
    // traigo la imagen del request imagenid (name del file)
    $image = Image::find($id);
    $product = Product::find($image->product_id);
    if (count($product->images)==1) {
      return back()->with('error', 'El producto debe tener al menos una imagen! Agrega una antes de borrar la actual.');;
    }
    // elimina las imagenes de storage
    unlink(storage_path('app/public/').$image->path);
    // borramos las imagenes de la bd
    $image->delete();
    // nos retorna a la ruta anterior
    return back()->with('status', 'Imagen eliminada!');;
  }

  // JULI revisar esta funcion
  public function showallproducts(Product $product){
    $products = Product::paginate(16);
    $sizes = Size::all();
    $brands = Brand::all();
    $materials = Material::all();
    $categories = Category::all();
    $vac = compact('products','brands','sizes','categories','materials');
    return view('/searchproduct',$vac);
  }

  // Buscar producto por nombre
  public function searchProductByName(Request $request)
      {
        $reglas = ['name' => 'required|min:1|max:50',];
        $mensajes = ["name.required" => "Ingrese el nombre del producto",];
        $this->validate($request, $reglas, $mensajes);

        $products = Product::where('name', 'like', '%'. $request->name . '%')->orderBy('price','desc')->paginate(16);
        $brands = Brand::all();
        $materials = Material::all();
        $categories = Category::all();
        return view('/searchproduct', compact('products', 'request','brands','categories','materials'));
      }

      public function searchProductByCategory(Request $request)
      {
        $reglas = ['category_id' => 'required|numeric',];
        $mensajes = ["category_id.required" => "No enviaste ningun id de categoria","category_id.numeric" => "No enviaste un numero",];
        $this->validate($request, $reglas, $mensajes);

        $products = Product::where('category_id', 'like', '%'. $request->category_id . '%')->orderBy('price','desc')->paginate(16);
        $brands = Brand::all();
        $categories = Category::all();
        return view('/searchproduct', compact('products', 'request','brands','categories'));
      }

      public function searchProductByBrand(Request $req)
      {
        $reglas = ['brand' => 'required|numeric',];
        $mensajes = ["brand.required" => "No enviaste ningun id de marca","brand.numeric" => "No enviaste un numero",];
        $this->validate($req, $reglas, $mensajes);

        $products = Product::where('brand_id', 'like', '%'. $_GET['brand'] . '%')->orderBy('price','desc')->paginate(16);
        $brands = Brand::all();
        $categories = Category::all();
        return view('/searchproduct', compact('products','brands','categories'));
      }

  // Para exportar un excel del catalogo de productos actual
  public function exportExcel(){
    // https://docs.laravel-excel.com/3.1/getting-started/
    // https://phpspreadsheet.readthedocs.io/
    return Excel::download(new ProductsExport, 'Lista-de-productos.xlsx');
  }

  public function exportExcelStock(){
    return Excel::download(new StocksExport, 'Lista-de-productos.xlsx');
  }

  public function importExcel(Request $req){
    $file = $req->excel;

    try {
      Excel::import(new ProductsImport, $file);
    } catch (\Exception $e) {
      return back()->with('error','Hubo un error al actualizar los productos');
    }


    return back()->with('status', 'Productos actualizados correctamente!');
  }
  public function importExcelStock(Request $req){
    $file = $req->excelupdate;
    try {
      Excel::import(new StocksImport, $file);
    } catch (\Exception $e) {
        dd($e);
      return back()->with('error','Hubo un error al actualizar los productos');
    }


    return back()->with('status', 'Productos actualizados correctamente!');
  }

  // Funcion utilizada para aumentar o disminuir con un % el precio de determinada categoria o material.
  public function updatePrice(Request $req){
    $reglas = [
      'operacion' => 'required',
      'criterio_busqueda' => 'required',
      'percentage' => 'required',
      ];

    $mensajes = [
      "operacion.required" => "La operacion seleccionada es invalida",
      "percentage.required" => "El porcentaje es necesario",
      "criterio_busqueda.required" => "Es necesario seleccionar un criterio de búsqueda",
    ];
    // dd($req->all());
    $this->validate($req, $reglas, $mensajes);
    $criterioDeBusqueda = $req->criterio_busqueda .'_id';

    $products = Product::where($criterioDeBusqueda,'=',$req[$criterioDeBusqueda])->get();

    // Si la categoria/material seleccionado no tiene productos, lanzara un error
    if ($products->first()===null) {
      return back()->with('error', 'Modificación Fallida');
    }
    // Si elegimos sumar
    if ($req->operacion=='sum') {
      // Creamos la variable porcentaje con el numero elejido para luego trabajar con ella
      $percentage = 1 + $req->percentage/100;
      // A cada producto le sumamos el porcentaje elejido
      foreach ($products as $product) {
        $product->price = $product->price * $percentage;
        $product->save();
      }
    }

    // si elegimos restar
    if ($req->operacion=='rest') {
      // Creamos la variable porcentaje con el numero elejido para luego trabajar con ella
      $percentage = 1 - $req->percentage/100;
      // A cada producto le restamos el porcentaje elejido
      foreach ($products as $product) {
        $product->price = $product->price * $percentage;
        $product->save();
      }
    }
    // Nos retorna a la misma vista con un mensaje emergente
    return back()->with('status', 'Modificación exitosa');
  }

  public function prices(){
    $products = Product::paginate(10);
    $categories = Category::all();
    $materials = Material::all();
    $brands = Brand::all();

    return view('price_controller',compact('products','categories','brands','materials'));
  }

}
