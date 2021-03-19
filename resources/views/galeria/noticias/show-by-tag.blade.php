@extends('galeria.helpers.body')

@section('title_head', 'Noticia')

@section('content_body')

    <style>
        .limitlines2 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
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

                <!-- Titulo para periodo-->
                <div class="text-center pt-8">
                    <p class="text-4xl text-gray-800 font-bold">
                        Noticias Relacionadas a Tag <span class="italic">#{{ $tag_principal->nombre }}</span>
                    </p>
                </div>

                <div class="mt-12 pb-6">

                    <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 pb-8">
                    @forelse($noticias as $noticia)
                        <!-- CUADRO COMUN PARA UNA PAGINA COMUN (DESDE LA PAG 2 HACIA ADELANTE)-->
                            <div class="shadow-lg bg-center bg-no-repeat"
                                 style="background-image: url({{ isset($noticia->imagen_path)?
                                     asset($noticia->imagen_path): asset('images/imagen-default.jpg') }}); border-radius: 0.375rem">

                                <div class="p-4 text-white bg-gray-800 rounded-t-md">
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
                                <div class="rounded-md p-2">
                                    <div class="text-white rounded-lg bg-gray-800 limitlines4 p-2"
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
                        @empty
                            <div class="h-16"></div>
                            <div class="grid grid-cols-1 mt-12 pb-8">
                                <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                                    No hay Noticias relacionadas a el Tag {{$tag_principal->nombre }}
                                </p>
                            </div>
                            <div class="h-16"></div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
