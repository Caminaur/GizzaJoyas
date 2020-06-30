<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Size;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;
use App\Category_tag;
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

      return back()->with('status', 'Imagen modificada!');;
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

    return back()->with('status', 'La relacion entre el tag y la categoria fue eliminada!');;
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
    $category = Category::find($req->category_id)->get();

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

    return back();
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

    return back();
  }
}
