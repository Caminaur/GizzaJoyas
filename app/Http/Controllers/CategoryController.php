<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Size;
use Illuminate\Http\Request;

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
    $vac = compact('category','sizes');
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

      return back();
    }
  }
  public function categoryselection(){
    $categories = Category::all();
    return view('selectcategory',compact('categories'));
  }
}
