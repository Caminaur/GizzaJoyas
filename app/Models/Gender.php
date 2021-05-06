<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  public $guarded = [];

  public function productsByGender()
  {
    return $this->hasMany("App\Models\Product", 'gender_id');
  }
}
