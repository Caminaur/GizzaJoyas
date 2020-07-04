<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Stock;
use App\Cart;

class CartController extends Controller
{
  // Mostramos los carritos que pertenezcan al mismo usuario
  public function show(){
    // Buscamos los carritos del usuario
    $carts = Cart::where('user_id','=',Auth::user()->id)->get();
    foreach ($carts as $cart) {
      // traemos los stocks de cada producto de cada carrito
      $stock = Stock::where('product_id','=',$cart->product->id)
                      ->where('size_id','=',$cart->size_id)
                      ->get()
                      ->first();
      // En caso de que el stock se haya reducido por compras de otros usuario
      // Reducimos la quantity del carrito a la disponible
      if ($cart->quantity>$stock->quantity) {
        $cart->quantity = $stock->quantity;
        $cart->save();
      }
      // En caso de que no haya ni un solo producto disponible en ese talle
      if($stock->quantity===0){
        // Eliminamos el carrito
        $cart->delete();
      }
    }
    return view('cart',compact('carts'));
  }

    // Agregamos al carrito el producto elegido
  public function addToCart(Request $req){

    $product = Product::find($req->product_id);
    $size = Size::find($req->size_id);
    $cantidad_de_stock = Stock::where('size_id','=',$size->id)
                              ->where('product_id','=',$req->product_id)
                              ->get()
                              ->first()
                              ->quantity;

    $cart = Cart::where('user_id','=',Auth::user()->id)
                ->where('product_id','=',$product->id)
                ->where('size_id','=',$req->size_id)
                ->get();

    if (isset($cart->first()->product_id)) {
      $stockEnCarrito = $cart->first()->quantity;
      // Para que la cantidad de stock en el carrito no supere a la cantidad de stock real
      $cantidad_de_stock = $cantidad_de_stock - $stockEnCarrito;
    }

    if ($req->quantity>$cantidad_de_stock) {
      return back()->with('error','Alcanzaste la cantidad maxima del producto disponible');
    }
    else {
      // agregamos al cart el producto
      // Al agregar un producto instanciamos un nuevo carrito
      $cart = new Cart;
      // Los relacionamos
      $cart->product_id = $product->id;
      $cart->user_id = Auth::user()->id;
      // Instanciamos sus valores
      $cart->size_id = $req->size_id;
      $cart->quantity = $req->quantity;
      // Si el mismo usuario pide 2 veces el mismo producto (mismo id de producto y mismo talle)
      $repeat = Cart::where('user_id', '=', Auth::user()->id)
      ->where('product_id', '=', $product->id)
      ->where('size_id' , '=',$req->size_id)
      ->get();
      if (isset($repeat[0])) {
        $repeat[0]->quantity = $repeat[0]->quantity + $cart->quantity;
        $repeat[0]->save();
        return redirect('/cart');
      }
      $cart->save();
      // devolvemos la vista del carrito
      return redirect('/cart');
    }
  }

  // Borramos el producto elegido
  public function deleteOneCart($id){
    $cart = Cart::find($id);
    $cart->delete();
    return back()->with('status', 'Producto eliminado del carrito exitosamente!');;
  }

  // Borramos todos los productos del usuario
  public function deleteAllCarts(){
    $carts = Cart::where('user_id','=',Auth::user()->id)->get();
    foreach ($carts as $cart) {
      $cart->delete();
    }
    return back()->with('status', 'El carrito fue vaciado exitosamente!');;
  }
}
