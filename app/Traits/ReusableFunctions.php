<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;

trait ReusableFunctions
{

  public function getPrice(Product $product){
    return $product->price - ($product->price * $product->discount/100);
  }
}
