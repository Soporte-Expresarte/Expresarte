<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Despacho;

class DespachosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Despacho::factory(50)->create();
    }
}
