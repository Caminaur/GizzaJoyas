<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Product;
use App\Genre;
use App\Category;
use App\Stock;
use App\Color;
$factory->define(Product::class, function (Faker $faker) {

    $stock = new Stock();
    $stock->quantity = $faker->randomDigit();
    $colors = Color::all();
    $stock->color_id = $colors->random();
    $sizes = Size::all();
    $stock->size_id = $sizes->random();
    $stock->product_id = $faker->randomDigit();
    $stock->save();

    $genres = Genre::all();
    $random = $faker->randomDigit();
    $categories = Category::all();
    $onSale = $faker->boolean(40);
    if ($onSale) {
      $discount = $faker->randomDigit()*5;
      if ($discount==0) {
        $discount = 15;
      }
    }
    else {
      $discount = 0;
    }
    if ($random==0) {
      $random = 4;
    }

    return [
      'name' => $faker->name,
      'price' => $random*$faker->numberBetween(2,7)*100,
      'onSale' => $onSale,
      'discount' => $discount,
      'genre_id' => $genres->random(),
      'category_id' => $categories->random(),
      'stock_id' => $stock->id,
    ];
});
