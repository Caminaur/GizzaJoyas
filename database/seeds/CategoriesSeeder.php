<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert(
        [
          "name" => "Anillos",
        ]
      );

      DB::table('categories')->insert(
        [
          "name" => "Collares",
        ]
      );

      DB::table('categories')->insert(
        [
          "name" => "Pulseras",
        ]
      );

      DB::table('categories')->insert(
        [
          "name" => "Cadenas",
        ]
      );

      DB::table('categories')->insert(
        [
          "name" => "Relojes",
        ]
      );

      DB::table('categories')->insert(
        [
          "name" => "Accesorios",
        ]
      );
    }
}
