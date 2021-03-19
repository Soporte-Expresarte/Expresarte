<?php

namespace Database\Seeders;

use App\Models\Promocion;
use Illuminate\Database\Seeder;

class PromocionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promocion::factory(1)->create();
    }
}
