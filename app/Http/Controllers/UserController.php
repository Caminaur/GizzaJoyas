<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function cpanel(){
    return view('adminpanel');
  }

  public function favoritos(){
    $favourites = Favourite::where('user_id','=',Auth::user()->id)
                           ->get();
    return view('/favoritos',compact('favourites'));
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
  public function deleteFavourite(){
    $favourites = Favourite::where('user_id','=',Auth::user()->id)
                           ->get();
    foreach ($favourites as $favourite) {
      $favourite->delete();
    }
    return back();
  }

  public function indexProfile(){
    return view('profile');
  }
  public function editForm(){
    return view('editprofile');
  }
  public function editProfile(Request $req){
    $reglas = [
      'name' =>'required|string|min:2|max:40|',
      'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id.',id',
      'old_password' => ['nullable', 'min:6'],
      'new_password' => ['nullable', 'min:6'],
    ];
    $mensajes = [
    "required" => "El campo es obligatorio",
    "string" => "El campo debe ser un texto",
    "min" => "El minimo es de :min caracteres",
    "max" => "El maximo es de :max caracteres",
    ];
    $this->validate($req, $reglas,$mensajes);

      $user = Auth::user();

      // // Validamos las contraseñas    (NO FUNCIONA, don't know why..)
      // if (Hash::check($req->old_password,$user->password)) {
      //   $user->password = Hash::make($req->password);
      //   $user->name = $req->name;
      //   if (Auth::user()->email == $req->email){
      //     $user->email;
      //   }else{
      //     $user->email = $req->email;
      //   }


        $user->password = Hash::make($req->password);
        $user->name = $req->name;
        $user->email = $req->email;

        //guardo en la base de datos
        $user->save();

        return back()->with('message','Tu perfil ha sido actualizado exitosamente!');
      }
      // else {
      //   return back()->with('error','La contraseña ingresada es incorrecta');
      // }
}
