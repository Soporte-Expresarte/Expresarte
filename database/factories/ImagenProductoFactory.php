<?php

namespace Database\Factories;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagenProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imagenes = [
            'https://imagenes.elpais.com/resizer/O9xPnX3OHMBvsLCJlHVN7h6anoc=/768x0/cloudfront-eu-central-1.images.arcpublishing.com/prisa/T75PBFLGB5HOVOWB7OHXRQ4IDA.jpg',
            'https://live.staticflickr.com/65535/50994631687_5febae2720_c.jpg',
            'http://19bis.com/objectbis/wp-content/uploads/2009/06/mueble3.jpg',
            'http://19bis.com/objectbis/wp-content/uploads/2009/06/mueble1.jpg',
            'https://static.turbosquid.com/Preview/2015/12/21__10_26_10/01.jpg3f387eb4-d87a-442a-85f4-929d67c6753bOriginal.jpg',
            'https://diybooster.com/wp-content/uploads/2016/11/driftwood-furniture-7.jpg',
            'https://i.pinimg.com/originals/ae/12/7a/ae127a05f1f0645a79ba24ea0484c833.jpg',
            'https://i.pinimg.com/originals/a5/a0/b5/a5a0b5df3a684d8481a1453517737f0f.jpg',
            'https://i.pinimg.com/originals/6c/d9/7b/6cd97b8b007d520f3d9a55999f916d13.jpg',
            'https://www.hola.com/imagenes/noticias-de-actualidad/2014/05/07/picasso.jpg',

            'https://www.diariodecuyo.com.ar/__export/1540653860975/sites/diariodecuyo/img/2018/10/27/cuadro_portada_1_jpg_525981578.jpg',
            'http://static.t13.cl/images/original/2018/12/1545112115-0009d2ua.jpg',
            'https://www.artmajeur.com/medias/standard/v/i/viviana-vasquez-vega/artwork/11804654_20181220-111140.jpg',
            'https://i.pinimg.com/originals/50/f9/23/50f923a6c4c5e6de4819bf00599f385e.jpg',
            'https://www.artmajeur.com/medias/standard/l/e/leonidafremov/artwork/12031175_hide-and-seek.jpg',
            'https://i.pinimg.com/originals/65/68/d6/6568d6a8c697b109146c973cd0dcdf7e.jpg',
            'https://www.practicaespanol.com/wp-content/uploads/Alt-dos-ni%C3%B1os-observan-el-barco-blanco-de-J%C3%A1vea-de-Sorolla-en-el-Museo-de-los-Impresionistas-de-Giverny-EFE.jpg',
            'https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2015/06/23/14350527622479.jpg',
            'https://assets.catawiki.nl/assets/2019/4/5/b/d/7/bd7c79da-b598-4144-9a12-9a4957ffe2e8.jpg',
            'https://i.pinimg.com/originals/a5/98/ba/a598ba4970d1eaa2c462c3332c88b1c5.jpg',

            'https://www.hoyesarte.com/wp-content/uploads/2018/08/i-puesta-de-sol-la-fortaleza-i-1914-1936-anglada-camarasa-c-coleccion-la-caixa-anglada-camarasa.jpg',
            'http://www.lahornacina.com/images28/anglada02.jpg',
            'https://www.epdlp.com/fotos/anglada4.jpg',
            'https://valenciaplaza.com/public/Image/2017/1/Joaquin-Sorolla-Y-Bastida-Clotilde-and-Elena-on-the-Rocks-at-Javea_NoticiaAmpliada.jpg',
            'https://www.nacion.com/resizer/gLkSF0m4EcuByZTZga815rw2IxE=/600x0/center/middle/filters:quality(100)/arc-anglerfish-arc2-prod-gruponacion.s3.amazonaws.com/public/7XFTINXYQBAXVAM74TOVOJA54Y.jpg',
            'https://corprensa-mi-diario-prod.cdn.arcpublishing.com/resizer/IKPtaaWs1gO1DUTsxHqQpbcMd3Y=/fit-in/1000x1000/smart/arc-anglerfish-arc2-prod-corprensa.s3.amazonaws.com/public/PBTJAIWHEZBIXCG7A2WSOQYKHI.jpg',
            'https://www.allcitycanvas.com/wp-content/uploads/2018/09/Cortes%C3%ADa-David-Hockney.jpg',
            'https://www.allcitycanvas.com/wp-content/uploads/2018/09/Garrowby-Hill-David-Hockney.-Cortes%C3%ADa-Notishop.jpg',
            'https://image.posta.com.mx/sites/default/files/screen_shot_2018-04-05_at_5.04.47_pm.jpg',
            'https://i0.wp.com/wipy.tv/wp-content/uploads/2019/02/000_1D65FC.jpg',

            'https://3.bp.blogspot.com/-lD0f0PTugEU/U0mqV_CbS2I/AAAAAAABsG0/HTICcR7LPqU/s1600/1STEVE-33.jpg',
            'http://1.bp.blogspot.com/-KVI8wK1vJHU/VE6q_0ZXvdI/AAAAAAAA5Q4/SHmNt32X1S8/s1600/Alexei%2BJawlensky%2B-.jpg',
            'https://www.erinhanson.com/Content/InventoryImages/Erin-Hanson-Texan-Sky-III.jpg',
        ];

        for ($i = 0; $i < sizeof($imagenes) - 1; $i++) {
            $producto = Producto::factory()->create();

            ImagenProducto::create([
                'ruta' => $imagenes[$i],
                'producto_id' => $producto->id,
            ]);
        }

        $producto = Producto::factory()->create();
        return [
            'ruta' => $imagenes[sizeof($imagenes) - 1],
            'producto_id' => $producto->id
        ];
    }
}
