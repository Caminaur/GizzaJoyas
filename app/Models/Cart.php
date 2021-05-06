<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public $guarded = [];

  public function product()
  {
    return $this->belongsTo("App\Models\Product", "product_id");
  }
  public function size(){
    return $this->belongsTo("App\Models\Size","size_id");
  }

}
