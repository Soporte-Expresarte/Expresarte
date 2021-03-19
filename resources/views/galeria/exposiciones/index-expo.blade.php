@extends('galeria.helpers.body')

@section('title_head', 'Exposiciones')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/galeria/pag-exposiciones.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('css/galeria/paginacion.css')}}">
@endsection

@section('content_body')

    @livewire('carrusel-unico', ['tipo'=>'expo'])

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

            <!-- TITULO DE exposiciones -->
            <div class="text-center text-gray-800 font-extrabold text-5xl lg:py-10 py-6">
                <p>Exposiciones de Árte</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <div class="h-16"></div>

            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                @foreach($exposiciones as $expo)

                    @php
                        $estilos = [];
foreach ($expo->obras as $obra)
array_push($estilos, $obra->tipo);
$estilos = array_unique($estilos);
                    @endphp

                    @if($loop->index == 0 || $loop->index==5 )
                        <div
                            class="sm:row-span-2 sm:col-span-2 rounded-xl h-96 relative">
                            <div class="grid grid-cols-2 bg-gray-800">
                                @foreach ($expo->obras as $obra)
                                    <div class="col-span-1 row-span-1">
                                        <img class="h-48 m-auto object-cover w-max-content"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </div>
                                    @if($loop->index == 3) @break @endif
                                @endforeach
                            </div>

                            <div
                                class="text-center p-2 absolute top-2 inset-x-2 bg-white hover:bg-gray-800 bg-opacity-25 hover:opacity-100 text-gray-800 hover:text-white transition duration-500 rounded-xl">
                                <a href="{{ route('show-expo', $expo->id) }}" class="text-xl font-semibold limitlines2">
                                    {{ $expo->titulo }}
                                </a>
                                <a href="{{ route('show-expo', $expo->id) }}" class="mt-2 limitlines4">
                                    {{ $expo->sub_titulo }}
                                </a>

                                <div class="limitlines3">
                                    @foreach($estilos as $estilo)
                                        <a href="{{ route('buscar-tipo', $estilo) }}" class="mt-2 inline-block ">
                                        <span
                                            class="text-md bg-opacity-50 py-1 px-2 bg-blue-800 hover:bg-blue-700 transition duration-500 text-white rounded-md">
                                            {{ $estilo }}
                                        </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @elseif($loop->index==1 || $loop->index==6)
                        <div class="sm:col-span-3 h-44 relative">
                            <div class="grid grid-cols-3 bg-gray-800 rounded-md">
                                @foreach ($expo->obras as $obra)
                                    <div class="col-span-1 row-span-1">
                                        <img class="h-44 m-auto object-cover w-max-content"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </div>
                                    @if($loop->index == 2) @break @endif
                                @endforeach
                            </div>

                            <div
                                class="text-center p-2 absolute top-2 inset-x-2 bg-white hover:bg-gray-800 bg-opacity-25 hover:opacity-100 text-gray-800 hover:text-white transition duration-500 rounded-xl">
                                <a href="{{ route('show-expo', $expo->id) }}" class="text-xl font-semibold limitlines2">
                                    {{ $expo->titulo }}
                                </a>
                                <a href="{{ route('show-expo', $expo->id) }}" class="mt-2 limitlines2">
                                    {{ $expo->sub_titulo }}
                                </a>

                                <div class="limitlines1">
                                    @foreach($estilos as $estilo)
                                        <a href="{{ route('buscar-tipo', $estilo) }}" class="mt-2 inline-block ">
                                        <span
                                            class="text-md bg-opacity-50 py-1 px-2 bg-blue-800 hover:bg-blue-700 transition duration-500 text-white rounded-md">
                                            {{ $estilo }}
                                        </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @elseif($loop->index == 2 || $loop->index == 7)
                        <div
                            class="sm:row-span-2 sm:col-span-2 h-96 relative">
                            <div class="grid grid-cols-2 rounded-md">
                                @foreach ($expo->obras as $obra)
                                    <div class="bg-gray-800 col-span-1 row-span-1">
                                        <img class="h-48 m-auto object-cover w-max-content"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </div>
                                    @if($loop->index == 3) @break @endif
                                @endforeach
                            </div>

                            <div
                                class="text-center p-2 absolute top-2 inset-x-2 bg-white hover:bg-gray-800 bg-opacity-25 hover:opacity-100 text-gray-800 hover:text-white transition duration-500 rounded-xl">
                                <a href="{{ route('show-expo', $expo->id) }}" class="text-xl font-semibold limitlines2">
                                    {{ $expo->titulo }}
                                </a>
                                <a href="{{ route('show-expo', $expo->id) }}" class="mt-2 limitlines4">
                                    {{ $expo->sub_titulo }}
                                </a>

                                <div class="limitlines3">
                                    @foreach($estilos as $estilo)
                                        <a href="{{ route('buscar-tipo', $estilo) }}" class="mt-2 inline-block ">
                                        <span
                                            class="text-md bg-opacity-50 py-1 px-2 bg-blue-800 hover:bg-blue-700 transition duration-500 text-white rounded-md">
                                            {{ $estilo }}
                                        </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @elseif($loop->index == 3 || $loop->index == 8)
                        <div class="bg-teal-400 sm:row-span-2 h-96 relative">
                            <div class="grid grid-cols-1 grid-rows-2 rounded-md">
                                @foreach ($expo->obras as $obra)
                                    <div class="bg-gray-800 col-span-1 row-span-1">
                                        <img class="h-48 m-auto object-cover w-max-content"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </div>
                                    @if($loop->index == 1) @break @endif
                                @endforeach
                            </div>

                            <div
                                class="text-center absolute p-2 top-2 inset-x-2 bg-white hover:bg-gray-800 bg-opacity-25 hover:opacity-100 text-gray-800 hover:text-white transition duration-500 rounded-xl">
                                <a href="{{ route('show-expo', $expo->id) }}" class="text-xl font-semibold limitlines3">
                                    {{ $expo->titulo }}
                                </a>
                                <a href="{{ route('show-expo', $expo->id) }}" class="mt-2 limitlines4">
                                    {{ $expo->sub_titulo }}
                                </a>

                                <div class="limitlines3">
                                    @foreach($estilos as $estilo)
                                        <a href="{{ route('buscar-tipo', $estilo) }}" class="mt-2 inline-block ">
                                        <span
                                            class="text-md bg-opacity-50 py-1 px-2 bg-blue-800 hover:bg-blue-700 transition duration-500 text-white rounded-md">
                                            {{ $estilo }}
                                        </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @elseif($loop->index == 4 || $loop->index == 9)
                        <div class="bg-teal-400 sm:col-span-2 rounded-xl h-44 relative">
                            <div class="grid grid-cols-2 rounded-md">
                                @foreach ($expo->obras as $obra)
                                    <div class="bg-gray-800 col-span-1 row-span-1">
                                        <img class="h-44 m-auto object-cover w-max-content"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </div>
                                    @if($loop->index == 1) @break @endif
                                @endforeach
                            </div>

                            <div
                                class="text-center p-2 absolute top-2 inset-x-2 bg-white hover:bg-gray-800 bg-opacity-25 hover:opacity-100 text-gray-800 hover:text-white transition duration-500 rounded-xl">
                                <a href="{{ route('show-expo', $expo->id) }}" class="text-xl font-semibold limitlines2">
                                    {{ $expo->titulo }}
                                </a>
                                <a href="{{ route('show-expo', $expo->id) }}" class="mt-2 limitlines2">
                                    {{ $expo->sub_titulo }}
                                </a>

                                <div class="limitlines1">
                                    @foreach($estilos as $estilo)
                                        <a href="{{ route('buscar-tipo', $estilo) }}" class="mt-2 inline-block ">
                                        <span
                                            class="text-md bg-opacity-50 py-1 px-2 bg-blue-800 hover:bg-blue-700 transition duration-500 text-white rounded-md">
                                            {{ $estilo }}
                                        </span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>

            <!-- PAGINACION - CAMBIO DE PAGINAS POR NUMEROS -->
            <div class=" grid grid-cols-1 pt-4 my-16">
                <div class="mx-auto">
                    {{$exposiciones->links()}}
                </div>
            </div>

            <div class="h-16"></div>

        </div>
    </div>

@endsection
