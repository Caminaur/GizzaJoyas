<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
  public $guarded = [];

  public function productsByAge()
  {
    return $this->hasMany("App\Models\Product", 'age_id');
  }
}
