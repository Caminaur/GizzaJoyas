<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;
use App\Category;
use App\Category_size;

class SizeController extends Controller
{
  public function delete(Request $req){
    $size = Size::find($req->sizeId);
    $size->delete();
    return back();
  }
  public function add(Request $req){

    $reglas = [
      "sizes" => "required|array|min:1",
      "sizes.*" => 'integer|min:1|max:80',
      ];

    $mensajes = [
      "required" => "Agrege un talle para poder actualizar",
      "sizes.min" => 'No ha cargado ningun talle nuevo',
      "sizes.number" => 'El talle debe ser de tipo numerico',
    ];

    $this->validate($req, $reglas, $mensajes);

    $category = Category::find($req->categoryId);
    $arraySizes = [];
    // Guardamos los talles relacionados con una categoria en un array
    foreach ($category->sizes as $size) {
      $arraySizes[] = $size->name;
    }

    foreach ($req->sizes as $newSize) {
      // Si el talle a agregar no esta en los talles relacionados con la categoria lo guardamos
        if (!in_array(intval($newSize),$arraySizes)) {
          $size = New Size;
          $size->name = $newSize;
          $size->save();

          $category_size = New Category_size;
          $category_size->category_id = $category->id;
          $category_size->size_id = $size->id;
          $category_size->save();
        }
    }
    return back();
  }
}
