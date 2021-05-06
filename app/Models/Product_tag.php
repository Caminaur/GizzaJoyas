<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_tag extends Model
{
  protected $fillable = [
      'hasTag', 'product_id', 'tag_id'
  ];
}
