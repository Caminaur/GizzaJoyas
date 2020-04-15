<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
  public $guarded = [];

  public function productsByAge()
  {
    return $this->hasMany("App\Product", 'age_id');
  }
}
