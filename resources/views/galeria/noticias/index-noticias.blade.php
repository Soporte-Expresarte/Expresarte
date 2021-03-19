@extends('galeria.helpers.body')

@section('title_head', 'Noticias')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/galeria/pag-noticias.css') }}">
@endsection

@section('content_body')

    <!-- CARRUSEL PARA NOTICIAS -->
    @livewire('carrusel-unico', ['tipo'=>'noticias'])

    <style>
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

    <div class="px-6">
        <div class="lg:max-w-6xl w-full mx-auto lg:mb-10 mb-4">

            <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
            <div class="text-center desaparece_5_segs">
                @if (session()->has('success'))
                    <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                        ✔️{{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- TITULO DE MAS OBRAS DEL AUTOR -->
            <div class="text-center text-gray-800 font-extrabold text-5xl lg:py-10 py-6">
                <p>Sección de Noticias</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div>
                <form method="get" action="{{url('/galeria/noticias/buscar')}}">
                    <div class="sm:flex sm:flex-row justify-center pt-8 px-2">
                        <div class="sm:inline-block sm:mr-4 ">
                            <div class="flex border-grey-light border rounded-md">
                                <input class="w-full rounded ml-1 p-2 bg-white" id="texto" name="texto" type="search"
                                       placeholder="Buscar por título...">

                                <button type="submit"
                                        class="bg-gray-800 border-grey border-l rounded-r-md shadow hover:bg-red-600 transition duration-500">
                                    <span class="w-auto flex justify-end items-center text-white px-4 py-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="h-12"></div>
            <!-- seccion con Noticias relaciopnadas -->
            <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 pb-8 mt-8">
                @forelse($noticias as $noticia)
                    @if(\Illuminate\Pagination\Paginator::resolveCurrentPage()==1 && $noticias->first()->id==$noticia->id)

                        <div class="shadow-lg bg-bottom bg-no-repeat lg:col-span-2 row-span-2"
                             style="background-image: url({{ isset($noticia->imagen_path)?
                                     asset($noticia->imagen_path): asset('images/imagen-default.jpg') }}); border-radius: 0.375rem">

                            <div class="p-4 text-white bg-red-700 bg-opacity-50 hover:bg-red-600 rounded-t-md p-2 transition duration-500">
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
                                        {{ $noticias->first()->fecha_noticia }}
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
                                        {{ $noticias->first()->sub_titulo }}
                                    </div>
                                    <div class="lg:text-2xl font-medium limitlines4">
                                        {{ $noticias->first()->bajada }}
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

                            <div class="p-4 text-white hover:bg-gray-700 bg-gray-800 bg-opacity-50 rounded-t-md transition duration-500" >
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
                    <div class="h-16"></div>
                    <div class="grid grid-cols-1 mt-12 pb-8">
                        <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                            No hay Noticias registradas en el sistema.
                        </p>
                    </div>
                    <div class="h-16"></div>                @endforelse
            </div>
        </div>

        <!-- PAGINACION - CAMBIO DE PAGINAS POR NUMEROS -->
        <div class=" grid grid-cols-1 pt-4 my-16">
            <div class="mx-auto">
                {{$noticias->links()}}
            </div>
        </div>
    </div>

@endsection

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
