<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  public $guarded = [];

  public function productsByBrand()
  {
    return $this->hasMany("App\Models\Product", 'brand_id');
  }
}
