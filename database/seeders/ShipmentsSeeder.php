<?php

use Illuminate\Database\Seeder;

class ShipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('shipments')->insert(
        [
          "value" => 500,
        ]
      );
    }
}
