<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function cpanel(){
    return view('adminpanel');
  }

  public function favoritos(){
    return view('/favoritos');
  }
  public function addFav($product_id){

    // verificamos que el producto no este seleccionado como favorito
    $favourites = Favourite::where('product_id','=',$product_id)
                           ->where('user_id','=',Auth::user()->id)
                           ->get();
    if (!count($favourites)>0) {
      $favourite = New Favourite;
      $favourite->product_id = $product_id;
      $favourite->user_id = Auth::user()->id;
      $favourite->save();
      return back()->with('status','Producto agregado a favoritos!');
    }
    else {
      $favourites->first()->delete();
      return back()->with('error','Producto eliminado de favoritos!');
    }
  }
}
