<?php

use App\Payment_platform;
use Illuminate\Database\Seeder;

class Payment_platformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('payment_platforms')->truncate();

      Payment_platform::create([
        'name' => 'MercadoPago',
        'image' => 'img/payment-platforms/mercadopago.jpg',
      ]);
    }
}
