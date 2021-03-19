<?php

namespace Database\Factories;

use App\Models\ImagenProyecto;
use App\Models\Proyecto;
use DateInterval;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

class ProyectoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proyecto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $imagenes_proyectos = [
            'https://live.staticflickr.com/65535/50970116342_2461de08ae_b.jpg',
            'https://live.staticflickr.com/65535/50970025111_1da5d829df_b.jpg',
            'https://energiahoy.com/wp-content/uploads/2020/08/webinar-ibm2.jpg',

            'https://www.muycomputer.com/wp-content/uploads/2018/07/octopath-traveller-1000x600.jpg',
            'https://i.blogs.es/a62c6f/231923_776880/840_560.jpeg',

            'https://www.carlinaldaia.es/wp-content/uploads/2020/04/36.jpg',
            'https://www.criarconsentidocomun.com/wp-content/uploads/2019/11/pintar-01-768x512.jpg',
            'https://images.freeimages.com/images/premium/previews/9475/9475505-little-children-painting.jpg',

            'https://live.staticflickr.com/65535/50969423138_b23453511c_b.jpg',
            'https://live.staticflickr.com/65535/50970230072_e3e8133f9d_c.jpg',

            'https://cadenaser00.epimg.net/ser/imagenes/2018/01/15/television/1516010940_380173_1516014149_noticia_normal.jpg',
            'https://pbs.twimg.com/media/CniYEiEWIAAu9_h.jpg',
            'https://www.talkingdeadpodcast.com/wp-content/uploads/2019/09/fear-the-walking-dead-episode-515-strand-domingo-morgan-james-post-2560-1280x720-800x500.jpg',


            'https://miro.medium.com/max/604/1*L1pSdVfWZwnG2omW_RGTWw.jpeg',
            'https://live.staticflickr.com/65535/50970147201_6bf1cf31ee_c.jpg',

            'https://live.staticflickr.com/65535/50969513538_7756f5f07d_b.jpg',
            'https://live.staticflickr.com/65535/50970213991_402d6d47cb_b.jpg',
            'https://live.staticflickr.com/65535/50970213471_747a979685_b.jpg',

            'https://ae01.alicdn.com/kf/HTB1kZJ5NXXXXXaaapXXq6xXFXXXp/Nueva-Marca-de-Alta-Calidad-Voylet-H-827A-1-4-1-7-MM-Boquilla-600-ML.jpg',
            'https://ae01.alicdn.com/kf/HTB1TJ14LVXXXXXSapXXq6xXFXXXF/PISTOLA-de-PULVERIZACI-N-PISTOLA-de-PULVERIZACI-N-HVLP-SERIE-H-827-VOYLET-para-la-pintura.jpg',

            'https://live.staticflickr.com/65535/50970383487_3653b7182c_b.jpg',
            'https://live.staticflickr.com/65535/50970276311_0db928165e_c.jpg',
            'https://live.staticflickr.com/65535/50969576233_93d5ba007f_c.jpg',

            'https://live.staticflickr.com/65535/50969732353_b83d0ef364_c.jpg',
            'https://live.staticflickr.com/65535/50970532867_a2ab7c42ea_c.jpg',
        ];

        $imagenes_portadas = [
            'https://live.staticflickr.com/65535/50970105732_697fc55182_b.jpg',
            'https://live.staticflickr.com/65535/50970049846_6ee872ac02_b.jpg',
            'https://live.staticflickr.com/65535/50970083191_dbd7640b34_b.jpg',
            'https://ecs7.tokopedia.net/img/cache/700/product-1/2018/4/30/13169043/13169043_ffa2875b-d950-4ce6-af96-7c81faa6c0d8_2048_2048.jpg',
            'https://i.blogs.es/f8eba6/the-walking-dead-temporada-8-trailer/1366_2000.jpg',

            'https://live.staticflickr.com/65535/50970256542_c886a19f0e_b.jpg',
            'https://live.staticflickr.com/65535/50969514138_0b1e08b434_b.jpg',
            'https://live.staticflickr.com/65535/50969499103_978d1911a8_o.jpg',
            'https://live.staticflickr.com/65535/50970278741_aab2d11637_b.jpg',
            'https://live.staticflickr.com/65535/50969726583_21c4ee2d4e_b.jpg',
        ];

        $urls_videos = [
            'https://www.youtube.com/embed/UZT22zQRbOw',
            'https://www.youtube.com/embed/Fmi8KrntszI',
            'https://www.youtube.com/embed/idtzDXHIvJA',
            'https://www.youtube.com/embed/ZwzBm9Cd-SI',
            'https://www.youtube.com/embed/DB8x81nL8B0',

            'https://www.youtube.com/embed/Y5ISn-TZdFo',
            'https://www.youtube.com/embed/zfFtmqkWnOk',
            'https://www.youtube.com/embed/zNJ6Yvw4OZs',
            'https://www.youtube.com/embed/T5ynYRW7XSk',
            'https://www.youtube.com/embed/T-sP7r6hsao',
        ];

        $currentEstado = ['EN CURSO', 'FINALIZADO', 'CANCELADO'];
        $currentAprobado = ['SI', 'PENDIENTE', 'NO'];
        $img_posicion_actual = 0;
        $interval = new DateInterval('P30D');

        // creaciond e las imagenes
        for ($i = 0; $i < (sizeof($imagenes_portadas) - 1); $i++) {

            $fecha_inicio = $this->faker->dateTimeBetween($startDate = '-2 months', today(), date_default_timezone_get());
            $fecha_limite = $this->faker->dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());

            $the_proyecto = Proyecto::create([
                'titulo' => $this->faker->sentence(rand(6, 12), $variableNbWords = true),
                'descripcion' => $this->faker->paragraph(rand(24, 48)),
                'sub_titulo' => $this->faker->sentence(rand(16, 24), $variableNbWords = true),
                'monto_actual' => rand(0, 1000000),
                'meta' => rand(100000, 10000000),

                'fecha_inicio' => $fecha_inicio,
                'fecha_limite' => $fecha_limite,
                'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,
                'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],

                //'estado' => $currentEstado[rand(0, 2)],
                'aprobado' => 'SI',
                'url_video' => $urls_videos[$i],
                'imagen_portada' => $imagenes_portadas[$i],
                'contador_visitas' => rand(0, 10000),
                'usuario_id' => rand(2, 4),
            ]);

            $num_images = ($i % 2 == 0) ? 3 : 2;

            for ($j = 0; $j < $num_images; $j++) {
                $the_imagen = ImagenProyecto::create([
                    'ruta' => $imagenes_proyectos[$img_posicion_actual],
                    'proyecto_id' => $the_proyecto->id
                ]);

                $img_posicion_actual++;
            }

            if ($i == (sizeof($imagenes_portadas) - 2)) {
                for ($j = 0; $j < 2; $j++)
                    $the_imagen = ImagenProyecto::create([
                        'ruta' => $imagenes_proyectos[$img_posicion_actual],
                        'proyecto_id' => $the_proyecto->id + 1
                    ]);
            }
        }


        $fecha_inicio = $this->faker->dateTimeBetween($startDate = '-6 months', today(), date_default_timezone_get());
        $fecha_limite = $this->faker->dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());

        return [
            'titulo' => $this->faker->sentence(rand(6, 12), $variableNbWords = true),
            'descripcion' => $this->faker->paragraph(rand(24, 64)),
            'sub_titulo' => $this->faker->sentence(rand(16, 24), $variableNbWords = true),
            'monto_actual' => rand(0, 1000000),
            'meta' => rand(100000, 10000000),

            //'fecha_inicio' => $this->faker->dateTimeThisMonth($max = 'now', date_default_timezone_get()),
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,
            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],

            'aprobado' => 'SI',
            'url_video' => $urls_videos[sizeof($urls_videos) - 1],
            'imagen_portada' => $imagenes_portadas[sizeof($imagenes_portadas) - 1],
            'contador_visitas' => rand(0, 10000),
            'usuario_id' => rand(2, 4),
        ];
    }
}
