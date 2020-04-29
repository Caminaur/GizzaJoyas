<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Brand;
use App\Age;
use App\Category;
use App\Category_size;
use App\Category_tag;
use App\Product_tag;
use App\Tag;
use App\Stock;
use App\Material;
use App\Size;
use App\Gender;
use App\Image;

class ProductController extends Controller
{

  public function index(){
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
  public function store(Request $request)
  {
        $reglas = [
          'title' => 'required|string|min:1|max:50',
          'price' => 'required|integer|min:50|max:150000',
          'discount' => 'required_if:onSale,1|integer|max:80|min:10|nullable',
          'gender_id' => 'required',
          'brand_id' => 'required',
          'description' => 'string|max:200',
          "images" => "required|array|min:1",
          "images.*" => 'image|mimes:jpg,jpeg,png|max:2048',
          ];

          $mensajes = [
            "title.required" => "Ingrese el nombre del producto",
            "price.required" => "Ingrese el precio del producto",
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

          $product = new Product();
          // Name
          $product->name = $request->title; // alternativa $producto->name = $request->name;
          // Price
          $product->price = $request->price;
          // OnSale
          $product->onSale = $request->onSale;
          // Discount
          if ($request->onSale==1) {
            $product->discount = $request->discount;
          }
          else {
            $product->discount = null;
          }
          // Description
          $product->description = $request->description;
          // Gender
          $product->gender_id = $request->gender_id;
          // Age
          $product->age_id = $request->age_id;
          // Material
          $product->material_id = $request->material_id;
          // Marca
          $product->brand_id = $request->brand_id;

          // Buscamos la categoria seleccionada
          $category = Category::all()->where('name', '=' , $request->category_id)->first()->id;

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
          if (strpos($tag, '_') !== false) {
            // Ya que nombres espaciados en un formulario pasan de "Hola Mundo" a "Hola_Mundo" en la request
            $tagAGuardar = str_replace(' ',"_", $tag);
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

          return redirect('/productos')
          ->with('status', 'Producto creado exitosamente!!!')
          ->with('operation', 'success');
      }
}
