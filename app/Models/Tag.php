<?php

namespace App\Models;

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
        return $this->belongsToMany(Product::class, 'product_tags');
    }
}
