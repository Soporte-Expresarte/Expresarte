<?php

namespace Database\Seeders;

use App\Models\Exposicion;
use App\Models\Obra;
use Illuminate\Database\Seeder;

class ExposicionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max = Obra::all()->count();

        Exposicion::factory(30)->create();

        foreach (Exposicion::all() as $expo) {

            // lista de numeros aleatorios sin repetir
            $valores = array();
            $num = rand(4, 16);
            $x = 0;

            while ($x < $num) {
                $num_aleatorio = rand(1, $max);
                $obra = Obra::find($num_aleatorio);
                if (!in_array($num_aleatorio, $valores))
                    if ($obra->estado == 'APROBADO') {
                        array_push($valores, $num_aleatorio);
                        $expo->obras()->attach($obra);
                        $x++;
                    }
            }
        }

    }
}
