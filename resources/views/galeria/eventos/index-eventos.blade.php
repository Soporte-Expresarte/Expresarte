@extends('galeria.helpers.body')

@section('title_head', 'Eventos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/galeria/pag-noticias.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('css/galeria/paginacion.css')}}">
@endsection

@section('content_body')

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

    <!-- CARRUSEL PARA EVENTOS -->
    @livewire('carrusel-unico', ['tipo'=>'eventos'])

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


            <!-- TITULO PRINCIPaL-->
            <div class="text-center text-gray-800 font-extrabold text-5xl md:py-10 py-6">
                <p>Sección de Eventos</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div >
                <form method="get" action="{{url('/galeria/eventos/buscar')}}">

                    <div class="sm:flex sm:flex-row justify-center pt-8 px-2">
                        <div class="sm:inline-block sm:mr-4 ">
                            <div class="flex border-grey-light border rounded-md">
                                <input class="w-full rounded ml-1 p-2 bg-white" id="texto" name="texto" type="search"
                                       placeholder="Buscar por título...">

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
            <!-- cuadro con todos los eventros -->
            <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                <div
                    class="lg:bg-gradient-to-r md:bg-gradient-to-r bg-gradient-to-b from-yellow-200 via-green-400 to-green-600 rounded-md">
                    <div class="flex h-full text-5xl font-sans text-gray-800 p-2">
                        <div class="m-auto text-center">
                            <p>
                                Eventos En Vigencia
                            </p>
                        </div>
                    </div>
                </div>

                @forelse($eventos_actuales as $evento)
                    @if($loop->index>4)
                        @break
                    @endif

                    <div class="hover:bg-green-200 transition duration-500 p-4 rounded-md shadow-md">
                        <div class="grid grid-cols-1">
                            <div class="limitlines2 text-2xl font-semibold text-center">{{$evento->titulo}}</div>
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
                                             src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                                        <p class="ml-2">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- columna para el boton de ver evento-->
                            <div class="grid grid-cols-1">
                                <div class="font-medium p-2 mx-auto">
                                    <a href="{{ route('show-evento', $evento->id)  }}">
                                        <button
                                            class="bg-gray-800 hover:bg-green-600 transition duration-500 rounded-full py-2 px-4 text-white">
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
                                    Actualmente no hay Eventos En Vigencia
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- boton para ver mas -->
            @if( sizeof($eventos_actuales) > 5)
                <div class="text-center mt-8">
                    <div class="flex justify-center">
                        <a href="{{ route('show-evento-periodo', ['orden'=>'actualmente-vigentes']) }}">
                            <p class="text-white bg-gray-800 hover:bg-green-400 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                Ver Todos los Eventos en Vigencia
                            </p>
                        </a>
                    </div>
                </div>
            @endif

            <div class="h-12"></div>
            <!-- cuadro con todos los eventros -->
            <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                <div
                    class="lg:bg-gradient-to-r md:bg-gradient-to-r bg-gradient-to-b from-indigo-300 via-indigo-500 to-blue-600 rounded-md">
                    <div class="flex h-full text-5xl font-sans text-gray-800 p-2">
                        <div class="m-auto text-center">
                            <p>
                                Eventos Por Comenzar
                            </p>
                        </div>
                    </div>
                </div>

                @forelse($eventos as $evento)
                    @if($loop->index>4)
                        @break
                    @endif

                    <div class="hover:bg-blue-200 transition duration-500 p-4 rounded-md shadow-md">
                        <div class="grid grid-cols-1">
                            <div class="limitlines2 text-2xl font-semibold text-center">{{$evento->titulo}}</div>
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
                                             src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                                        <p class="ml-2">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- columna para el boton de ver evento-->
                            <div class="grid grid-cols-1">
                                <div class="font-medium p-2 mx-auto">
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

            <!-- boton para ver mas -->
            @if( sizeof($eventos) > 5)
                <div class="text-center mt-8">
                    <div class="flex justify-center">
                        <a href="{{ route('show-evento-periodo', ['orden'=>'por-venir']) }}">
                            <p class="text-white bg-gray-800 hover:bg-blue-500 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                Ver Todos los Eventos por Comenzar
                            </p>
                        </a>
                    </div>
                </div>
            @endif

            <div class="h-12"></div>
            <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                <div
                    class="lg:bg-gradient-to-r md:bg-gradient-to-r bg-gradient-to-b from-purple-400 via-red-400 to-red-500 rounded-md p-4">
                    <div class="flex h-full text-5xl font-sans text-gray-800">
                        <div class="m-auto text-center">
                            <p>
                                Historial De Eventos Finalizados
                            </p>
                        </div>
                    </div>
                </div>

                @forelse($eventos_pasados as $evento)
                    @if($loop->index>4)
                        @break
                    @endif

                    <div class="hover:bg-red-200 transition duration-500 p-4 rounded-md shadow-md">
                        <div class="grid grid-cols-1">
                            <div class="limitlines2 text-2xl font-semibold text-center">{{$evento->titulo}}</div>
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
                                             src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                                        <p class="ml-2">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- columna para el boton de ver evento-->
                            <div class="grid grid-cols-1">
                                <div class="font-medium p-2 mx-auto">
                                    <a href="{{ route('show-evento', $evento->id)  }}">
                                        <button
                                            class="bg-gray-800 hover:bg-red-700 transition duration-500 rounded-full py-2 px-4 text-white">
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
                                    No hay Registros de Eventos Finalizados
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- boton para ver mas -->
            @if( sizeof($eventos_pasados) > 5)
                <div class="text-center mt-8">
                    <div class="flex justify-center">
                        <a href="{{ route('show-evento-periodo', ['orden'=>'finalizados']) }}">
                            <p class="text-white hover:bg-red-500 bg-gray-800 lg:p-4 p-2 mx-auto rounded-full text-xl transition duration-500">
                                Ver Todos los Eventos Finalizados
                            </p>
                        </a>
                    </div>
                </div>
            @else
                <div class="lg:mt-8 mt-6"></div>
            @endif

            <div class="h-12"></div>
        </div>
    </div>

@endsection

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
