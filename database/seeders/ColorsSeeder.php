<?php

use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $colores = [
         'Deportivas',
         'Blanco',
         'Negro',
         'Rojo',
         'Azul',
         'Amarillo',
         'Naranja',
         'Violeta',
         'Marron',
         'Gris',
         'Rosa',
         'Bordo',
         'Salmon',
         'Beige',
         'Celeste',
         'Verde',
         'Multicolor',
       ];
       foreach ($colores as $color) {
         DB::table('colors')->insert(
           [
             "name" => $color,
           ]
         );
       }
    }
}
