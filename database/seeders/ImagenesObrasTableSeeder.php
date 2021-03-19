<?php

namespace Database\Seeders;

use App\Models\ImagenObra;
use Illuminate\Database\Seeder;

class ImagenesObrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenObra::factory(1)->create();
    }
}
