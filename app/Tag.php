<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  public $guarded = [];

  public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tags');
    }
}
