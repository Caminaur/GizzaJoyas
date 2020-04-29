<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  public $guarded = [];

  protected $fillable = [
      'name'
  ];

  public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_tags');
    }
  public function products()
    {
        return $this->belongsToMany(Category::class, 'product_tags');
    }
}
