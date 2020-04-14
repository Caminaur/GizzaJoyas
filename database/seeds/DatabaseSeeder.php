<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(AgesSeeder::class);
        $this->call(BrandsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(FaqsSeeder::class);
        $this->call(GendersSeeder::class);
        $this->call(MaterialsSeeder::class);
        $this->call(Payment_platformsSeeder::class);
        $this->call(TagsSeeder::class);
    }
}
