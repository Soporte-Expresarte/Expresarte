<?php

namespace Database\Seeders;

use App\Models\Noticia;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = [
            'eeuu',
            'modernista',
            'abstracto',
            'antofagasta',
            'feria',
            'robo',
            'santiago',
            'dali',
            'chile',
            'barroco'
        ];

        // creacion de los tag
        foreach ($nombres as $nombre)
            Tag::create([
                'nombre' => $nombre
            ]);

        // asgiancion de relaciones entre noticias y tags
        $noticias = Noticia::all();

        foreach ($noticias as $noticia) {

            // dado que hay 10 tag de ejemplo
            $escalon = rand(1, 8);
            $relaciones = rand(1, 3);

            // relacionamiento con los tag
            for ($i = 0; $i < $relaciones; $i++) {
                $noticia->tags()->attach($i + $escalon);
            }
        }

    }
}
