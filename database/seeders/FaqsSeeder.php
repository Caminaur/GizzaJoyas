<?php

use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('faqs')->insert([
        [
          "title" => "Cuál es mi talle?",
          "description" => null,
          "image_path" => "tabladetalles2.jpg"
        ],

        [
          "title" => "Puedo solicitar stock?",
          "description" => "Claro!, si no hay stock de algún producto o talle en particular vas a encontrar la opción 'solicitá stock por Whatsapp', no dudes en avisarnos!",
          "image_path" => null
        ],

        [
          "title" => "Política de cambios",
          "description" => "Si el producto te quedo chico o grande podes realizar el cambio del mismo en nuestro local, en caso de ser de otra provincia o si no podes acercarte a nuestro local te pedimos que te comuniques con nosotros telefonicamente o via email para que se realice el cambio. Los cambios sólo se pueden realizar durante los 7 días hábiles después de haber recibido el producto. No nos hacemos cargo del costo de envío",
          "image_path" => null
        ],

        [
          "title" => "Garantía",
          "description" => "Si el producto tiene alguna falla de fabrica, podes realizar el cambio del mismo en nuestro local, si sos de otra provincia o no podes acercarte te pedimos que te comuniques con nosotros telefonicamente o via email para realizar el cambio. El cambio solo se pude realizar durante 30 días después de realizar la compra SIN EXCEPCIÓN",
          "image_path" => null
        ],

        [
          "title" => "Promociones",
          "description" => "Promoción por pago en efectivo. Promoción por compra en cantidad. Promoción envío gratis",
          "image_path" => null
        ],

        [
          "title" => "Horarios de Atención y showroom",
          "description" => "Podes visitar nuestro local que se encuentra en Av. Boulogne Sur Mer 1273, Tapiales De Lunes a Sábado de 9:00 a 13:00hs y 17:00 a 20:30hs",
          "image_path" => null
        ],

      ]);
    }
}
