<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use App\Shipment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

  public function cpanel(){
    $shipment = Shipment::all()->first();
    return view('adminpanel',compact('shipment'));
  }

  public function editshipment(Request $req){
    $shipment = Shipment::all()->first();
    $shipment->value = $req->shipment_value;
    $shipment->save();
    return back()->with('status','Envío actualizado!');
  }

  public function favoritos(){
    $favourites = Favourite::where('user_id','=',Auth::user()->id)
                           ->get();
    return view('/favoritos',compact('favourites'));
  }

  public function addFav($product_id)
  {

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


  public function deleteFavourites()
  {
    $favourites = Favourite::where('user_id','=',Auth::user()->id)
                           ->get();
    foreach ($favourites as $favourite) {
      $favourite->delete();
    }
    return back();
  }

  public function deleteFavourite(Request $req)
  {
    if ($req->ajax()) {

        // buscamos el favorito
        $favourite = Favourite::find($req->fave_id);
        // lo eliminamos

        $favourite->delete();

        // Contamos el total de favoritos del usuario
        $favourites_total = Favourite::where('user_id','=',Auth::user()->id)
        ->get();

        // Retornamos la respuesta
        $data = array(
          'total' => count($favourites_total),
          'message' => 'El producto ' . $favourite->product->name . ' fue eliminado de favoritos correctamente',
        );

        // lo transformamos en json y lo imprimimos
        echo json_encode($data);
      }

    else {
      $data = array(
        'message' =>  'Hubo un error, no se pudo borrar el producto',
      );

      // lo transformamos en json y lo imprimimos
      echo json_encode($data);
    }
  }


  public function indexProfile()
  {
    return view('profile');
  }

  public function editForm()
  {
    return view('editprofile');
  }

  public function editProfile(Request $req)
  {

    $reglas = [
      'name' =>'required|string|min:2|max:40|',
      'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id.',id', // https://laravel.com/docs/5.2/validation#rule-unique , https://laracasts.com/discuss/channels/laravel/how-to-update-unique-email
      'password' => ['nullable', 'min:6'],
    ];
    $mensajes = [
    "required" => "El campo es obligatorio",
    "string" => "El campo debe ser un texto",
    "min" => "El minimo es de :min caracteres",
    "max" => "El maximo es de :max caracteres",
    ];
    $this->validate($req, $reglas,$mensajes);

    $user = Auth::user();
    $user->password = Hash::make($req->password);
    $user->name = $req->name;
    $user->email = $req->email;

    //guardo en la base de datos
    $user->save();

    return redirect('/profile')->with('status', 'Usuario Editado exitosamente')
                               ->with('operation', 'success');
  }

  public function deleteProfile() // borrar el usuario y deslinkear cualquier relacion, en este caso, borra su carrito
  {

    // $cart = Cart::find(Auth::user()->cart_id);
    $user = User::find(Auth::user()->id);

    $user->delete(); // borramos el usuario
    return redirect("/")->with('status', 'Usuario eliminado')
                        ->with('operation', 'success');
  }
}
