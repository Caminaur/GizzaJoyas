<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  public $guarded = [];

  public function productsByBrand()
  {
    return $this->hasMany("App\Product", 'brand_id');
  }
}
