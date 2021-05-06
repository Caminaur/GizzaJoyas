<?php

use Illuminate\Database\Seeder;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('materials')->insert(
        [
          "name" => "Plata",
        ]
      );

      DB::table('materials')->insert(
        [
          "name" => "Plata y oro",
        ]
      );

      DB::table('materials')->insert(
        [
          "name" => "Oro",
        ]
      );

      DB::table('materials')->insert(
        [
          "name" => "Acero",
        ]
      );
    }
}
