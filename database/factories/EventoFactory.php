<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $aprobado = ['APROBADO', 'PENDIENTE', 'RECHAZADO'];

        $fotos = [
            'https://live.staticflickr.com/189/492556760_8b53b4681c_b.jpg',
            'https://pics.filmaffinity.com/El_viento_se_levanta-682148018-large.jpg',
            'https://live.staticflickr.com/1856/29374935277_0dc6b83f4a_b.jpg',
            'https://live.staticflickr.com/4137/4868026135_8441f5dcfd_b.jpg',
            'https://live.staticflickr.com/4062/4500210825_c849ac180d_b.jpg',
            'https://i0.wp.com/cinespacio24.mx/wp-content/uploads/2017/04/KOE-Poster-mini-1.jpg',
            'https://www.moshimoshi-nippon.jp/wp/wp-content/uploads/2019/01/e00f185e8cf463e27e20537478b832ad.jpg',
            'https://s.libertaddigital.com/2020/02/11/1920/1080/fit/parasitos-110220.jpg',
            'https://live.staticflickr.com/232/31295735250_6326b5dc34_o.jpg',
            'https://live.staticflickr.com/3775/19379420873_fbe6181d3a_b.jpg',
            'https://live.staticflickr.com/1583/25865213175_de88a612f9_o.jpg',
            'https://www.moviementarios.com/wp-content/uploads/2019/11/El-tiempo-contigo-Cartel.jpg',
            'https://live.staticflickr.com/568/32224774876_70268da36c_b.jpg',
            'https://live.staticflickr.com/8197/28392714891_b574d4b5a0_b.jpg',
            'https://live.staticflickr.com/7669/17329631403_45784fc688_b.jpg',
            'https://live.staticflickr.com/391/18613213704_6df4fef6ba_b.jpg',
            'https://live.staticflickr.com/7740/27022284281_a7feede478_b.jpg',
            'https://pbs.twimg.com/media/ElL8ZcFXEAgNant.jpg',
            'https://www.cultura.gob.cl/wp-content/uploads/2019/10/festival-primavera.jpg',
            'https://live.staticflickr.com/8847/28847310106_cb037b8b04_b.jpg',
            'https://live.staticflickr.com/754/23759489345_65219117d9_b.jpg',
            'https://live.staticflickr.com/4543/37857857994_efea9ed238_b.jpg',
            'http://revistacultural.ecosdeasia.com/wp-content/uploads/2016/11/mak1-698x1024.jpg',
            'https://live.staticflickr.com/411/31463667732_3db9222cd8_b.jpg',
            'https://live.staticflickr.com/7558/28470642326_4b9060888f_b.jpg',
            'https://live.staticflickr.com/5661/21391869042_2962037b48_h.jpg',
            'https://i0.wp.com/anitrendz.net/news/wp-content/uploads/2020/01/HelloWorld2019-Emailer-948w-x1482h-8Jan2020.jpg',
            'https://live.staticflickr.com/8252/29189721290_e4c5e11188_b.jpg',
            'https://live.staticflickr.com/7671/27870125140_c526a67848_b.jpg',
            'https://live.staticflickr.com/65535/49123738257_77bdd4532d_b.jpg',
            'https://live.staticflickr.com/7665/26782584920_d819e74e44_b.jpg',
            'https://i.pinimg.com/originals/a9/24/3e/a9243e0457a3b294e3544759504bd80f.jpg'
        ];

        for ($i = 0; $i < sizeof($fotos) - 1; $i++) {
            $fecha_inicio = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = '+6 months', date_default_timezone_get());

            $evento = Evento::create([
                'titulo' => $this->faker->sentence(rand(6, 12)),
                // duracion en dias
                //'duracion' => $this->faker->(),
                //'duracion' => $this->faker->dateTimeBetween((rand(-30, 30) . ' days'), ('now' . rand(31, 60) . ' days'))->format('Y-m-d'),
                'fecha_evento' => $fecha_inicio,
                'fecha_termino' => $this->faker->dateTimeInInterval($fecha_inicio, '+30 days', date_default_timezone_get()),
                'lugar' => $this->faker->address,
                'descripcion' => $this->faker->paragraph(rand(24, 38)),
                'foto_portada' => $fotos[$i],
                'foto_evento' => $fotos[$i],
                'usuario_id' => rand(1, 13),
                'estado' => $aprobado[rand(0, 1)]
            ]);
        }

        $fecha_inicio = now();

        return [
            'titulo' => $this->faker->sentence(rand(6, 12)),
            // duracion en dias
            //'duracion' => $this->faker->dateTimeBetween((rand(-30, 30) . ' days'), ('now' . rand(31, 60) . ' days'))->format('Y-m-d'),
            'fecha_evento' => $fecha_inicio,
            'fecha_termino' => $this->faker->dateTimeInInterval($fecha_inicio, '+30 days', date_default_timezone_get()),
            'lugar' => $this->faker->address,
            'descripcion' => $this->faker->paragraph(rand(24, 38)),
            'foto_portada' => $fotos[sizeof($fotos) - 1],
            'foto_evento' => $fotos[sizeof($fotos) - 1],
            'usuario_id' => rand(1, 13),
            'estado' => $aprobado[rand(0, 1)],
        ];
    }
}
