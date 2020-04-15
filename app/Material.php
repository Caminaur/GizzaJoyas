<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  public $guarded = [];

  public function productsByMaterial()
  {
    return $this->hasMany("App\Product", 'material_id');
  }
}
