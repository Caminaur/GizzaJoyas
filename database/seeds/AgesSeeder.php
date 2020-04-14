<?php

use Illuminate\Database\Seeder;

class AgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ages')->insert(
        [
          "name" => "adultos",
        ]
      );
      DB::table('ages')->insert(
        [
          "name" => "niños",
        ]
      );
    }
}
