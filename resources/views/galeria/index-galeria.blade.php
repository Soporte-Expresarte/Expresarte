<x-galeria-layout>
    @section('title')
        Home
    @endsection
<!--  Usando swiperjs   -->
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/galeria/galeria.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <link rel="stylesheet" href="{{asset('css/galeria/paginacion.css')}}">

        <style>
            .limitlines1 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 1; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines2 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines3 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines4 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 4; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        </style>
    @endsection

<!--  Carrusel   -->
    @section('content')
        @livewire('carrusel-unico', ['tipo'=>'galeria'])

        <section class="bg-white max-w-8xl mx-auto py-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 text-center py-4">
                <h2 class="bg-black text-white font-medium">
                    Síguenos
                </h2>
                <h2 class="bg-gray-100 text-black font-medium">
                    Expresa tu arte
                </h2>
                <h2 class="bg-blue-800 text-white font-medium">
                    Arte para el cambio
                </h2>
            </div>
        </section>

        <div class="bg-cover bg-center"
             style="background-image: url('https://foodandtravel.mx/wp-content/uploads/2020/02/VanGoghAlive.jpg')">
            <div class="px-6">
                <div class="lg:max-w-4xl w-full mx-auto">

                    <div class="h-16"></div>
                    <!-- TITULO PRINCIPÁL-->
                    <div class="text-center text-white font-sans text-4xl md:py-10 py-6 ">
                        <p class="rounded-xl bg-gray-800 bg-opacity-25">Nuestros Artistas</p>
                        <hr class="max-w-xl mx-auto my-6 border-2">
                    </div>

                    <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse(App\Models\User::all()->where('current_team_id', '=', '2')->take(3) as $artista)
                            <div
                                class="hover:bg-gray-200 bg-white bg-opacity-50 transition duration-500 p-2 rounded-md shadow-md">
                                <a href="{{ route('show-artista', $artista->apodo) }}">
                                    <div class="grid grid-rows-2">
                                        <div>
                                            <div class="flex">
                                                <div class="mr-4 inline-block">
                                                    <img class="rounded-full" alt="Foto perfil artista"
                                                         src="{{asset($artista->profile_photo_url)}}"/>
                                                </div>

                                                <div class="my-2">
                                                    <p class="text-lg font-bold limitlines1">{{$artista->name}} {{$artista->apellido}}</p>
                                                    <p class="limitlines1">{{Carbon\Carbon::parse($artista->fecha_nacimiento)->age}}
                                                        años de edad.</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 bg-gray-800 py-1 px-2 text-white rounded-md ">
                                                <p class="text-md italic limitlines2">Cita: "{{$artista->perfil->cita}}
                                                    "</p>
                                            </div>

                                            <div class="my-2 limitlines2 bg-gray-800 py-1 px-2 text-white rounded-md">
                                                Estilos:
                                                @forelse($artista->obras as $obra)
                                                    <span class="text-md">{{ $obra->tipo }}
                                                        @if($artista->obras->last()->id != $obra->id) - @endif
                                            </span>
                                                @empty
                                                    <span class="text-md">
                                                El Artista no tiene Obras publicadas o aprobadas
                                            </span>
                                                @endforelse
                                            </div>
                                        </div>

                                        <div>
                                            <img src="{{asset($artista->perfil->foto_artista)}}"
                                                 class="w-full h-52 object-cover rounded-md">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="text-center">No hay Artistas coincidentes o registrados</div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8 pb-16">
                        <div class="flex justify-center">
                            <a href="{{route('index-artistas')}}">
                                <p class="text-white bg-blue-600 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                    Ver Todos los Artistas
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-cover bg-center"
             style="background-image: url('http://universalplanner.it/wp-content/uploads/2018/08/more.jpg')">
            <div class="px-6">
                <div class="lg:max-w-4xl w-full mx-auto">

                    <div class="h-16"></div>
                    <!-- TITULO PRINCIPÁL-->
                    <div class="text-center text-white font-sans text-4xl md:py-10 py-6">
                        <p class="rounded-xl bg-gray-800 bg-opacity-25">Eventos Próximos</p>
                        <hr class="max-w-xl mx-auto my-6 border-2">
                    </div>

                    <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse(App\Models\Evento::all()->where('estado', 'APROBADO')->sortByDesc('fecha_evento')->take(6) as $evento)
                            <div
                                class="hover:bg-blue-200 bg-opacity-50 bg-white transition duration-500 p-2 rounded-md shadow-md">
                                <div class="grid grid-cols-1">
                                    <div
                                        class="limitlines2 text-2xl font-semibold text-center">{{$evento->titulo}}</div>
                                    <div class="limitlines2 mt-2 text-center">{{$evento->descripcion}}</div>
                                </div>

                                <div class="grid grid-cols-2 mt-4">
                                    <!-- datos respecto al evento -->
                                    <div class="grid grid-cols-1">
                                        <div>
                                            <div class="flex flex-row">
                                                <img style="height: 25px;"
                                                     src="{{ URL::to('/') }}/images/iconos/calendario.svg"
                                                     alt="location icon">
                                                <p class="ml-2">{{Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y')}}</p>
                                            </div>

                                            <div class="flex flex-row mt-2">
                                                <img style="height: 25px;"
                                                     src="{{ URL::to('/') }}/images/iconos/reloj.svg"
                                                     alt="location icon">
                                                <p class="ml-2">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- columna para el boton de ver evento-->
                                    <div class="grid grid-cols-1">
                                        <div class="font-medium mx-auto">
                                            <a href="{{ route('show-evento', $evento->id)  }}">
                                                <button
                                                    class="bg-gray-800 hover:bg-blue-700 transition duration-500 rounded-full py-2 px-4 text-white">
                                                    Ver Evento
                                                </button>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mt-2 flex flex-row col-span-2">
                                        <img style="margin-right: 6.5px;height: 25px;"
                                             src="{{ URL::to('/') }}/images/iconos/lugar.svg" alt="location icon">
                                        <p class="ml-2 limitlines1">{{$evento->lugar}}</p>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <img
                                        src="{{ isset($evento->foto_evento)? asset($evento->foto_evento): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-lg h-48">
                                </div>
                            </div>
                        @empty
                            <div
                                class="hover:bg-gray-200 rounded-md transition duration-500">
                                <div class="flex h-full text-2xl font-semibold text-gray-800 p-2">
                                    <div class="m-auto text-center">
                                        <p>
                                            Actualmente no hay Eventos por Comenzar
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8 pb-16">
                        <div class="flex justify-center">
                            <a href="{{route('index-eventos')}}">
                                <p class="text-white bg-blue-600 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                    Ver Todos los Eventos
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-cover bg-gray-900">
            <div class="px-6">
                <div class="lg:max-w-6xl w-full mx-auto">
                    <div class="h-16"></div>
                    <!-- TITULO DE MAS OBRAS DEL AUTOR -->
                    <div class="text-center text-white font-sans text-4xl md:py-10 py-6">
                        <p>Noticias Recientes</p>
                        <hr class="max-w-xl mx-auto my-6 border-2">
                    </div>

                    <!-- seccion con Noticias relaciopnadas -->
                    <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse(App\Models\Noticia::all()->sortByDesc('fecha_noticia')->take(6) as $noticia)
                            @if(\Illuminate\Pagination\Paginator::resolveCurrentPage()==1 && App\Models\Noticia::all()->sortByDesc('fecha_noticia')->first()->id==$noticia->id)

                                <div class="shadow-lg bg-bottom bg-no-repeat lg:col-span-2 row-span-2"
                                     style="background-image: url({{ isset($noticia->imagen_path)?
                                     asset($noticia->imagen_path): asset('images/imagen-default.jpg') }}); border-radius: 0.375rem">

                                    <div
                                        class="p-4 text-white bg-red-700 bg-opacity-50 hover:bg-red-600 rounded-t-md p-2 transition duration-500">
                                        <div class="grid lg:grid-cols-3 grid-cols-2 row-auto-rows-max">
                                            <!-- TAGS PARA LA NOTICIA COMUN -->
                                            <div>
                                                @forelse($noticia->tags as $tag)
                                                    <a href="{{ route('show-by-tag',['tag'=>$tag->id]) }}">
                                                <span
                                                    class="text-md font-light my-auto mx-1 px-3 bg-gray-200 hover:bg-white text-black rounded-full transition duration-500">
                                                    {{ $tag->nombre }}
                                                </span>
                                                    </a>
                                                @empty
                                                    <span
                                                        class="text-md font-light my-auto mx-1 px-3 bg-white text-black rounded-full">no tags
                                            </span>
                                                @endforelse
                                            </div>

                                            <div class="text-md font-light col-end-4 flex justify-end">
                                                {{ App\Models\Noticia::all()->sortByDesc('fecha_noticia')->first()->fecha_noticia }}
                                            </div>

                                            <!-- TITULO NOTICIA MAS RECIENTE -->
                                            <div
                                                class="lg:text-3xl text-2xl font-black mx-auto mt-4 lg:col-span-1 col-span-3 lg:col-start-2">
                                                Última Noticia
                                            </div>

                                        </div>

                                        <div class="grid grid-rows-1 divide-y divide-white">
                                            <!-- TITULO PARA LA ULTIMA NOTICIA -->
                                            <div class="text-center my-4 limitlines3">
                                                <div class="text-center my-auto lg:text-4xl text-xl font-extrabold">
                                                    {{ $noticia->titulo }}
                                                </div>
                                            </div>

                                            <div class="pt-3">
                                        <span>Noticia publicada por <span
                                                class="font-semibold">{{ App\Models\User::find($noticia->usuario_id)->name }} {{ App\Models\User::find($noticia->usuario_id)->apellido }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="rounded-md lg:p-4 p-2">
                                        <div class="text-white rounded-lg bg-gray-800 limitlines4 lg:p-4 p-2 text-lg"
                                             style="--bg-opacity: 30%">
                                            <div class="lg:text-2xl font-medium mb-2 limitlines3">
                                                {{ App\Models\Noticia::all()->sortByDesc('fecha_noticia')->first()->sub_titulo }}
                                            </div>
                                            <div class="lg:text-2xl font-medium limitlines4">
                                                {{ App\Models\Noticia::all()->sortByDesc('fecha_noticia')->first()->bajada }}
                                            </div>
                                        </div>

                                        <!-- BOTON LEER MAS PARA LA NOTICIA MAS RECIENTE-->
                                        <div class="font-medium text-lg p-2 mt-2">
                                            <a href="{{ route('show-noticia', $noticia->id) }}">
                                                <button
                                                    class="bg-red-700 text-white hover:bg-red-600 transition duration-500 rounded-full py-3 px-10 mx-auto">
                                                    Leer más..
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else

                            <!-- CUADRO COMUN PARA UNA PAGINA COMUN (DESDE LA PAG 2 HACIA ADELANTE)-->
                                <div class="shadow-lg bg-center bg-no-repeat"
                                     style="background-image: url({{ isset($noticia->imagen_path)?
                                     asset($noticia->imagen_path): asset('images/imagen-default.jpg') }}); border-radius: 0.375rem">

                                    <div
                                        class="p-4 text-white hover:bg-gray-700 bg-gray-800 bg-opacity-50 rounded-t-md transition duration-500">
                                        <div class="grid grid-cols-3">

                                            <!-- TAGS PARA LA NOTICIA COMUN -->
                                            <div class="col-span-2">
                                                @forelse($noticia->tags as $tag)
                                                    <a href="{{ route('show-by-tag',['tag'=>$tag->id]) }}">
                                        <span
                                            class="text-md font-light my-auto mx-1 px-3 bg-gray-200 hover:bg-white text-black rounded-full transition duration-500">
                                            {{ $tag->nombre }}
                                        </span>
                                                    </a>
                                                @empty
                                                    <span
                                                        class="text-md font-light my-auto mx-1 px-3 bg-white text-black rounded-full">no tags
                                            </span>
                                                @endforelse
                                            </div>

                                            <div class="text-md font-light text-center col-end-4">
                                                {{ $noticia->fecha_noticia }}
                                            </div>
                                        </div>

                                        <!-- TITULO PARA LA NOTICIA COMUN -->
                                        <div class="text-center mt-2 limitlines2">
                                            <div class="text-center my-auto font-semibold text-lg">
                                                {{ $noticia->titulo }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SUB_TITULO PARA LA NOTICIA COMUN -->
                                    <div class="rounded-md shadow-xl p-2">

                                        <div class="text-white rounded-lg bg-gray-800 limitlines4"
                                             style="--bg-opacity: 30%">
                                            <div class="text-center">
                                                {{ $noticia->sub_titulo }}
                                            </div>
                                        </div>

                                        <!-- BOTON LEER MAS PARA LA NOTICIA MAS RECIENTE-->
                                        <div class="font-medium p-2">
                                            <a href="{{ route('show-noticia', $noticia->id) }}">
                                                <button
                                                    class="bg-gray-200 hover:bg-white transition duration-500 rounded-full py-2 px-4 mx-auto">
                                                    Leer más..
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @empty
                            <div class="text-center">No hay Noticias relacionadas a el
                                Tag {{$tag_principal->nombre }}</div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8 pb-16">
                        <div class="flex justify-center">
                            <a href="{{route('index-noticias')}}">
                                <p class="text-white bg-blue-600 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                    Ver Todas los Noticias
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="container h-20"></div>
                </div>
            </div>
        </div>

        <div class="bg-cover bg-center"
             style="background-image: url('https://live.staticflickr.com/65535/50978500636_b6baeac684_k.jpg')">
            <div class="px-6">
                <div class="lg:max-w-4xl w-full mx-auto">

                    <div class="h-16"></div>
                    <!-- TITULO PRINCIPÁL-->
                    <div class="text-center text-white font-sans text-4xl md:py-10 py-6">
                        <p class="rounded-xl bg-gray-800 bg-opacity-25">Marketplace para todos</p>
                        <hr class="max-w-2xl mx-auto my-6 border-2">
                    </div>

                    <div
                        class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 lg:grid-cols-4 mt-4">
                        @forelse(\App\Models\Producto::all()->sortByDesc('created_at')->take(8) as $producto_artista)

                            <div
                                class="hover:bg-blue-600 bg-opacity-50 bg-white shadow-md p-2 rounded-md transition duration-500"
                                style="position: relative">
                                <div>
                                    <a href="{{ route('ver-producto', [$producto_artista->slug]) }}">
                                        <img
                                            src="{{ isset($producto_artista->imagenes->last()->ruta)? asset($producto_artista->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}"
                                            class="w-full object-cover rounded-md sm:h-48 h-32">
                                    </a>
                                </div>

                                <div class="text-gray-800">
                                    <div class="mt-4 font-semibold limitlines2">
                                        {{ $producto_artista->nombre }}
                                    </div>

                                    <div class="flex py-2">
                                        <div class="mr-2 flex-shrink-0">
                                            <img class="rounded-full sm:h-14 h-8 sm:w-14 w-8"
                                                 src="{{asset($producto_artista->artista->profile_photo_url)}}"/>
                                        </div>

                                        <div class="font-light">
                                            <div class="limitlines1">
                                                {{$producto_artista->artista->name}} {{$producto_artista->artista->apellido}}
                                            </div>

                                            <a class="py-1 px-2 bg-purple-700 hover:bg-purple-600 transition duration-500 inline-block rounded-md"
                                               href="{{ route('buscarPorCategoria', [$producto_artista->categoria->id]) }}">
                                                <div
                                                    class="text-white text-sm">
                                                    {{ $producto_artista->categoria->nombre }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:h-14 h-18"></div>

                                <div class="text-black">
                                    @livewire("market.agregar-producto-form", ['producto' => $producto_artista, 'isCard'
                                    =>
                                    'si'])
                                </div>

                            </div>
                        @empty
                            <div
                                class="hover:bg-gray-200 rounded-md transition duration-500">
                                <div class="flex h-full text-2xl font-semibold text-gray-800 p-2">
                                    <div class="m-auto text-center">
                                        <p>
                                            Actualmente no hay Productos nuevos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8 pb-16">
                        <div class="flex justify-center">
                            <a href="{{route('index-market')}}">
                                <p class="text-white bg-blue-600 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                    Visitar Market
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-cover bg-center"
             style="background-image: url('https://live.staticflickr.com/65535/50978582987_dc42644532_k.jpg')">
            <div class="px-6">
                <div class="lg:max-w-4xl w-full mx-auto">

                    <div class="h-16"></div>
                    <!-- TITULO PRINCIPÁL-->
                    <div class="text-center text-gray-800 font-sans text-4xl md:py-10 py-6">
                        <p class="rounded-xl bg-gray-200 bg-opacity-25">Crowdfunding para grandes Ideas</p>
                        <hr class="max-w-4xl mx-auto my-6 border-gray-800 border-2">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
                        @forelse(\App\Models\Proyecto::all()->where('aprobado', 'SI')->sortByDesc('fecha_inicio')->take(6) as $proyecto)

                            <div
                                class="bg-opacity-50 bg-white shadow-md hover:bg-purple-600 transition duration-500 rounded-t-lg rounded-b-2xl relative">
                                <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                    <img
                                        src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-t-lg h-48">
                                </a>

                                <div class="text-gray-800 px-2">
                                    <div class="mt-2">
                                        <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                            <p class="font-semibold text-center limitlines2">{{ $proyecto->titulo }}</p>
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-2 mt-2 gap-2">
                                        <div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-person-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    </svg>
                                                </div>
                                                <span> {{ $proyecto->publicador->name}} {{ $proyecto->publicador->apellido}}.</span>
                                            </div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-eye-fill"
                                                         viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </div>
                                                <span>{{ $proyecto->contador_visitas }}</span>
                                            </div>
                                        </div>

                                        <div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-calendar-x-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
                                                    </svg>
                                                </div>
                                                <span>{{ date_format(date_create($proyecto->fecha_limite), 'd-m-Y') }}</span>
                                            </div>
                                            <div>
                                                @if($proyecto->estado == 'EN CURSO')
                                                    <a class="py-1 px-2 bg-yellow-300 hover:bg-yellow-200 transition duration-500 inline-block rounded-md"
                                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-activos']) }}">
                                                        <div class=" text-sm text-white ">
                                                            en curso
                                                        </div>
                                                    </a>
                                                @else
                                                    <a class="py-1 px-2 bg-gray-800 hover:bg-gray-700 transition duration-500 inline-block rounded-md"
                                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-finalizados']) }}">
                                                        <div class=" text-sm text-white ">
                                                            finalizado
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $progreso = round($proyecto->monto_actual/$proyecto->meta * 100.0);
                                @endphp

                                <div class="h-4"></div>
                                <div
                                    class="overflow-hidden mt-2 mx-auto h-6 w-full text-xs flex rounded-full bg-gray-200 absolute bottom-0">
                                    <div id="progress_bar"
                                         style="width:{{round($proyecto->monto_actual/$proyecto->meta * 100.0).'%'}}"
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400">
                                    </div>
                                    <div class="grid grid-cols-1 mx-auto">
                                        <div
                                            class="bg-transparent absolute bottom-0 inset-0 text-center text-lg text-gray-800 font-semibold"
                                            style="mx-auto;">{{$progreso}} %
                                        </div>
                                    </div>
                                </div>
                                <div class="h-4"></div>

                            </div>
                        @empty
                            <div class="h-8"></div>
                            <div class="text-center p-4 text-gray-800">Aún no hay proyectos finalizados.</div>
                            <div class="h-8"></div>
                        @endforelse
                    </div>

                    <div class="text-center mt-8 pb-16">
                        <div class="flex justify-center">
                            <a href="{{route('index-crowdfunding')}}">
                                <p class="text-white bg-blue-600 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                    Visitar Crowdfunding
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
</x-galeria-layout>

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    var mySwiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });
</script>
