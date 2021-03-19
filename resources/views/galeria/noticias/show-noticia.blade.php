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

    <!-- el banner con las noticias -->
    <div class="container mx-auto max-w-full">
        <div class="w-full">
            <div style="height:40vh;">
                <div
                    class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center bg-no-repeat"
                    style="background-image: url({{ isset($noticia->portada_path)? asset($noticia->portada_path): asset('images/imagen-default.jpg') }});">
                    <div class="container bg-black rounded-lg flex-1 mx-auto p-4" style="--bg-opacity: 30%">
                        <div class="text-white bg-center text-center underline font-bold text-4xl my-6">
                            {{ $noticia->titulo }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <!-- titulo para la noticia -->
                <span class="font-light pt-4 flex justify-end">
                    <span>Noticia publicada por
                        <span class="font-semibold">{{ $autor->name }} {{ $autor->apellido }}</span> el {{ $noticia->created_at }}</span>
                </span>

                <!-- los tags para la noticia actual -->
                <div class="bg-gray-800 p-2 rounded-md mt-4 text-center">
                    @forelse($noticia->tags as $tag)
                        <a href="{{ route('show-by-tag',['tag'=>$tag->id]) }}">
                            <span
                                class="text-md font-light my-auto mx-1 px-3 bg-gray-200 hover:bg-white text-black rounded-full transition duration-500">
                                {{ $tag->nombre }}
                            </span>
                        </a>
                    @empty
                        <span
                            class="text-md font-light my-auto mx-1 px-3 bg-white text-black rounded-full transition duration-500">no tags
                        </span>
                    @endforelse
                </div>

                <!-- todo el texto de la noticia -->
                <div class="font-bold text-2xl mt-8 text-center">
                    {{ $noticia->sub_titulo }}
                </div>

                <img class="mx-auto mt-8 rounded-md"
                     src="{{ isset($noticia->imagen_path)? asset($noticia->imagen_path): asset('images/imagen-default.jpg') }}">

                <div class="font-bold mt-6">
                    {!! str_replace("\n", "<br>", $noticia->bajada) !!}
                </div>

                <div class="mt-6">
                    {!! str_replace("\n", "<br>", $noticia->cuerpo) !!}
                </div>

                <!-- TITULO DE MAS noticias DEL AUTOR -->
                <div class="grid grid-cols-1 mt-12">
                    <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                        Noticias Relacionadas
                    </p>
                </div>

                <!-- seccion con Noticias relaciopnadas -->
                <div class="mt-8 pb-6">
                    <div class="grid grid-cols-1 grid-flow-row auto-rows-max gap-6 sm:grid-cols-2">
                        @forelse($relacionados as $uniqueNoticia)
                        <!-- CUADRO COMUN PARA UNA PAGINA COMUN (DESDE LA PAG 2 HACIA ADELANTE)-->
                            <div class="shadow-md bg-center bg-no-repeat"
                                 style="background-image: url({{ isset($uniqueNoticia->imagen_path)?
                                     asset($uniqueNoticia->imagen_path): asset('images/imagen-default.jpg') }}); border-radius: 0.375rem">

                                <div class="p-4 text-white bg-gray-800 rounded-t-md">
                                    <div class="grid grid-cols-3">

                                        <!-- TAGS PARA LA NOTICIA COMUN -->
                                        <div class="col-span-2">
                                            @forelse($uniqueNoticia->tags as $tag)
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
                                            {{ $uniqueNoticia->fecha_noticia }}
                                        </div>
                                    </div>

                                    <!-- TITULO PARA LA NOTICIA COMUN -->
                                    <div class="text-center mt-2 limitlines2">
                                        <div class="text-center my-auto font-semibold">
                                            {{ $uniqueNoticia->titulo }}
                                        </div>
                                    </div>
                                </div>

                                <!-- SUB_TITULO PARA LA NOTICIA COMUN -->
                                <div class="rounded-md p-2">
                                    <div class="text-white rounded-lg bg-gray-800 limitlines4 p-1"
                                         style="--bg-opacity: 30%">
                                        <div class="text-center">
                                            {{ $uniqueNoticia->sub_titulo }}
                                        </div>
                                    </div>

                                    <!-- BOTON LEER MAS PARA LA NOTICIA MAS RECIENTE-->
                                    <div class="font-medium p-2">
                                        <a href="{{ route('show-noticia', $uniqueNoticia->id) }}">
                                            <button
                                                class="bg-gray-200 hover:bg-white transition duration-500 rounded-full py-2 px-4 mx-auto">
                                                Leer más..
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">No hay noticias relacionadas a los tags</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
