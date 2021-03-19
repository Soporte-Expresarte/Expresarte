<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;
use Illuminate\Support\Str;


class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Todos los temas existentes en el sistema.
        Tema::create(['nombre' => 'Abstracción', 'slug' => Str::slug('Abstracción')]);
        Tema::create(['nombre' => 'Animales', 'slug' => Str::slug('Animales')]);
        Tema::create(['nombre' => 'Autorretrato', 'slug' => Str::slug('Autorretrato')]);
        Tema::create(['nombre' => 'Conceptual', 'slug' => Str::slug('Conceptual')]);
        Tema::create(['nombre' => 'Cultura pop', 'slug' => Str::slug('Cultura-pop')]);
        Tema::create(['nombre' => 'Desnudo', 'slug' => Str::slug('Desnudo')]);
        Tema::create(['nombre' => 'Fantasía', 'slug' => Str::slug('Fantasía')]);
        Tema::create(['nombre' => 'Era digital', 'slug' => Str::slug('Era-digital')]);
        Tema::create(['nombre' => 'Historia y política', 'slug' => Str::slug('Historia-y-política')]);
        Tema::create(['nombre' => 'Naturaleza', 'slug' => Str::slug('Naturaleza')]);
        Tema::create(['nombre' => 'Paisajismo', 'slug' => Str::slug('Paisajismo')]);
        Tema::create(['nombre' => 'Provocativo', 'slug' => Str::slug('Provocativo')]);
        Tema::create(['nombre' => 'Religión', 'slug' => Str::slug('Religión')]);
        Tema::create(['nombre' => 'Retrato', 'slug' => Str::slug('Retrato')]);
        Tema::create(['nombre' => 'Street art', 'slug' => Str::slug('Street-art')]);
        Tema::create(['nombre' => 'Urbano', 'slug' => Str::slug('Urbano')]);
    }
}
