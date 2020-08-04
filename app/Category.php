<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  // public $table = "table_name";
  public $guarded = [];

  public function tags()
    {
        return $this->belongsToMany(Tag::class, 'category_tags');
    }

  public function sizes()
    {
        return $this->belongsToMany(Size::class, 'category_sizes');
    }
}
