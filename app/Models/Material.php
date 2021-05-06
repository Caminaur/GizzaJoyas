<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  public $guarded = [];

  public function productsByMaterial()
  {
    return $this->hasMany("App\Models\Product", 'material_id');
  }
}
