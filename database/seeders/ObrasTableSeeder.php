<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obra;

class ObrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Obra::factory(50)->create();
    }
}
