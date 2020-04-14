<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_platform extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'image',
  ];
}
