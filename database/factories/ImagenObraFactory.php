<?php

namespace Database\Factories;

use App\Models\ImagenObra;
use App\Models\Model;
use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenObraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagenObra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $pinturas = [
            'https://live.staticflickr.com/65535/50746007811_9cbc4ac678_k.jpg',
            'https://live.staticflickr.com/65535/50745273828_275207a23c_c.jpg',
            'https://live.staticflickr.com/65535/50746117687_4ecf36a81d_c.jpg',
            'https://live.staticflickr.com/65535/50746118107_88f6c1a733_c.jpg',
            'https://live.staticflickr.com/65535/50745275373_744e4bc735_c.jpg',
            'https://live.staticflickr.com/65535/50746118627_c1a6289e9d_c.jpg',
            'https://live.staticflickr.com/65535/50746118697_3fa0d0e8d4_c.jpg',
            'https://live.staticflickr.com/65535/50746011141_4fe1e93012_c.jpg',
            'https://live.staticflickr.com/65535/50745277273_b37000557b_c.jpg',
            'https://live.staticflickr.com/65535/50746121532_f3aff53d78_c.jpg',

            'https://live.staticflickr.com/65535/50745278738_5d5c3ccee2_c.jpg',
            'https://live.staticflickr.com/65535/50745287448_6554466546_c.jpg',
            'https://live.staticflickr.com/65535/50746122507_d901ed822a_c.jpg',
            'https://live.staticflickr.com/65535/50746125707_b31554a507_c.jpg',
            'https://live.staticflickr.com/65535/50746127487_33a9796955_c.jpg',
            'https://live.staticflickr.com/65535/50746023326_a4fa0e21c2_c.jpg',
            'https://live.staticflickr.com/65535/50746019256_13bce2e802_c.jpg',
            'https://live.staticflickr.com/65535/50746127852_c0d070d823_c.jpg',
            'https://live.staticflickr.com/65535/50745284878_a048016294_c.jpg',
            'https://live.staticflickr.com/65535/50745284998_1f604d89dc_c.jpg',

            'https://live.staticflickr.com/65535/50745285098_20500f9158_c.jpg',
            'https://live.staticflickr.com/65535/50746022056_1e288bd076_c.jpg',
            'https://i0.wp.com/www.freim.tv/wp-content/uploads/2017/03/Grant_Wood_-_American_Gothic_-_Google_Art_Project-849x1024.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/La_nascita_di_Venere_%28Botticelli%29.jpg/800px-La_nascita_di_Venere_%28Botticelli%29.jpg',
            'http://3.bp.blogspot.com/-fPQImqtwwdU/Vky-s120mII/AAAAAAAABcA/6pJX30ypg60/s640/Leonid%2BAfremov-00.jpeg',
            'https://topimpressionists.com/Art.nsf/O/8XXRYZ/$File/Claude-Monet-Water-Lilies-61-.JPG',
            'https://i.pinimg.com/originals/2b/03/b2/2b03b286a0ee829f759529726b984f6d.jpg',
            'https://images.fineartamerica.com/images/artworkimages/mediumlarge/1/van-goghs-field-of-poppies-sally-jones.jpg',
            'https://aixcentric.files.wordpress.com/2012/04/woman-parasol-madame-monet-her-son-7_3039.jpg?w=640',
            'https://www.meisterdrucke.es/kunstwerke/500px/Caspar%20David%20Friedrich%20-%20The%20Wanderer%20above%20the%20Sea%20of%20Fog%201818%20%20-%20%28MeisterDrucke-51517%29.jpg',

            'https://lineassobrearte.files.wordpress.com/2014/04/la-virgen.jpg',
            'https://painting-planet.com/images2/muerte-y-vida-gustav-klimt_1.jpg',
            'https://www.publico.es/uploads/2019/12/11/5df0d374b63f1.jpg',
            'https://www.hypeness.com.br/1/2018/03/JCarrey2.jpg',
            'https://i1.wp.com/www.gaio.ninja/wp-content/uploads/2016/04/ttosaLC.png?resize=500%2C671'
        ];

        for ($i = 0; $i < sizeof($pinturas) - 1; $i++) {
            $obra = Obra::factory()->create();

            ImagenObra::create([
                'ruta' => $pinturas[$i],
                'obra_id' => $obra->id,
            ]);
        }

        $obra = Obra::factory()->create();
        return [
            'ruta' => $pinturas[sizeof($pinturas)-1],
            'obra_id' => $obra->id,
        ];
    }
}
