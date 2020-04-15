<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $guarded = [];

  public function product()
  {
    return $this->belongsTo("App\Product", "image_id");
  }
}
