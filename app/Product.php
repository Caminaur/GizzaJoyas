<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public $guarded = [];

  public function carts()
  {
    return $this->hasMany("App\Cart", "product_id");
  }

  public function images()
  {
    return $this->hasMany("App\Image", "product_id");
  }

  public function stocks()
  {
    return $this->hasMany("App\Stock", "product_id");
  }

  public function gender()
  {
    return $this->belongsTo("App\Gender", "gender_id");
  }

  public function category()
  {
    return $this->belongsTo("App\Category", "category_id");
  }

  public function brand()
  {
    return $this->belongsTo("App\Brand", "brand_id");
  }

  public function material()
  {
    return $this->belongsTo("App\Material", "material_id");
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class, 'product_tags');
  }

  public function esFavoritoDe()
  {
    return $this->belongsToMany("App\Users", "favourites", "product_id", "user_id");
  }
}
