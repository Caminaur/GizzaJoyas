<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Redirect;
use App\Category;
use App\Size;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;
use App\Category_tag;
use App\Category_size;
use App\Product_tag;
class CategoryController extends Controller
{
  public function index(){
    $categories = Category::all();
    $category_sizes = Category_size::all();
    $category_tags = Category_tag::all();
    $tags = Tag::all();
    $sizes = Size::all();
    $images = Image::all();

    $vac = compact('colors','brands','ages','category_sizes','category_tags','tags','stocks','materials','sizes','genders','images','categories');

    return view('addProductForm',$vac);
  }
  public function editview($id){
    $category = Category::find($id);
    $sizes = $category->sizes->sortBy('name');
    $tags = Tag::all();
    $vac = compact('tags','category','sizes');
    return view('editcategoryform',$vac);
  }
  public function imageUpdate(Request $request){
    $reglas = [
      "image" => "required|image|mimes:jpg,jpeg,png|max:2048",
      ];

    $mensajes = [
      "image" => "Debe ser un formato de imagen",
      "mimes" => "Formato de imagen invalido",
      "image.max" => 'La imagen es muy pesada',
      "images.required" => "Sube una imagen del producto",
    ];
    $this->validate($request, $reglas, $mensajes);

    if (!empty($request['image'])) { // si sube una foto, entonces comenzamos el proceso de guardado

      $image = $request->file('image');
      // guardo la imagen en storage/public (no en la base de datos)
      $file = $image->store('public');
      // obtengo sus nombres
      $path = basename($file);

      // busco la categoria correspondiende
      $category = Category::find($request->categoryId);

      $category->image = $path;

      // guardo los cambios en la base de datos
      $category->save();

      return back()->with('status', 'Imagen modificada!');
    }
  }
  public function categoryselection(){
    $categories = Category::all();
    return view('selectcategory',compact('categories'));
  }
  public function deleteCategoryTag(Request $req){

    $catag = Category_tag::where('category_id','=',$req->categoryId)
                          ->where('tag_id','=',$req->tagId)
                          ->get()[0];
    $catag->delete();

    // Debemos eliminar tambien la relacion que tenia ese tag con los productos de esa categoria
    $product_tags = Product_tag::where('tag_id','=',$req->tagId)->get();

    foreach ($product_tags as $product_tag) {
      $product_tag->delete();
    }

    return back()->with('status', 'La relacion entre el tag y la categoria fue eliminada!');
  }
  public function createTag(Request $req){
    $reglas = [
      "name" => "required|string|min:2|max:30",
      ];

    $mensajes = [
      "name.required" => "Debes ingresar un nombre para tu nuevo tag",
      "name.string" => "Solo se aceptan letras y numeros para el nombre",
      "name.min" => 'El nombre es muy corto',
      "name.max" => "El nombre es muy largo",
    ];

    $this->validate($req, $reglas, $mensajes);

    $tag = New Tag;
    $tag->name = $req->name;
    $tag->save();

    $category_tags = New Category_tag;
    $category_tags->tag_id = $tag->id;
    $category_tags->category_id = $req->category_id;
    $category_tags->save();

    // Cada vez que creamos un tag en una categoria modificamos todos los productos
    // que sean de esa categoria
    $products = Product::where('category_id','=',$req->category_id)->get();

    foreach ($products as $product) {
      $product_tag = New Product_tag;
      $product_tag->tag_id = $tag->id;
      $product_tag->product_id = $product->id;
      $product_tag->hasTag = 0; // Como predetermida le decimos que no tiene tag
      $product_tag->save();
    }

    // Buscamos la categoria para personalizar el mensaje
    $category = Category::find($req->category_id);

    return back()->with('status', 'Nuevo tag creado y relacionado con la categoria "'.$category->name.'"');
  }
  public function addTag(Request $req){
    $reglas = [
      "tagId" => "required",
      "category_id" => "required",
      ];

    $mensajes = [
      "tagId.required" => "No seleccionaste ningun tag",
      "category_id.required" => "La categoria es obligatoria"
    ];
    $this->validate($req, $reglas, $mensajes);


    // Relacionamos un tag con una categoria
    $category_tags = New Category_tag;
    $category_tags->category_id = $req->category_id;
    $category_tags->tag_id = $req->tagId;
    $category_tags->save();

    // Cada vez que se modifica un tag en una categoria modificamos todos los productos
    // que sean de esa categoria
    $products = Product::where('category_id','=',$req->category_id)->get();

    foreach ($products as $product) {
      $product_tag = New Product_tag;
      $product_tag->tag_id = $req->tagId;
      $product_tag->product_id = $product->id;
      $product_tag->hasTag = 0; // Como predetermida le decimos que no tiene tag
      $product_tag->save();
    }

    // Buscamos un par de variables para personalizar el mensaje
    $category = Category::find($req->category_id);
    $tag = Tag::find($req->tagId);
    return back()->with('status', 'El tag ' .$tag->name .' fue relacionado con '.$category->name .'!');
  }
  public function changeName(Request $req){
    $reglas = [
      "category_name" => "required|string|min:2|max:30",
      "category_id" => "required",
      ];

    $mensajes = [
      "category_name.required" => "Debes ingresar un nombre para la categoria",
      "category_name.string" => "Solo se aceptan letras y numeros para el nombre",
      "category_name.min" => 'El nombre es muy corto',
      "category_name.max" => "El nombre es muy largo",
      "category_id.required" => "La categoria es obligatoria",
    ];
    $this->validate($req, $reglas, $mensajes);

    $category = Category::find($req->category_id);
    $category->name = $req->category_name;
    $category->save();

    return back()->with('status', 'El nombre de la categoria fue modificado exitosamente!');
  }
  public function createCategoryForm(){
    return view('/addcategoryform');
  }
  public function createCategory(Request $req){
    $reglas = [
      "image" => "required|image|mimes:jpg,jpeg,png|max:2048",
      "category_name" => 'required|string|min:1|max:50',
      "sizes" => "required|array|min:1",
      "sizes.*" => 'min:1|max:80',
      ];

    $mensajes = [
      "image" => "Debe ser un formato de imagen",
      "category_name.required" => "El nombre de la categoria es requerido",
      "category_name.string" => "El nombre de la categoria deben ser letras",
      "category_name.min" => "El nombre de la categoria es muy corto",
      "category_name.max" => "El nombre de la categoria es muy largo",
      "mimes" => "Formato de imagen invalido",
      "image.max" => 'La imagen es muy pesada',
      "images.required" => "Sube una imagen del producto",
      "required" => "Agrege un talle para poder crear la categoria",
      "sizes.min" => 'No has cargado ningun talle',
    ];
    $this->validate($req, $reglas, $mensajes);

    if (!empty($req['image'])) { // si sube una foto, entonces comenzamos el proceso de guardado
      // creamos la categoria
      $category = New Category;
      // le asignamos el nombre
      $category->name = $req->category_name;

      $image = $req->file('image');
      // guardo la imagen en storage/public (no en la base de datos)
      $file = $image->store('public');
      // obtengo sus nombres
      $path = basename($file);

      // guardamos la imagen
      $category->image = '/storage/'. $path;

      // guardo los cambios en la base de datos
      $category->save();

      // Empezamos con los talles relacionado a esa categoria
      $arraySizes = [];
      // Guardamos los talles relacionados con una categoria en un array
      foreach ($category->sizes as $size) {
        $arraySizes[] = $size->name;
      }
      // Creamos todos los talles enviados mediante un foreach
      foreach ($req->sizes as $newSize) {
        $size = New Size;
        $size->name = $newSize;
        $size->save();

        // Por cada nuevo talle creado, creamos tambien una relacion entre la categoria y ese nuevo talle
        $category_size = New Category_size;
        $category_size->category_id = $category->id;
        $category_size->size_id = $size->id;
        $category_size->save();
      }

      return Redirect::to('/editcategory')->with('status', 'Categoria creada exitosamente!');;
    }
  }
  public function delete(Request $req){

    // Buscamos la categoria
    $category = Category::find($req->category_id);
    // Buscamos los talles relacionados
    $talles = $category->sizes;
    // Eliminamos los talles relacionados
    foreach ($talles as $talle) {
      $talle->delete();
    }

    // Borramos la categoria
    $category->delete();

    // Redirigimos a la vista de selectcategory
    return  Redirect::to('/editcategory')->with('status', 'Categoria eliminada exitosamente!');
  }
}
