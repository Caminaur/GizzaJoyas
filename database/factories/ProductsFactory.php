<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Product;
use App\Gender;
use App\Category;
use App\Stock;
use App\Color;
use App\Age;
use App\Image;

$factory->define(Product::class, function (Faker $faker) {

  $gender = Gender::all();
  $random = $faker->randomDigit();

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
  $category = Category::all()->random();
  $age = Age::all()->random();

    $product = New Product;
    $product->name = $faker->name;
    $product->price = $random*$faker->numberBetween(2,7)*100;
    $product->onSale = $onSale;
    $product->discount = $discount;
    $product->gender_id = $gender->random()->id;
    $product->category_id = $category->id;
    $product->age_id = $age->id;
    $product->save();

    $imagesRoutes = ['images/foto1.jpg','images/foto2.jpg','images/foto3.jpg','images/foto4.jpg'];
    $index = array_rand($imagesRoutes);
    $image = New Image;
    $image->path = $imagesRoutes[$index];
    $image->product_id = $product->id;
    $image->save();
    // los talles de la categoria que toco
    $sizes = $category->sizes;
    if (empty($sizes[0])) {
        $stock = new Stock();
        $stock->quantity = $faker->randomDigit();
        $colors = Color::all();
        $stock->color_id = $colors->random()->id;
        $stock->size_id = null;
        if (isset(Product::all()->last()->id)) {
          $stock->product_id = Product::all()->last()->id;
        }
        else {
          $stock->product_id = 1;
        }
        $stock->save();
    }
    else {
      foreach ($sizes as $key => $size) {
        $stock = new Stock();
        $stock->quantity = $faker->randomDigit();
        $colors = Color::all();
        $stock->color_id = $colors->random()->id;
        $stock->size_id = $size->id;
        if (isset(Product::all()->last()->id)) {
          $stock->product_id = Product::all()->last()->id;
        }
        else {
          $stock->product_id = 1;
        }
        $stock->save();
      }
    }

    return [
      'name' => $faker->name,
      'price' => $random*$faker->numberBetween(2,7)*100,
      'onSale' => $onSale,
      'discount' => $discount,
      'gender_id' => $gender->random(),
      'category_id' => $category->id,
    ];
});
