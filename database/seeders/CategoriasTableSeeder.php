<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Todas las categorias existentes del sistema.
        Categoria::create(['nombre' => 'Pintura', 'slug' => Str::slug('Pintura')]);
        Categoria::create(['nombre' => 'Escultura', 'slug' => Str::slug('Escultura')]);
        Categoria::create(['nombre' => 'Fotografia','slug' => Str::slug('Fotografia')]);
        Categoria::create(['nombre' => 'Dibujo', 'slug' => Str::slug('Dibujo')]);
        Categoria::create(['nombre' => 'Impresión', 'slug' => Str::slug('Impresión')]);
        Categoria::create(['nombre' => 'Obra en papel', 'slug' => Str::slug('Obra-en-papel')]);
        Categoria::create(['nombre' => 'Textil', 'slug' => Str::slug('Textil')]);
        Categoria::create(['nombre' => 'Digital', 'slug' => Str::slug('Digital')]);
        Categoria::create(['nombre' => 'Armable', 'slug' => Str::slug('Armable')]);
        Categoria::create(['nombre' => 'Musical', 'slug' => Str::slug('Musical')]);
        Categoria::create(['nombre' => 'Sobremesa', 'slug' => Str::slug('Sobremesa')]);
        Categoria::create(['nombre' => 'Retrato', 'slug' => Str::slug('Retrato')]);
        //Categoria::create(['nombre' => 'Marco', 'slug' => Str::slug('Marco')]);
        Categoria::create(['nombre' => 'Instrumento', 'slug' => Str::slug('Instrumento')]);
        Categoria::create(['nombre' => 'Herramienta', 'slug' => Str::slug('Herramienta')]);
        //Categoria::create(['nombre' => 'Pulsera', 'slug' => Str::slug('Pulsera')]);
        //Categoria::create(['nombre' => 'Pantalones', 'slug' => Str::slug('Pantalones')]);
        //Categoria::create(['nombre' => 'Silla', 'slug' => Str::slug('Silla')]);
        //Categoria::create(['nombre' => 'Camisa', 'slug' => Str::slug('Camisa')]);
        //Categoria::create(['nombre' => 'Mesa', 'slug' => Str::slug('Mesa')]);
        Categoria::create(['nombre' => 'Arte Plastico', 'slug' => Str::slug('Arte-Plastico')]);
    }
}
