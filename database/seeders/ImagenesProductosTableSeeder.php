<?php

namespace Database\Seeders;

use App\Models\ImagenProducto;
use Illuminate\Database\Seeder;

class ImagenesProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenProducto::factory(1)->create();
    }
}
