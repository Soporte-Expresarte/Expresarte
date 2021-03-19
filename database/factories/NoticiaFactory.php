<?php

namespace Database\Factories;

use App\Models\Noticia;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Noticia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $noticias = [
            'https://img3.foto.by/blog/f6121/bb38a/534ad/7a10e75b4f81ddae2.jpg',
            'https://img3.foto.by/blog/8a975/e70e2/6d1c6/1a24cfc401361f921.jpg',
            'https://img3.foto.by/blog/edb32/16f3f/abf76/596d3d8ba4942b86d.jpg',
            'https://img3.foto.by/blog/45151/008d7/08091/1c54802e313ec419d.jpg',
            'https://img3.foto.by/blog/3b86f/de096/2d744/a7b49ea2409e933dc.jpg',
            'https://img3.foto.by/blog/44cc6/65f3b/3b20e/72e3229f53c4f25b2.jpg',
            'https://img3.foto.by/blog/528e2/34c2f/a6894/eb695305b6fb7b112.jpg',
            'https://img3.foto.by/blog/cb75a/0f544/cab6e/40bcbfabce6d04282.jpg',
            'https://img3.foto.by/blog/06df9/b3955/589c9/6deb0111cc9f4494a.jpg',
            'https://img3.foto.by/blog/47b8a/3c07d/77a2c/39d2c58ae628c818e.jpg',
            'https://img3.foto.by/blog/0ebe4/ba511/8a0b6/94eb15e967702a562.jpg',
            'https://img3.foto.by/blog/13401/b7a39/071ae/c5e128aa9de0a717c.jpg',
            'https://img3.foto.by/blog/8b93f/033d8/908ba/3cec6bac2ccebd486.jpg',
            'https://img3.foto.by/blog/a6b37/166a4/e178a/6a691abda5f59ff68.jpg',
            'http://cdn3.upsocl.com/wp-content/uploads/2014/06/410.jpg',
            'https://img3.foto.by/blog/34f96/cb09e/ffd52/5e6483da36b123775.jpg',
            'https://img3.foto.by/blog/30599/8fae0/1f2ac/626850d627abad050.jpg',
            'https://img3.foto.by/blog/27e54/36ac8/687dc/eb03736a622a5d1b1.jpg',
            'https://img3.foto.by/blog/ad3c3/beaad/87b8e/f1c0ee4ac28d41a9f.jpg',
            'https://img3.foto.by/blog/63cc0/ddaca/d672e/3bd18534a58843ab4.jpg',
            'https://img3.foto.by/blog/492e6/857e8/3c040/3951e7a8bcb6169f2.jpg',
            'https://img3.foto.by/blog/64015/93ead/19299/3df4214d9e6a73bb0.jpg',
            'https://img3.foto.by/blog/f1bda/2f3f8/73541/ea8c80f3dad22414a.jpg',
            'https://img3.foto.by/blog/2832f/7b90d/c3dcc/105116f4d3f05fe92.jpg',
            'https://img3.foto.by/blog/ae4af/610d5/ba4df/31a079ecab1e40e78.jpg',
            'https://img3.foto.by/blog/1f674/455c7/4013f/b6e092e8f7c82250e.jpg',
            'https://img3.foto.by/blog/562b7/bf22d/dcace/84aa756c5acbc18ba.jpg',
            'https://img3.foto.by/blog/7161b/862f6/4cf43/8a1335b28e88260a8.jpg',
            'https://img3.foto.by/blog/462c6/75713/9e651/6ee577f07201d47ae.jpg',
            'https://img3.foto.by/blog/d9e3f/c2f8f/b004d/9915fa990732dae37.jpg'
        ];

        for ($i = 0; $i < sizeof($noticias) - 1; $i++) {
            $noticia = Noticia::create([
                'titulo' => $this->faker->sentence(rand(6, 10)),
                'sub_titulo' => $this->faker->sentence(rand(20, 27)),
                'bajada' => $this->faker->paragraph(rand(5, 8)),
                'cuerpo' => $this->faker->paragraph(rand(50, 70)),
                'imagen_path' => $noticias[$i],
                'portada_path' => $noticias[$i],
                'fecha_noticia' => $this->faker->date(),
                'usuario_id' => rand(1, 4),
            ]);
        }

        return [
            'titulo' => $this->faker->sentence(rand(6, 10)),
            'sub_titulo' => $this->faker->sentence(rand(20, 27)),
            'bajada' => $this->faker->paragraph(rand(5, 9)),
            'cuerpo' => $this->faker->paragraph(rand(50, 70)),
            'imagen_path' => $noticias[sizeof($noticias) - 1],
            'portada_path' => $noticias[$i],
            'fecha_noticia' => $this->faker->date(),
            'usuario_id' => rand(1, 4),
        ];
    }

}
