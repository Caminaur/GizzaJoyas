<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $currencies = [
        'usd',
        'eur',
        'gbp',
      ];

      foreach ($currencies as $currency) {
        DB::table('currencies')->insert(
          [
            "iso" => $currency,
          ]
        );
      }
    }
}
