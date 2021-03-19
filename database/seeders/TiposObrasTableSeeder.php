<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoObra;

class TiposObrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoObra::create(['nombre' => 'Abstracto']);
        TipoObra::create(['nombre' => 'Barroco']);
        TipoObra::create(['nombre' => 'Cubismo']);
        TipoObra::create(['nombre' => 'Dadaista']);
        TipoObra::create(['nombre' => 'Hiperrealismo']);
        TipoObra::create(['nombre' => 'Impresionista']);
        TipoObra::create(['nombre' => 'Pop']);
        TipoObra::create(['nombre' => 'Renacimiento']);
        TipoObra::create(['nombre' => 'Surrealista']);
        TipoObra::create(['nombre' => 'Postmodernista']);

    }
}
