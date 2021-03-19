<?php

namespace Database\Factories;

use App\Models\Noticia;
use App\Models\Producto;
use App\Models\Promocion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromocionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promocion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imagenes = [
            'https://image.freepik.com/vector-gratis/banner-elementos-handrawn-venta_125540-187.jpg',
            'https://image.freepik.com/vector-gratis/plantilla-pagina-destino-venta-moda_52683-42763.jpg',
            'https://image.freepik.com/vector-gratis/plantilla-volante-venta-moda_23-2148600396.jpg',
            'https://img.freepik.com/vector-gratis/plantilla-banner-horizontal-venta-invierno_23-2148745038.jpg?size=626&ext=jpg&ga=GA1.2.538780178.1613162641',
            'https://image.freepik.com/vector-gratis/pagina-inicio-venta-moda_52683-42762.jpg',
            'https://image.freepik.com/vector-gratis/plantilla-volante-cuadrado-rebajas-moda-primavera_23-2148835007.jpg',

            'https://image.freepik.com/vector-gratis/fondo-pintado-acuarela-flores-dibujadas-mano_79603-1354.jpg',
            'https://image.freepik.com/vector-gratis/venta-moda-pagina-inicio_23-2148592799.jpg',
            'https://image.freepik.com/vector-gratis/venta-moda-concepto-pagina-destino_23-2148597522.jpg',
            'https://image.freepik.com/vector-gratis/fondo-nueva-llegada-estilo-acuarela_23-2147897268.jpg',
            'https://image.freepik.com/vector-gratis/fondo-floral-abstracto-pintado-mano_52683-16929.jpg',
            'https://image.freepik.com/vector-gratis/banner-venta-moda-moderna_1340-15668.jpg',

            'https://image.freepik.com/vector-gratis/coleccion-publicaciones-instagram-dia-internacional-mujer_23-2148858314.jpg',
            'https://image.freepik.com/vector-gratis/venta-historia-instagram_23-2148865375.jpg',
            'https://image.freepik.com/vector-gratis/tema-plantilla-web-venta-moda_23-2148598270.jpg',
            'https://image.freepik.com/vector-gratis/banner-venta-moderno-estilo-comico-colorido_1361-1314.jpg',
            'https://image.freepik.com/vector-gratis/diseno-coleccion-patrones-corazon_23-2148603211.jpg',
            'https://image.freepik.com/vector-gratis/corazones-rojos-coloridos-paisley-patrones-fisuras_23-2148678998.jpg',

            'https://image.freepik.com/psd-gratis/plantilla-banner-venta-muebles_23-2148715747.jpg',
            'https://image.freepik.com/psd-gratis/plantilla-banner-concepto-flor_23-2148626769.jpg',
            'https://image.freepik.com/psd-gratis/plantilla-volante-concepto-flor_23-2148626776.jpg',
            'https://image.freepik.com/psd-gratis/folleto-cuadrado-plantilla-anuncio-comercial-minimalista_23-2148702197.jpg',
            'https://image.freepik.com/vector-gratis/espectaculo-opera-doodle-dibujado-mano-iconos-elementos-diseno_364776-72.jpg',
            'https://image.freepik.com/vector-gratis/ilustracion-cartel-teatro_1284-9599.jpg',
        ];

        for ($i = 0; $i < sizeof($imagenes); $i++) {

            $promo = Promocion::create([
                'titulo' => $this->faker->sentence(rand(6, 12)),
                'descripcion' => $this->faker->sentence(rand(20, 32)),
                'imagen_path' => $imagenes[$i],
                'banner_path' => $imagenes[$i],
                'bloque' => ($i % 2 == 0) ? 'SUPERIOR' : 'INFERIOR',
            ]);
        }

        $productos = Producto::all();

        foreach ($productos as $producto){
            // dado que hay 10 tag de ejemplo
            $escalon = rand(1, Producto::count()-5);
            $relaciones = rand(1, 5);

            // relacionamiento con los tag
            for ($i = 0; $i < $relaciones; $i++)
                $producto->promocions()->attach($i + $escalon);
        }

        return [
            'titulo' => $this->faker->sentence(rand(6, 12)),
            'descripcion' => $this->faker->sentence(rand(20, 28)),
            'imagen_path' => $imagenes[sizeof($imagenes)-1],
            'banner_path' => $imagenes[sizeof($imagenes)-1],
            'bloque' => 'INFERIOR',
        ];
    }
}
