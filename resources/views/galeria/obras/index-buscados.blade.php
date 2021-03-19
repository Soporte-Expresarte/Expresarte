@extends('galeria.helpers.body')

@section('title_head', 'Obras Buscadas')

@section('content_body')
    <link rel="stylesheet" href="{{ asset('css/galeria/pag-exposiciones.css') }}">

    <style>
        #gallerys {
            column-count: 3;
        }

        /* Móviles en horizontal o tablets en vertical */
        @media (max-width: 767px) {
            #gallerys {
                columns: 2;
            }
        }

        /* Móviles en vertical */
        @media (max-width: 480px) {
            #gallerys {
                columns: 1;
            }
        }
    </style>

    <!-- CARRUSEL PARA EXPOSICIONES -->
    <x-galeria.carrusel-exposiciones/>

    <div class="px-6">
        <div class="lg:max-w-6xl w-full mx-auto lg:mb-10 mb-4">

            <div class="text-center desaparece_5_segs">
                @if (session()->has('success'))
                    <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                        ✔️{{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- TITULO PRINCIPAL DEL INDEX DE OBRAS -->
            <div class="text-center text-gray-800 font-extrabold text-5xl md:py-10 py-6">
                <p>Sección de Obras</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div>
                <form method="get" action="{{url('/galeria/exposiciones/buscar')}}">
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
            <!-- obras del artista imagenes-->
            <div class="py-2">
                <div id="gallerys">

                    @forelse($obras as $obra)
                        <div
                            class="shadow-md bg-gray-100 rounded-md hover:bg-gray-900 hover:text-gray-100 transition duration-500"
                            style="margin: 0 0 1em; display: inline-block; width:100%; max-width:960px;">

                            <div class="p-2 rounded-lg">
                                <div class="p-2">
                                    <a href="{{ route('show-obra', $obra) }}">
                                        <img class="mx-auto rounded-lg"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </a>
                                </div>

                                <div class="font-bold px-2">
                                    <div class="mt-4">
                                        Título: <span class="font-light">{{ $obra->titulo }}</span>
                                    </div>

                                    <div class="flex my-2">
                                        <div class="mr-4 inline-block">
                                            <img class="rounded-full h-14 w-14"
                                                 src="{{asset($obra->usuario->profile_photo_url)}}"/>
                                        </div>

                                        <div>
                                            <div class="limitlines1">
                                                Author: <span
                                                    class="font-light">{{$obra->usuario->name}} {{$obra->usuario->apellido}}</span>
                                            </div>
                                            <div class="tm-2 limitlines1">
                                                Tipo de Obra: <span class="font-light">{{ $obra->tipo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="h-16"></div>
                        <div class="grid grid-cols-1 mt-12 pb-8">
                            <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                                No hay Noticias relacionadas a la palabra buscada.
                            </p>
                        </div>
                        <div class="h-16"></div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>

@endsection

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
