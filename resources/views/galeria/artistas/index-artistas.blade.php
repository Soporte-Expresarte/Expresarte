@extends('galeria.helpers.body')

@section('title_head', 'Artistas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/galeria/pag-artistas.css') }}">
@endsection

@section('content_body')
    @livewire('carrusel-unico', ['tipo'=>'artistas'])

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

            <!-- TITULO PRINCIPÁL-->
            <div class="text-center text-gray-800 font-extrabold text-5xl md:py-10 py-6">
                <p>Nuestros Artistas</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div>
                <form method="get" action="{{url('/galeria/artistas/buscar')}}">

                    <div class="sm:flex sm:flex-row justify-center pt-8 px-2">
                        <div class="sm:inline-block sm:mr-4 ">
                            <div class="flex border-grey-light border rounded-md">
                                <input class="w-full rounded ml-1 p-2 bg-white" id="texto" name="texto" type="search"
                                       placeholder="Buscar por nombre...">

                                <button type="submit"
                                        class="bg-gray-800 border-grey border-l rounded-r-md shadow hover:bg-red-600 transition duration-500">
                        <span
                            class="w-auto flex justify-end items-center text-white px-4 py-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24"
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
            <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 pb-8 mt-8">
                @forelse($artistas as $artista)
                    <div class="hover:bg-teal-300 bg-gray-200 transition duration-500 p-4 rounded-md shadow-md">
                        <a href="{{ route('show-artista', $artista->apodo) }}">
                            <div class="grid grid-rows-2">
                                <div>
                                    <div class="flex">
                                        <div class="mr-4 inline-block">
                                            <img class="rounded-full h-14 w-14" alt="Foto perfil artista"
                                                 src="{{asset($artista->profile_photo_url)}}"/>
                                        </div>

                                        <div class="my-2">
                                            <p class="text-lg font-bold limitlines1">{{$artista->name}} {{$artista->apellido}}</p>
                                            <p class="limitlines1">{{Carbon\Carbon::parse($artista->fecha_nacimiento)->age}}
                                                años de edad.</p>
                                        </div>
                                    </div>

                                    <div class="mt-2 bg-gray-800 py-1 px-2 text-white rounded-md ">
                                        <p class="text-md italic limitlines2">Cita: "{{$artista->perfil->cita}}"</p>
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
                    <div class="h-16"></div>
                    <div class="grid grid-cols-1 mt-12 pb-8">
                        <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                            No hay Artistas registrados, aprobados o coincidentes con la palabra buscada.
                        </p>
                    </div>
                    <div class="h-16"></div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
