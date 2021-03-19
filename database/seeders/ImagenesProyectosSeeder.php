<?php

namespace Database\Seeders;

use App\Models\ImagenProyecto;
use Illuminate\Database\Seeder;

class ImagenesProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ImagenProyecto::factory(50)->create();

        //Proyecto #1
        ImagenProyecto::create([
			'ruta'		  => 'images/crowdfunding/muestra/1_g1.jpeg',
			'proyecto_id' => 1,
        ]);

		ImagenProyecto::create([
			'ruta'		  => 'images/crowdfunding/muestra/1_g2.jpeg',
			'proyecto_id' => 1,
        ]);

		ImagenProyecto::create([
			'ruta'		  => 'images/crowdfunding/muestra/1_g3.jpeg',
			'proyecto_id' => 1,
        ]);

		ImagenProyecto::create([
			'ruta'		  => 'images/crowdfunding/muestra/1_g4.jpeg',
			'proyecto_id' => 1,
        ]);

        // Proyecto #2

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/2_g1.jpg',
            'proyecto_id' => 2,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/2_g2.jpg',
            'proyecto_id' => 2,
        ]);


        // Proyecto #3
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/3_g1.jpeg',
            'proyecto_id' => 3,
        ]);
		ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/3_g4.jpeg',
            'proyecto_id' => 3,
        ]);
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/3_g5.jpeg',
            'proyecto_id' => 3,
        ]);

        //Proyecto #4
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/4_g1.jpeg',
            'proyecto_id' => 4,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/4_g2.jpeg',
            'proyecto_id' => 4,
        ]);


        #Proyecto 5
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/5_g1.jpeg',
            'proyecto_id' => 5,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/5_g2.jpeg',
            'proyecto_id' => 5,
        ]);

        #Proyecto 6
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/6_g1.png',
            'proyecto_id' => 6,
        ]);

        #Proyecto 7
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/7_g1.jpeg',
            'proyecto_id' => 7,
        ]);


        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/7_g2.jpg',
            'proyecto_id' => 7,
        ]);

        #Proyecto 8
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/8_g1.jpeg',
            'proyecto_id' => 8,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/8_g2.jpeg',
            'proyecto_id' => 8,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/8_g3.jpg',
            'proyecto_id' => 8,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/8_g4.jpeg',
            'proyecto_id' => 8,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/8_g5.jpeg',
            'proyecto_id' => 8,
        ]);

		#Proyecto 9
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/9_g1.jpeg',
            'proyecto_id' => 9,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/9_g2.jpeg',
            'proyecto_id' => 9,
        ]);

		#Proyecto 10
        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/10_g1.jpeg',
            'proyecto_id' => 10,
        ]);

        ImagenProyecto::create([
            'ruta'        => 'images/crowdfunding/muestra/10_g2.jpeg',
            'proyecto_id' => 10,
        ]);


    }
}
