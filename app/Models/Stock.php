<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  public $guarded = [];

  public function product()
  {
    return $this->belongsTo("App\Models\Product", "product_id");
  }

  public function color()
  {
    return $this->belongsTo("App\Models\Color", "color_id");
  }

  public function size()
  {
    return $this->belongsTo("App\Models\Size", "size_id");
  }
  public function stocks()
  {
    return $this->belongsTo("App\Models\Stock", "product_id");
  }
}
