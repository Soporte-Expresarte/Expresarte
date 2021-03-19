<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use App\Models\Carro;

class CarrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carro::factory(20)->create();

        foreach (Carro::all() as $carrito) {
            $prod1 = Producto::find(rand(1, 5));
            $prod2 = Producto::find(rand(6, 10));
            $prod3 = Producto::find(rand(11, 15));
            $prod4 = Producto::find(rand(16, 20));
            $prod5 = Producto::find(rand(21, 25));

            $carrito->productos()->attach([$prod1->id], ['cantidad' => rand(1, 10)]);
            $carrito->productos()->attach([$prod2->id], ['cantidad' => rand(1, 10)]);
            $carrito->productos()->attach([$prod3->id], ['cantidad' => rand(1, 10)]);
            $carrito->productos()->attach([$prod4->id], ['cantidad' => rand(1, 10)]);
            $carrito->productos()->attach([$prod5->id], ['cantidad' => rand(1, 10)]);

            $montoTotal = $prod1->precio +
                $prod2->precio +
                $prod3->precio +
                $prod4->precio +
                $prod5->precio;

            $carrito->monto_total = $montoTotal;
            $carrito->save();
        }

    }
}
