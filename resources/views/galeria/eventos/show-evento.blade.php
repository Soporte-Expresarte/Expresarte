@extends('galeria.helpers.body')

@section('title_head', 'Eventos')

@section('content_body')

    @if($evento->foto_portada)
        <div>
            <img class="object-cover w-full" style="max-height: 400px"
                 src="{{isset($evento->foto_portada)? asset($evento->foto_portada) : asset('images/imagen-default.jpg')}}">
        </div>
    @endif

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <div class="grid grid-cols-1 pt-4">
                    <div class="flex p-4 mx-auto">
                        <div class="pr-2">
                            <img style="height: 40px;"
                                 src="{{ URL::to('/') }}/images/iconos/calendario.svg" alt="location icon">
                        </div>
                        <div
                            class="text-2xl pr-6">{{Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y')}}</div>

                        <div class="pr-2">
                            <img style="height: 40px;"
                                 src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                        </div>
                        <div class="text-2xl">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</div>
                    </div>
                </div>

                <!-- Titulo de la obra -->
                <div class="text-center mt-4">
                    <p class="text-4xl text-gray-800 font-bold">
                        {{ $evento->titulo }}
                    </p>
                </div>

                <div class="mt-4">
                    <p class="font-bold text-lg pt-2">Descripción:
                        <span
                            class="text-gray-600 font-light">{!! str_replace("\n", "<br>", $evento->descripcion) !!}</span>
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 my-4">
                    <div class="mt-4">
                        <strong class="text-xl">Fecha de Inicio</strong>
                        <div class="flex flex-row items-center">
                            <img class="mr-2" style="height: 25px;"
                                 src="{{ URL::to('/') }}/images/iconos/calendario.svg"
                                 alt="location icon">
                            <p class="text-lg">{{Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y')}}</p>

                            <img class="ml-5 mr-2" style="height: 25px;"
                                 src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                            <p class="text-lg">{{Carbon\Carbon::parse($evento->fecha_evento)->format('H:i')}}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <strong class="text-xl">Fecha de Término</strong>
                        <div class="flex flex-row items-center">
                            <img class="mr-2" style="height: 25px;"
                                 src="{{ URL::to('/') }}/images/iconos/calendario.svg"
                                 alt="location icon">
                            <p class="text-lg">{{Carbon\Carbon::parse($evento->fecha_termino)->format('d/m/Y')}}</p>

                            <img class="ml-5 mr-2" style="height: 25px;"
                                 src="{{ URL::to('/') }}/images/iconos/reloj.svg" alt="location icon">
                            <p class="text-lg">{{Carbon\Carbon::parse($evento->fecha_termino)->format('H:i')}}</p>
                        </div>
                    </div>

                    <div class="mt-4 lg:col-span-2">
                        <strong class="text-xl">Lugar</strong>
                        <div class="flex flex-row items-center break-all">
                            <img class="mr-2" style="height: 25px;"
                                 src="{{ URL::to('/') }}/images/iconos/lugar.svg" alt="location icon">
                            <p class="text-lg">{{$evento->lugar}}</p>
                        </div>
                    </div>
                </div>

                <!-- Imagen del evento -->
                <div class="pb-6 mt-8">
                    <img class="mx-auto rounded-md"
                         src="{{ isset($evento->foto_evento)? asset($evento->foto_evento): asset('images/imagen-default.jpg') }}">
                </div>

            </div>
        </div>
    </div>

@endsection
