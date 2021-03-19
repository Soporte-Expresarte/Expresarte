<?php

namespace Database\Seeders;

use App\Models\Carrusel;
use App\Models\CarruselCompleto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CarruselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secciones = [
            'inicio',
            'artistas',
            'obras',
            'exposiciones',
            'noticias',
            'eventos',
            'market',
            'crowdfunding'
        ];

        $banners = [
            'https://eu02.edcwb.com/img/web/header/tema/22.jpg',
            'https://live.staticflickr.com/65535/50936447977_06b4a64de4_h.jpg',
            'https://live.staticflickr.com/65535/50936632626_275da082d3_h.jpg',

            'https://live.staticflickr.com/65535/50933836716_78491ce862_h.jpg',
            'https://live.staticflickr.com/65535/50933888586_b9461a3fb1_h.jpg',
            'https://themuseum.ca/wp-content/uploads/2019/04/AddColour_1600x484.jpg',

            'https://assets.bespokepost.com/media/W1siZiIsIjIwMTYvMDIvMjQvMTkvMjcvMTEvMzQ0L2FydF9wcmludF9jb2xsZWN0aW9uX2Jhbm5lcl90ZW1wbGF0ZS5qcGciXSxbInAiLCJ0aHVtYiIsIjE0MTB4XHUwMDNlIl1d/art-print-collection-banner-template.jpg?sha=1be2a57e7c34382d',
            'https://live.staticflickr.com/65535/50936700677_169cd68733_h.jpg',
            'https://live.staticflickr.com/65535/50935928533_c5dc7dddeb_b.jpg',

            'https://jirehtravel.co/wp-content/uploads/2019/12/04_Harbin_ice_Sculpture-1572607815.jpg',
            'https://live.staticflickr.com/65535/50935503108_d611660e13_h.jpg',
            'https://live.staticflickr.com/65535/50935476318_167ba3892e_h.jpg',

            'http://media.fclmedia.com/global-images/ta/destinations/italy/banner/destinations-europe-italy.jpg',
            'https://live.staticflickr.com/65535/50934158747_f070e8e10e_h.jpg',
            'https://s3.amazonaws.com/global-db-public/global-db-public/event/image/10904/nov27_banner_womanshoppingatfruitstall.png',

            'https://live.staticflickr.com/65535/50933435933_f233e8e186_h.jpg',
            'https://live.staticflickr.com/65535/50934145536_f2a445dbba_h.jpg',
            'https://www.sparkarena.co.nz/userfiles/image/events/banner_1660.jpg',

            'https://i.pinimg.com/originals/45/03/56/450356bdf246de920d79dbe86a16ac81.jpg',
            'https://cdn.shopify.com/s/files/1/1886/7221/files/banner-mascarilla-3_1400x.progressive.jpg',
            'https://live.staticflickr.com/65535/50947029192_65c75f9121_h.jpg',

            'https://live.staticflickr.com/65535/50963892192_bd9374f904_h.jpg',
            'https://live.staticflickr.com/65535/50963172748_db7af0089e_h.jpg',
            'https://live.staticflickr.com/65535/50963208223_ee4f6f7dd2_h.jpg'
        ];

        foreach ($secciones as $seccion)
            CarruselCompleto::create([
                'seccion' => $seccion,
                'usuario_id' => 1
            ]);

        $banner_counter = 0;
        foreach (CarruselCompleto::all() as $completo)
            Carrusel::factory(3)->create(['carrusel_completo_id' => $completo->id]);

        foreach (Carrusel::all() as $carrusel) {
            $carrusel->banner = $banners[$banner_counter];
            $carrusel->save();
            $banner_counter++;
        }

        $carrusel_1 = Carrusel::find(1);
        $carrusel_1->titulo = 'APOYA A L@S ARTISTAS LOCALES';
        $carrusel_1->link = '#';
        $carrusel_1->descripcion = ' La cuarentena aún continúa. La coyuntura nos hace reflexionar acerca de como cada vez es más la imperiosa la forma de conectarnos.';
        $carrusel_1->save();
    }
}
