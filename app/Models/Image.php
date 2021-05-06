<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $guarded = [];

  public function product()
  {
    return $this->belongsTo("App\Models\Product", "image_id");
  }
}
