@extends('galeria.helpers.body')

@section('title_head', 'Eventos por Periodo')

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

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <!-- Titulo para periodo-->
                <div class="text-center pt-8">
                    <p class="text-4xl text-gray-800 font-bold">
                        @if($orden=='actualmente-vigentes') Eventos en Vigencia

                        @elseif ($orden=='por-venir') Eventos por Comenzar

                        @elseif($orden=='finalizados') Historial de Eventos Finalizados

                        @else Historial Completo de Eventos
                        @endif
                    </p>
                </div>

                <!-- grid con todos los eventos recibidos-->
                <div class="mt-12 pb-6">
                    <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2">
                        @forelse($eventos as $evento)
                            <div class="hover:bg-gray-200 transition duration-500 p-4 rounded-md shadow-md">
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
                                        <div class="font-medium p-2 mx-auto">
                                            <a href="{{ route('show-evento', $evento->id)  }}">
                                                <button
                                                    class="bg-gray-800 hover:bg-gray-700 transition duration-500 rounded-full py-2 px-4 text-white">
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
                            <div class="text-center">No hay Eventos registrados o aprobados</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
