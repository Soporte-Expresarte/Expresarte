@extends('galeria.helpers.body')

@section('title_head', 'Exposicion')

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

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <!-- Titulo de la obra -->
                <div class="text-center py-6">
                    <p class="text-4xl text-gray-800 font-bold">
                        {{ $exposicion->titulo }}
                    </p>
                </div>

            @php
                $bipolaridad = 2;
            @endphp

            <!-- Imagen de la obra -->
                <div class="mb-8 mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-4">
                        @foreach($exposicion->obras as $obra)

                            @if($loop->index ==0)
                                <div class="col-span-2 flex mt-4 font-semibold p-2 inline-block">
                                    <div class="m-auto text-center">
                                        {{ $exposicion->sub_titulo }}
                                    </div>
                                </div>

                            @elseif($bipolaridad == $loop->index+1)
                                <div class="md:col-span-1 md:inline-block hidden"></div>
                            @endif

                            <a href="{{ route('show-obra', $obra) }}" class="col-span-1 inline-block ml-2 mt-4">
                                <img class="w-full object-cover rounded-l-lg h-48"
                                     src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                            </a>
                            <a href="{{ route('show-obra', $obra) }}"
                               class="col-span-1 inline-block mr-2 mt-4 p-2 bg-gray-800 text-white rounded-r-lg hover:bg-gray-700 transition duration-500">
                                <div class="limitlines2 text-lg font-medium"> {{ $obra->titulo }}</div>
                                <div class="mt-2 limitlines3 text-sm"> {{ $obra->descripcion }}</div>
                            </a>

                            @if($bipolaridad == $loop->index+1)
                                <div class="md:col-span-1 md:inline-block hidden"></div>
                                @php
                                    $bipolaridad = $bipolaridad +3;
                                @endphp
                            @endif

                        @endforeach

                    </div>
                </div>

                <div class="pb-4">
                    {!! str_replace("\n", "<br>", $exposicion->descripcion) !!}
                </div>

            </div>
        </div>
    </div>

@endsection
