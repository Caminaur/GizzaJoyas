<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\Category_size;

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
      "sizes.*" => 'string|min:1',
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
    // productos de esta categoria
    $products = Product::where('category_id','=',$req->categoryId)->get();

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


          foreach($products as $product){
            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->quantity = 0;
            $stock->size_id = $size->id;
            $stock->save();
          }
        }
        else if (!in_array($newSize,$arraySizes)){
            $size = New Size;
          $size->name = $newSize;
          $size->save();

          $category_size = New Category_size;
          $category_size->category_id = $category->id;
          $category_size->size_id = $size->id;
          $category_size->save();


          foreach($products as $product){
            $stock = new Stock;
            $stock->product_id = $product->id;
            $stock->quantity = 0;
            $stock->size_id = $size->id;
            $stock->save();
          }
        }
    }

    return back();
  }
}
