<?php

use Illuminate\Database\Seeder;
use App\Size;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // creamos la primer categoria id=1

      // Anillos
      DB::table('categories')->insert(
        [
          "name" => "Anillos",
          "image" => '/images/anillos.jpg',
        ]
      );
      // Creamos los talles de los anillos base
      $tallesAnillos = [12,13,14,15,16,17,18,19,20,21,22,23];
      for ($i=0; $i < count($tallesAnillos) ; $i++) {
        // Por cada talle creamos una fila en sizes
        DB::table('sizes')->insert(
          [
            "name" => $tallesAnillos[$i],
          ]
        );
        // y creamos la relacion de esa fila con la primer categoria
        DB::table('category_sizes')->insert(
          [
            "size_id" => $i + 1,
            "category_id" => 1,
          ]
        );
      }

      // Aros
      DB::table('categories')->insert(
        [
          "name" => "Aros",
          "image" => '/images/aros.jpg',
        ]
      );
      // Creamos los talles de los anillos base
      $tallesAros = [12,13,14,15,16,17,18,19,20,21,22,23];
      for ($i=0; $i < count($tallesAros) ; $i++) {
        // Por cada talle creamos una fila en sizes
        DB::table('sizes')->insert(
          [
            "name" => $tallesAros[$i],
          ]
        );
        // y creamos la relacion de esa fila con la primer categoria
        DB::table('category_sizes')->insert(
          [
            "size_id" => $i + 13,
            "category_id" => 2,
          ]
        );
      }

      // COLLARES
      DB::table('categories')->insert(
        [
          "name" => "Collares",
          "image" => '/images/collares.jpg',
        ]
      );
      $tallesCadenas = [40,45,50,55,60,65];
      for ($i=0; $i < count($tallesCadenas) ; $i++) {
        // Por cada talle creamos una fila en sizes
        DB::table('sizes')->insert(
          [
            "name" => $tallesCadenas[$i],
          ]
        );
        // y creamos la relacion de esa fila con la primer categoria
        DB::table('category_sizes')->insert(
          [
            "size_id" => $i + 25,
            "category_id" => 3,
          ]
        );
      }

      // Pulseras
      DB::table('categories')->insert(
        [
          "name" => "Pulseras",
          "image" => '/images/pulseras.jpg',
        ]
      );
      $tallesPulseras = [18,19,20,21];
      for ($i=0; $i < count($tallesPulseras) ; $i++) {
        // Por cada talle creamos una fila en sizes
        DB::table('sizes')->insert(
          [
            "name" => $tallesPulseras[$i],
          ]
        );
        // y creamos la relacion de esa fila con la primer categoria
        DB::table('category_sizes')->insert(
          [
            "size_id" => $i + 31,
            "category_id" => 4,
          ]
        );
      }
      // RELOJES
      DB::table('categories')->insert(
        [
          "name" => "Relojes",
          "image" => '/images/relojes.jpg',
        ]
      );
      DB::table('sizes')->insert(
        [
          "name" => "Talle Unico",
        ]
      );
      $lastSizeId = Size::all()->last()->id;
      DB::table('category_sizes')->insert(
        [
          "size_id" => 35,
          "category_id" => 5,
        ]
      );

      // Accesorios
      DB::table('categories')->insert(
        [
          "name" => "Accesorios",
          "image" => '/images/accesorios.jpg',
        ]
      );
      DB::table('sizes')->insert(
        [
          "name" => "Talle Unico",
        ]
      );
      $lastSizeId = Size::all()->last()->id;
      DB::table('category_sizes')->insert(
        [
          "size_id" => 36,
          "category_id" => 6,
        ]
      );
    }
}
