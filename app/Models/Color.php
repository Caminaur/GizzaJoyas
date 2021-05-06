<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
  public $guarded = [];

  public function stockByColor()
  {
    return $this->hasMany("App\Models\Stock", "color_id");
  }
}
