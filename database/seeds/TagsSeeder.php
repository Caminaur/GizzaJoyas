<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tags')->insert(
        [
          "name" => "Electroformatura",
        ]
      );

      DB::table('tags')->insert(
        [
          "name" => "Micropave",
        ]
      );

      DB::table('tags')->insert(
        [
          "name" => "Media Falange",
        ]
      );
    }
}
