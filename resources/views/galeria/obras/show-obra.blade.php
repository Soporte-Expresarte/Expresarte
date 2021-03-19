@extends('galeria.helpers.body')

@section('title_head', 'Obras')

@section('content_body')

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

    <div class="bg-gray-100 sm:py-12 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <!-- Titulo de la obra -->
                <div class="text-center py-6">
                    <p class="text-4xl text-gray-800 font-bold">
                        {{ $obra->titulo }}
                    </p>
                </div>

                <!-- Imagen de la obra -->
                <div class="mb-8 mt-4">
                    <img class="mx-auto rounded-md"
                         src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                </div>

                <!-- Descripcion de la obra -->
                <div>
                    <div class="mt-4">
                        <p class="font-bold">Tipo:
                            <span class="text-gray-600 font-light">{{ $obra->tipo }}</span>
                        </p>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold">Autor:
                            <span
                                class="text-gray-600 font-light">{{ $obra->usuario->name }} {{ $obra->usuario->apellido }}</span>
                        </p>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold">Descripción:
                            <span class="text-gray-600 font-light">
                                {!! str_replace("\n", "<br>", $obra->descripcion) !!}
                            </span>
                        </p>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold">Especificaciones:
                            <span class="text-gray-600 font-light">{{ $obra->especificaciones }}</span>
                        </p>
                    </div>
                </div>

                <!-- mas obras del artista titulo-->
                <div class="grid grid-cols-1 mt-12">
                    <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                        Mas Obras de {{ $obra->usuario->name }} {{ $obra->usuario->apellido }}
                    </p>
                </div>

                <!-- mas obras del artista imagenes-->
                <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-8">
                    @forelse($obras as $obra_autor)
                        <div
                            class="shadow-md bg-gray-100 rounded-md hover:bg-gray-900 hover:text-gray-100 transition duration-500">
                            <div class="p-2 rounded-md">
                                <div class="p-2">
                                    <a href="{{ route('show-obra', $obra_autor) }}">

                                        <img class="w-full object-cover rounded-lg h-48"
                                             src="{{ isset($obra_autor->imagenes->last()->ruta)? asset($obra_autor->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                    </a>
                                </div>

                                <div class="font-bold px-2">
                                    <div class="mt-2">
                                        Título: <span class="font-light">{{ $obra_autor->titulo }}</span>
                                    </div>
                                    <div class="my-2">
                                        Tipo: <span class="font-light">{{ $obra_autor->tipo }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="text-center">
                            <p class="text-xl text-gray-800 font-bold">No hay Obras publicadas
                                por {{ $obra_autor->name }}</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

@endsection

<script src=" {{ asset("js/galeria/obras/gallery.js") }}">

</script>
