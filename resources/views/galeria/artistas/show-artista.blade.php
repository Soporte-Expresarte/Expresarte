@extends('galeria.helpers.body')

@section('title_head', 'Artistas')

@section('content_body')

    <style>
        div.centerText {
            position: relative;
            display: inline-block;
        }

        div.centerText span {
            position: absolute;
            text-align: center;
            height: 100%;
            width: 100%;
        }

        div.centerText span:before {
            display: inline-block;
            vertical-align: middle;
            height: 100%;
            content: '';
        }

        .textShadow {
            text-shadow: -1px -1px 20px #000, 1px -1px 20px #000, -1px 1px 20px #000, 1px 1px 20px #000;
        }

        .non-selectable {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -webkit-user-drag: none;
            user-select: none;
            user-drag: none;
        }
    </style>

    @if($artista->perfil->foto_portada)
        <div class="centerText justify-center items-center w-full">
                <span
                    class="truncate textShadow md:text-6xl text-3xl text-white font-extrabold">{{$artista->name}} {{$artista->apellido}}</span>

            <div class="object-cover h-48 lg:h-full w-full">
                <img class="block h-full w-full mx-auto flex md:items-center bg-cover"
                     style="display: block; margin: auto;" src="{{asset($artista->perfil->foto_portada)}}">
            </div>
        </div>
    @endif

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <div class="grid sm:grid-cols-2 grid-cols-1">
                    <div class="sm:pr-4">
                        <!-- Datos del artista-->
                        <div class="mt-6 grid grid-cols-1">
                            <p class="text-4xl text-gray-800 font-bold text-center">{{$artista->name}} {{$artista->apellido}}</p>
                        </div>

                        <div class="mt-8 grid grid-cols-1">
                            <div class="bg-gray-800 p-2 text-white rounded-md">
                                <p class="font-bold text-m italic text-center">«{{$artista->perfil->cita}}»</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-m">
                                {!! str_replace("\n", "<br>", $artista->perfil->descripcion) !!}
                            </p>
                        </div>
                    </div>

                    <div class=" mt-6">
                        <!-- Logos para las redes sciales-->
                        <div class="grid grid-cols-3">
                            <div class="mx-auto">
                                @if($artista->perfil->instagram)
                                    <a target="_blank" href="https://www.instagram.com/{{$artista->perfil->instagram}}">
                                        <img style="height: 60px;" src="{{ URL::to('/') }}/images/RRSS/instagram.svg">
                                        {{$artista->instagram}}
                                    </a>
                                @endif
                            </div>

                            <div class="mx-auto">
                                @if($artista->perfil->facebook)
                                    <a target="_blank" href="https://www.facebook.com/{{$artista->perfil->facebook}}">
                                        <img style="height: 60px;" src="{{ URL::to('/') }}/images/RRSS/facebook.svg">
                                        {{$artista->facebook}}
                                    </a>
                                @endif
                            </div>

                            <div class="mx-auto">
                                @if($artista->perfil->twitter)
                                    <a target="_blank" href="https://www.twitter.com/{{$artista->perfil->twitter}}">
                                        <img style="height: 60px;" src="{{ URL::to('/') }}/images/RRSS/twitter.svg">
                                        {{$artista->twitter}}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Imagen de perfil dela rtista -->
                        <div class="mt-8">
                            <img class="mx-auto rounded-md"
                                 src="{{ isset($artista->perfil->foto_artista)? asset($artista->perfil->foto_artista): asset('images/imagen-default.jpg') }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4 font-semibold bg-gray-800 p-2 text-white rounded-md">
                    Estilos de Pintura:
                    @forelse($estilos as $estilo)
                        <span class="text-md">{{ $estilo }}
                            @if(sizeof($estilos) > ($loop->index +1)) - @endif
                        </span>
                    @empty
                        <span class="text-md">
                            El Artista no tiene Obras publicadas o aprobadas
                        </span>
                    @endforelse
                </div>

                <!-- mas obras del artista titulo-->
                <div class="grid grid-cols-1 mt-12">
                    <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                        Obras de {{ $artista->name }} {{ $artista->apellido }}
                    </p>
                </div>

                <!-- mas obras del artista imagenes-->
                <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8 pb-6">
                    @forelse($obras as $obra)
                        <div
                            class="shadow-md bg-gray-100 rounded-md hover:bg-gray-900 hover:text-gray-100 transition duration-500">
                            <div class="p-2 rounded-md">
                                <div class="p-2">
                                    <a href="{{ route('show-obra', $obra) }}">

                                        <img class="w-full object-cover rounded-lg h-48"
                                             src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </a>

                                </div>

                                <div class="font-bold px-2">
                                    <div class="mt-2">
                                        Título: <span class="font-light">{{ $obra->titulo }}</span>
                                    </div>
                                    <div class="my-2">
                                        Tipo: <span class="font-light">{{ $obra->tipo }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="text-center">
                            <p class="text-xl text-gray-800 font-bold">No hay Obras publicadas
                                por {{ $artista->name }}</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

@endsection
