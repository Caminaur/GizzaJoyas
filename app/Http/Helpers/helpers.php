<?php
  // https://stackoverflow.com/questions/35332784/how-to-call-a-controller-function-inside-a-view-in-laravel-5
  // https://styde.net/como-crear-helpers-personalizados-en-laravel/
  // Encontre esta solucion para el uso de funciones globales

  // Obtiene el precio real de un producto, con descuento incluido si es que lo tiene
  function getRealPrice($product){
    $precio = 0;
    if ($product->onSale) {
      $precio = $product->price - ($product->price * $product->discount / 100);
      return $precio;
    }
    else {
      $precio = $product->price;
      return $precio;
    }
  }

  // Se encarga de que haya stock de por lo menos un talle del producto
  function hasStock($product){
    $hasStock = false;
    foreach ($product->stocks as $stock) {
      if ($stock->quantity>0) {
        $hasStock = true;
      }
    }
    return $hasStock;
  }


  // verifica un solo talle
  function sizeHasStock($stock){
    if ($stock->quantity>0) {
      return true;
    }
    else {
      return false;
    }
  }


  // Obtiene el valor total de la suma de todos los carritos
  function getTotalPrice($carts){
    $totalPrice = 0;
    foreach ($carts as $cart) {
      $totalPrice = $totalPrice + (getRealPrice($cart->product)*$cart->quantity);
    }
    return $totalPrice;
  }


  // Verifica si un producto es favorito del usuario
  function isFavourite($product, $user){
    $isFavorite = false;
    foreach ($user->productosFavoritos as $fa) {
      if ($product->id==$fa->id) {
        $isFavorite = true;
      }
    }
    return $isFavorite;
  }
?>