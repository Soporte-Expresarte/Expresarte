<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Premio;

class PremiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        //Premios Proyecto 1 -> Espacio FURIA
        Premio::create([

            'nombre' => 'ALOHA',
            'descripcion' => 'Agradecimientos en nuestras redes sociales oficiales',
            'precio_minimo' => 2000,
            'cantidad_actual' => 10000,
            'cantidad_maxima' => 10000,
            'proyecto_id' => 1,

        ]);

        Premio::create([

            'nombre' => 'FURIA',
            'descripcion' => 'Agradecimiento en nuestras redes sociales oficiales Set Adhesivos oficiales campaña Ponte con Furia *Envío de adhesivos no incluido',
            'precio_minimo' => 5000,
            'cantidad_actual' => 3000,
            'cantidad_maxima' => 3000,
            'proyecto_id' => 1,

        ]);
        
        Premio::create([

            'nombre' => 'CONFIANZA',
            'descripcion' => 'Agradecimiento en redes sociales y web. Set Adhesivos oficiales campaña Ponte con Furia 15% Descuento por 1 meses en Espacio Furia 
                              (a contar desde tu primera compra) *Envío de adhesivos y compras no incluido',
            'precio_minimo' => 30000,
            'cantidad_actual' => 1000,
            'cantidad_maxima' => 1000,
            'proyecto_id' => 1,

        ]);
		

        //Premios Proyecto 2 -> Taller de bordados
        Premio::create([

            'nombre' => 'Bordado pequeño',
            'descripcion' => 'Bordado con imagen a elección de un diámetro de 20 cm.',
            'precio_minimo' => 10000,
            'cantidad_actual' => 20,
            'cantidad_maxima' => 20,
            'proyecto_id' => 2, 

        ]);

        //Premios Proyecto 3 -> Suculenta Pequeña
        Premio::create([

            'nombre' => 'Suculenta pequeña',
            'descripcion' => 'Plantas pequeñas de adorno',
            'precio_minimo' => 2500,
            'cantidad_actual' => 50,
            'cantidad_maxima' => 50,
            'proyecto_id' => 3, 

        ]);
        
		//Premios proyecto 4 -> Figuritas de anime
        Premio::create([
            'nombre' => 'Tablero ajedrez',
            'descripcion' => 'Tablero de ajedrez mediano, hecho de madera con temática anime.',
            'precio_minimo' => 6000,
            'cantidad_actual' => 50,
            'cantidad_maxima' => 50,
            'proyecto_id' => 4,
        ]);
		
        Premio::create([
            'nombre' => 'Polera De Gon',
            'descripcion' => 'Una polera artesanal del protagonista de HunterxHunter',
            'precio_minimo' => 8000,
            'cantidad_actual' => 10,
            'cantidad_maxima' => 10,
            'proyecto_id' => 4,
        ]);

        // Premio Proyecto 5 -> Película UBERDRIVER
        Premio::create([

            'nombre' => 'Proxeneta',
            'descripcion' => 'Podrás ser parte de un grupo privado donde recibirás material inédito del rodaje',
            'precio_minimo' => 5000,
            'cantidad_actual' => 2000,
            'cantidad_maxima' => 2000,
            'proyecto_id' => 5,

        ]);

        Premio::create([

            'nombre' => 'Rosaaaaa',
            'descripcion' => 'Podrás ser parte de un grupo privado donde recibiras material inedito y apareceras en los creditos',
            'precio_minimo' => 10000,
            'cantidad_actual' => 2000,
            'cantidad_maxima' => 2000,
            'proyecto_id' => 5,

        ]);

        Premio::create([

            'nombre' => 'Guate Sapo',
            'descripcion' =>   'Podrás ser parte de un grupo privado donde recibirás material inédito del rodaje, aparecerás en los créditos y 
                                podrás leer el tercer capítulo de Uber Driver que ya está escrito.',
            'precio_minimo' => 15000,
            'cantidad_actual' => 700,
            'cantidad_maxima' => 700,
            'proyecto_id' => 5,

        ]);

        Premio::create([

            'nombre' => 'Jonathan',
            'descripcion'   => 'Estarás en grupo privado recibiendo material inédito del rodaje, primera aparición en los créditos, libro físico de UberDriver 
                                antes de su publicación firmada, asistir a la alfombra roja junto a todo el elenco, obtención cuentos de El Borrador inéditos, BluRay película, 
                                guión firmada por elenco. Aparición en la película. Foto con Jonathan en su auto con cámara con la que se filmará la película.',
            'precio_minimo' => 100000,
            'cantidad_actual' => 600,
            'cantidad_maxima' => 600,
            'proyecto_id' => 5,

        ]);
        
		//Premios Proyecto 6 -> Incubadora de pollos 
        Premio::create([
            'nombre' => 'Suculenta mas pequeña',
            'descripcion' => 'Una version mini de la suculenta pequeña',
            'precio_minimo' => 4000,
            'cantidad_actual' => 8,
            'cantidad_maxima' => 8,
            'proyecto_id' => 6, 

        ]);

        //Premios Proyecto 7 -> Taller de zapatillas personalizadas
        Premio::create([
            'nombre' => 'Zapatilla Premium',
            'descripcion' => 'Zapatilla hecha con cariño',
            'precio_minimo' => 7000,
            'cantidad_actual' => 10,
            'cantidad_maxima' => 10,
            'proyecto_id' => 7,

        ]);

        //Premios Proyecto 8 -> Recorrido fotografico
        Premio::create([
            'nombre' => 'Set de fotografías',
            'descripcion' => 'Compilado de fotografías de los recorridos de prueba',
            'precio_minimo' => 2000,
            'cantidad_actual' => 400,
            'cantidad_maxima' => 400,
            'proyecto_id' => 8,

        ]);

        //Premios Proyecto 9 -> Ser Machi
        Premio::create([
            'nombre' => 'TEMUCO',
            'descripcion' => 'Aparición en los agradecimientos en los créditos del documental.',
            'precio_minimo' => 5000,
            'cantidad_actual' => 20,
            'cantidad_maxima' => 20,
            'proyecto_id' => 9, 
        ]);

        Premio::create([
            'nombre' => 'CARAHUE',
            'descripcion' => 'Aparición en los agradecimientos en los créditos del documental, Y mejores amigos en RRSS',
            'precio_minimo' => 10000,
            'cantidad_actual' => 15,
            'cantidad_maxima' => 15,
            'proyecto_id' => 9,
        
        ]);

        Premio::create([
            'nombre' => 'BOLLECO',
            'descripcion'  => 'Aparición en los agradecimientos en los créditos del documental. Mejores amigos en RRSS + material inédito del rodaje',
            'precio_minimo' => 25000,
            'cantidad_actual' => 20,
            'cantidad_maxima' => 20,
            'proyecto_id' => 9,
        
        ]);
		
		//Premios Proyecto 10
        Premio::create([
            'nombre' => 'Taza de shingeki',
            'descripcion' => 'Taza de los personajes mas iconicos de attack on titan',
            'precio_minimo' => 4000,
            'cantidad_actual' => 25,
            'cantidad_maxima' => 25,
            'proyecto_id' => 10,
        
        ]);
    }
}
