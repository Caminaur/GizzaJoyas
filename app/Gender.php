<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  public $guarded = [];

  public function productsByGender()
  {
    return $this->hasMany("App\Product", 'gender_id');
  }
}
