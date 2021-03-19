<?php

namespace Database\Seeders;

use DateInterval;
use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use Carbon\Carbon;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentEstado = ['EN CURSO', 'FINALIZADO', 'CANCELADO'];
        $interval = new DateInterval('P30D');

        // Proyecto 1
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-4 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Espacio FURIA',
            'descripcion' => 'Espacio FURIA será una vitrina para creadores y emprendedores locales, una invitación a conocer otras formas de ser comunidad y
                                    mover la economía local. En nuestra tienda el publico podrá encontrar más de 20 marcas de diferentes rubros, también participar
                                    de una amplia oferta de talleres y cursos enfocados en las artes, oficios, bienestar personal y colectivo. Uno de nuestros objetivos
                                    es crear juntxs comunidad en torno al arte. Quisque vehicula diam magna, quis efficitur lorem pharetra et. Etiam ac erat vel sapien ullamcorper commodo a ac ante. Proin eget augue sed nibh tempor dapibus vitae at turpis. Nam eu urna at odio sodales luctus. Nunc a sodales ligula. Nullam feugiat enim eu eros aliquet, at fermentum nisl iaculis. Donec tempor quis erat ut tempor. Sed mi elit, maximus at eleifend at, sagittis sed nisl. Mauris viverra faucibus finibus. Praesent id mollis felis. Cras velit turpis, congue eget augue at, pulvinar viverra ante.',
            'sub_titulo' => 'ESPACIO FURIA Tienda de Diseño Independiente de emprendedores. Uspendisse commodo erat vel erat aliquam blandit.',
            //'duracion_dias' => 90,
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/4qn3RH_OhpM',
            'imagen_portada' => 'images/crowdfunding/muestra/1_p.png',
            'usuario_id' => 2,
        ]);

        // Proyecto 2
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-6 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Taller de bordados',
            'descripcion' => 'Taller para la confección de bordados
                                    personalizados a pedido, además del impartir de cursos de distintos niveles. Quisque eleifend rutrum mauris id suscipit. Curabitur dictum purus a nisl aliquet mollis. Quisque eget felis blandit, dignissim tellus non, mattis metus. Pellentesque euismod viverra mi, ut fermentum turpis consequat nec. Sed luctus velit vel lorem fermentum vestibulum. Maecenas semper tortor quis lacus pretium, eu iaculis tortor consequat. Phasellus ac tempus nisl. Nam non blandit diam, interdum sodales arcu. Mauris congue tellus lacus. Donec ac pellentesque turpis. Pellentesque scelerisque libero vel metus convallis tristique. Nulla mauris nunc, gravida non mattis nec, convallis quis magna.',
            'sub_titulo' => 'dedicación y cariño. Aliquam scelerisque, tortor in aliquam egestas, ipsum metus hendrerit turpis, quis ultrices est nisl pharetra felis.',
            //'duracion_dias' => 90,
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/IsQMk1q5n-0',
            'imagen_portada' => 'images/crowdfunding/muestra/2_p.jpg',
            'usuario_id' => 3,
        ]);


        // Proyecto 3
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-3 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Suculenta Pequeña',
            'descripcion' => 'En la vida existen muchos tipos de plantas, pero ninguna se compara a una suculenta, es por esto que buscamos recaudar fondos para plantar suculentas.  Phasellus laoreet porttitor pellentesque. Suspendisse sapien tellus, pharetra ac laoreet in, posuere nec erat. Etiam massa velit, iaculis eu aliquam in, tempus quis sem. Maecenas ac ullamcorper eros. Donec dolor purus, volutpat sit amet est at, faucibus cursus elit. Aliquam bibendum vitae velit ut consequat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin eget dolor efficitur, ornare nisi eu, porttitor ligula.',
            'sub_titulo' => 'Bonitas Suculentas. Fusce non dolor sagittis, scelerisque ex a, convallis diam.',
            //'duracion_dias' => 42,
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://youtube.com/embed/9Ehugmz9dnM',
            'imagen_portada' => 'images/crowdfunding/muestra/3_p.jpeg',
            'usuario_id' => 3,

        ]);


        // Proyecto 4
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-6 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Figuritas de anime',
            'descripcion' => 'Emprendimiento basado en las figuritas de personajes de anime, hechas a mano con mucho cariño para todos. Morbi consectetur ligula lacinia tortor sollicitudin sagittis. Cras eget sollicitudin enim. Nullam sed pretium orci. Phasellus eget dui quis purus rhoncus sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum id mollis libero. Duis ultricies eleifend neque ut pellentesque. Cras porta nec quam ac consectetur. In non diam quam. Nulla maximus dui nec diam luctus gravida. Sed rutrum eros ac venenatis fermentum. Donec posuere, leo vitae tincidunt consectetur, tortor metus sollicitudin nibh, sed ullamcorper massa libero ac mi. In hendrerit eleifend maximus. Aliquam consequat convallis ex vitae luctus. Morbi tincidunt quam a finibus volutpat.',
            'sub_titulo' => 'Figuras coleccionables. Nullam condimentum ex sit amet lorem facilisis, nec elementum tellus lacinia. Aliquam interdum leo varius arcu pharetra, vitae vulputate nibh blandit.',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://youtube.com/embed/qb5Z8E0MoLY',
            'imagen_portada' => 'images/crowdfunding/muestra/4_p.jpeg',
            'usuario_id' => 3,
        ]);

        // Proyecto 5
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-2 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Película UBERDRIVER',
            'descripcion' => 'Después de tanto tiempo golpeando puertas llegó el día en que este niño que no quiere nacer al fin pueda ver la luz.
                                    Podríamos hacer historia, son 100 millones de pesos que vamos a recaudar entre las miles de personas que me han acompañado
                                    durante estos 4 años en esta página llamada El Borrador. Morbi vitae hendrerit mauris, id pulvinar odio. Fusce ullamcorper, nulla at sodales vulputate, dolor sem cursus ante, eu ultricies nunc neque ac dui. Ut rhoncus urna nunc, eget lacinia sapien ullamcorper ut. Donec ligula est, convallis non congue vel, semper eget metus. Etiam ut viverra nunc. Proin lacus nibh, dictum sit amet euismod a, ultrices et lacus.',
            'sub_titulo' => 'Donaciones para filmar la película independiente UBERDRIVER. Suspendisse sed velit felis. Curabitur libero velit, dictum sit amet neque et, maximus pellentesque augue.',
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/1kh0Ho2P7zw',
            'imagen_portada' => 'images/crowdfunding/muestra/5_p.jpeg',
            'usuario_id' => 2,
        ]);

        //Proyecto 6
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-6 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Incubadora de pollos',
            'sub_titulo' => 'Salvemos a los pollos de estas incubadoras industriales y creemos en conjunto incubadoras bonitas para liberarlos de su destino. Ut mattis rutrum justo, nec pellentesque quam sagittis a.',
            'descripcion' => 'Curabitur porttitor ullamcorper eleifend. Cras quis sem ante. Integer sed erat eros. Nam auctor at quam vitae pulvinar. Sed tincidunt facilisis mauris non tincidunt. Nulla semper vel sapien quis lobortis. Phasellus eu nisi neque. Phasellus tristique posuere orci sit amet maximus. Donec interdum tellus magna, vel pharetra metus consectetur eu. Aenean elementum urna nulla, et efficitur massa ullamcorper nec. Curabitur cursus dolor sed risus dictum, eu auctor nisl rutrum. Donec laoreet dignissim vehicula. Vivamus vestibulum sagittis consequat. Vivamus nibh quam, mattis eget lorem in, rhoncus blandit libero. Fusce non dolor sagittis, scelerisque ex a, convallis diam. Donec arcu nunc, blandit ac erat eget, tristique elementum nisl. Phasellus lacinia tellus id velit facilisis ornare.',
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://youtube.com/embed/a63CeA9o78s',
            'imagen_portada' => 'images/crowdfunding/muestra/6_p.png',
            'usuario_id' => 2,
        ]);

        // Proyecto 7
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-1 month', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Taller de zapatillas personalizadas',
            'descripcion' => 'Cuidado y dedicación. Etiam ac erat vel sapien ullamcorper commodo a ac ante. Proin eget augue sed nibh tempor dapibus vitae at turpis. Nam eu urna at odio sodales luctus. Nunc a sodales ligula. Nullam feugiat enim eu eros aliquet, at fermentum nisl iaculis. Donec tempor quis erat ut tempor. Sed mi elit, maximus at eleifend at, sagittis sed nisl. Mauris viverra faucibus finibus. Praesent id mollis felis. Cras velit turpis, congue eget augue at, pulvinar viverra ante. Praesent blandit malesuada nisl ac scelerisque. Suspendisse iaculis aliquet dui eu ornare. Nullam condimentum ex sit amet lorem facilisis, nec elementum tellus lacinia. Aliquam vestibulum magna vel arcu cursus dapibus. Proin fringilla et eros eget elementum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam ut massa id augue euismod fermentum vel eu mauris.',
            'sub_titulo' => 'Cuidado y dedicación. Duis placerat leo a arcu accumsan, at sodales neque viverra. Vivamus aliquet purus ac rutrum ornare. ',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'aprobado' => 'SI',
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/iy_oDaUozyU',
            'imagen_portada' => 'images/crowdfunding/muestra/7_p.jpeg',
            'usuario_id' => 4,

        ]);

        // Proyecto 8
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-3 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Viajes recorridos fotografiados',
            'descripcion' => 'Vestibulum sagittis hendrerit arcu id lobortis. Cras vitae ex interdum, sodales nunc at, dictum nunc. Suspendisse potenti. Curabitur dictum purus a nisl aliquet mollis. Quisque eget felis blandit, dignissim tellus non, mattis metus. Pellentesque euismod viverra mi, ut fermentum turpis consequat nec. Sed luctus velit vel lorem fermentum vestibulum. Maecenas semper tortor quis lacus pretium, eu iaculis tortor consequat. Donec cursus ex viverra, rutrum nunc at, elementum lectus. Nullam elit dolor. Quisque vulputate cursus nunc non fermentum. Curabitur vel nisi eget arcu dictum ultrices. Phasellus laoreet non enim ut laoreet. Aliquam bibendum vitae velit ut consequat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin eget dolor efficitur, ornare nisi eu, porttitor ligula. Praesent sagittis pulvinar massa sit amet scelerisque. ',
            'sub_titulo' => 'Viaje inspiracional. Aliquam scelerisque, tortor in aliquam egestas, ipsum metus hendrerit turpis. Maecenas semper tortor quis lacus pretium, eu iaculis tortor consequat. ',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/tgXQuHqk-6Q',
            'imagen_portada' => 'images/crowdfunding/muestra/8_p.jpeg',
            'usuario_id' => 2,
        ]);

        // Proyecto 9
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-6 month', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+3 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Ser Machi - Ser Machi',
            'descripcion' => 'Sumergidos en la naturaleza nativa de los territorios ancestrales mapuche, viven las y los Machi. Personas que no eligieron su vocación,
                                    sino más bien, el destino y la decisión de Chaw Ngenechen, dios padre dentro de la cosmovisión mapuche, fue lo que irremediablemente les
                                    conllevó a conectar con sus emociones y sentires espirituales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vehicula iaculis sapien ac fringilla. Vestibulum placerat metus tristique tortor aliquet, nec luctus leo tincidunt. Fusce leo justo, ullamcorper quis gravida pharetra',
            'sub_titulo' => 'Documental que narra un viaje a lo más profundo del Wallmapu. vel eros pharetra egestas. Praesent vitae velit vitae nunc posuere aliquam',
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/2S83jmJyZnI',
            'imagen_portada' => 'images/crowdfunding/muestra/9_p.jpeg',
            'usuario_id' => 4,
        ]);

        // Proyecto 10
        $fecha_inicio = DateTime::dateTimeBetween($startDate = '-3 months', today(), date_default_timezone_get());
        $fecha_limite = DateTime::dateTimeInInterval($fecha_inicio->add($interval), '+2 months', date_default_timezone_get());
        Proyecto::create([
            'titulo' => 'Tazas con diseños personalizados!!',
            'descripcion' => 'Es difícil para mí pedir apoyo para mi empresa, especialmente en el clima
                                    actual. Después de ser inicialmente reacio a iniciar una campaña de
                                    Kickstarter, muchos de ustedes me han animado a hacer esto. Esta es una
                                    gran pregunta y realmente agradezco cualquier apoyo ofrecido; ya sea la
                                    compra de una recompensa o compartir el proyecto en las redes sociales.',
            'sub_titulo' => 'Hermosas tazas con diseños innovadorers. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus sem',
            'aprobado' => 'SI',
            'fecha_inicio' => $fecha_inicio,
            'fecha_limite' => $fecha_limite,
            'duracion_dias' => (int)$fecha_inicio->diff($fecha_limite)->days,

            'estado' => ($fecha_limite > now()) ? $currentEstado[0] : $currentEstado[1],
            'monto_actual' => rand(0, 10000000),
            'meta' => rand(500000, 10000000),
            'contador_visitas' => rand(100, 32000),
            'url_video' => 'https://www.youtube.com/embed/tVanMY27xDE',
            'imagen_portada' => 'images/crowdfunding/muestra/10_p.jpeg',
            'usuario_id' => 4,
        ]);


        // proyectos hechos en factory
        Proyecto::factory(1)->create();
    }
}
