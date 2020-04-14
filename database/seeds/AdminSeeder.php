<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert(
        [
          "name" => "admin",
          "email" => "admin@admin.com",
          "password" => Hash::make('123456'),
          "isAdmin" => true
        ]
      );
    }
}
