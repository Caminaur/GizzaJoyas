<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
  public $guarded = [];

  public function stocks()
  {
    return $this->hasMany("App\Models\Stock", "size_id");
  }
  public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_sizes');
    }
}
