<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $guarded = [];

  public function carts()
  {
    return $this->hasMany("App\Models\Cart", "product_id");
  }

  public function images()
  {
    return $this->hasMany("App\Models\Image", "product_id");
  }

  public function stocks()
  {
    return $this->hasMany("App\Models\Stock", "product_id");
  }

  public function gender()
  {
    return $this->belongsTo("App\Models\Gender", "gender_id");
  }

  public function category()
  {
    return $this->belongsTo("App\Models\Category", "category_id");
  }

  public function brand()
  {
    return $this->belongsTo("App\Models\Brand", "brand_id");
  }

  public function material()
  {
    return $this->belongsTo("App\Models\Material", "material_id");
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'product_tags');
  }

  public function esFavoritoDe()
  {
    return $this->belongsToMany("App\Models\User", "favourites", "product_id", "user_id");
  }

  public function estaEnElCarritoDe()
  {
    return $this->belongsToMany("App\Models\User", "cart", "product_id", "user_id");
  }

}
