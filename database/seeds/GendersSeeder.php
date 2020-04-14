<?php

use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('genders')->insert(
        [
          "name" => "Hombre",
        ]
      );

      DB::table('genders')->insert(
        [
          "name" => "Mujer",
        ]
      );

      DB::table('genders')->insert(
        [
          "name" => "Unisex",
        ]
      );
    }
}
