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
      DB::table('categories')->insert(
        [
          "name" => "Anillos",
          "image" => 'agregarPath',
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

      // COLLARES
      DB::table('categories')->insert(
        [
          "name" => "Cadenas",
          "image" => 'agregarPath',
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
            "size_id" => $i + 13,
            "category_id" => 2,
          ]
        );
      }


      DB::table('categories')->insert(
        [
          "name" => "Pulseras",
          "image" => 'agregarPath',
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
            "size_id" => $i + 19,
            "category_id" => 3,
          ]
        );
      }
      // RELOJES
      DB::table('categories')->insert(
        [
          "name" => "Relojes",
          "image" => 'agregarPath',
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
          "size_id" => 23,
          "category_id" => 4,
        ]
      );

      // CATEGORIAS
      DB::table('categories')->insert(
        [
          "name" => "Accesorios",
          "image" => 'agregarPath',
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
          "size_id" => 24,
          "category_id" => 5,
        ]
      );
    }
}
