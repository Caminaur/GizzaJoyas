<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
  public $guarded = [];

  public function product()
  {
    return $this->belongsTo("App\Models\Product", "product_id");
  }
}
