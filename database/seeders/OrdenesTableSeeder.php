<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orden;

class OrdenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orden::factory(50)->create()->each(function($orden) {
            $orden->productos()->attach([
                rand(1,10),
                rand(11,20),
                rand(21,30),
                rand(31,40),
                rand(41,50)
            ], ['cantidad' => rand(1,5), 'enviado' => rand(0, 1)]);

            $montoTotal = 0;
            foreach ($orden->productos as $producto) {
                $montoTotal += $producto->precio * $producto->pivot->cantidad;
            }

            $orden->monto_total = $montoTotal;
            $orden->save();

        });
    }
}
