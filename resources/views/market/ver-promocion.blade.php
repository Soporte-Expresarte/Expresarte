<x-market-layout>
    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">
    @endsection

    @section("content")
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

        <div class="carousel relative bg-center container max-w-full mx-auto">
            <div class="carousel-inner relative overflow-hidden max-w-full">

                <!--Slide 1-->
                <input class="carousel-open is-actual" type="radio" id="carousel-1" name="carousel" aria-hidden="true"
                       hidden=""
                       checked="checked">
                <div class="carousel-item absolute opacity-0" style="height:60vh;">

                    <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-center"
                         style="background-image: url({{ isset($promocion->banner_path)? asset($promocion->banner_path): asset('images/imagen-default.jpg') }}); background-repeat: no-repeat;">
                    </div>

                </div>
            </div>
        </div>

        <!-- barra de busqueda -->
        @livewire('market.buscador', ['texto'=>'', 'hay_resultados'=>'no', 'on_index'=>'no'])

        <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 rounded-md">

                    <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                    <div class="text-center desaparece_5_segs">
                        @if (session()->has('success'))
                            <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                                ✔️{{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-bold">
                            {{ $promocion->titulo }}
                        </p>
                    </div>

                @if($productos_all->count() >0 )
                    <!-- boton de ordenamiento -->
                        <div class="mt-8">
                            <x-jet-dropdown align="left">
                                <x-slot name="trigger">
                                    <button
                                        class="flex-none px-4 py-2 bg-purple-600 hover:bg-purple-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        Ordenar Por
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach($ordenamientos as $orden)
                                        <x-jet-dropdown-link
                                            href="{{ route('ver-promocion', [$promocion->id, $orden]) }}">
                                            {{$orden}}
                                        </x-jet-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    @endif

                    <div
                        class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 mt-8 pb-6">

                        @forelse($productos_all as $producto_artista)
                            <div
                                class="bg-blue-600 shadow-md p-2 sm:p-4 rounded-md hover:bg-blue-500 transition duration-500"
                                style="position: relative">
                                <div>
                                    <a href="{{ route('ver-producto', $producto_artista->slug) }}">
                                        <img
                                            src="{{ isset($producto_artista->imagenes->last()->ruta)? asset($producto_artista->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}"
                                            class="w-full object-cover rounded-md sm:h-48 h-32">
                                    </a>
                                </div>

                                <div class="text-white">
                                    <div class="mt-4 font-semibold limitlines2">
                                        {{ $producto_artista->nombre }}
                                    </div>

                                    <div class="flex py-2">
                                        <div class="mr-2 flex-shrink-0">
                                            <img class="rounded-full sm:h-14 h-8 sm:w-14 w-8"
                                                 src="{{asset($producto_artista->artista->profile_photo_url)}}"/>
                                        </div>

                                        <div class="font-light">
                                            <div class="limitlines1">
                                                {{ $producto_artista->artista->name}} {{ $producto_artista->artista->apellido}}
                                            </div>

                                            <a class="py-1 px-2 bg-purple-700 hover:bg-purple-600 transition duration-500 inline-block rounded-md"
                                               href="{{ route('buscarPorCategoria', [$producto_artista->categoria->id]) }}">
                                                <div
                                                    class=" text-sm text-white ">
                                                    {{ $producto_artista->categoria->nombre }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:h-12 h-16"></div>

                                @livewire("market.agregar-producto-form", ['producto' => $producto_artista, 'isCard' =>
                                'si'])

                            </div>
                        @empty
                            <div class="h-16"></div>
                            <div class="grid grid-cols-1 mt-12 pb-8">
                                <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                                    No hay resultados para esta promocion
                                </p>
                            </div>
                            <div class="h-16"></div>
                        @endforelse
                    </div>

                    @if($productos_all->count() >0 )
                    <!-- todos los productos recomendados por tema -->
                        <div class="grid grid-cols-1 mt-12">
                            <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                                Creaciones para Temas similares
                            </p>
                        </div>

                        <div
                            class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 mt-8 pb-6">

                            @forelse($tema_recomen as $producto_artista)
                                <div
                                    class="bg-blue-600 shadow-md p-2 sm:p-4 rounded-md hover:bg-blue-500 transition duration-500"
                                    style="position: relative">
                                    <div>
                                        <a href="{{ route('ver-producto', $producto_artista->slug) }}">
                                            <img
                                                src="{{ isset($producto_artista->imagenes->last()->ruta)? asset($producto_artista->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}"
                                                class="w-full object-cover rounded-md sm:h-48 h-32">
                                        </a>
                                    </div>

                                    <div class="text-white">
                                        <div class="mt-4 font-semibold limitlines2">
                                            {{ $producto_artista->nombre }}
                                        </div>

                                        <div class="flex py-2">
                                            <div class="mr-2 flex-shrink-0">
                                                <img class="rounded-full sm:h-14 h-8 sm:w-14 w-8"
                                                     src="{{asset($producto_artista->artista->profile_photo_url)}}"/>
                                            </div>

                                            <div class="font-light">
                                                <div class="limitlines1">
                                                    {{ $producto_artista->artista->name}} {{ $producto_artista->artista->apellido}}
                                                </div>

                                                <a class="py-1 px-2 bg-purple-700 hover:bg-purple-600 transition duration-500 inline-block rounded-md"
                                                   href="{{ route('buscarPorCategoria', [$producto_artista->categoria->slug]) }}">
                                                    <div
                                                        class=" text-sm text-white ">
                                                        {{ $producto_artista->categoria->nombre }}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:h-12 h-16"></div>

                                    @livewire("market.agregar-producto-form", ['producto' => $producto_artista, 'isCard'
                                    =>
                                    'si'])

                                </div>
                            @empty
                                <div class="h-16"></div>
                                <div class="grid grid-cols-1 mt-12 pb-8">
                                    <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                                        No hay resultados Productos recomendados por Tema
                                    </p>
                                </div>
                                <div class="h-16"></div>
                            @endforelse
                        </div>
                    @endif

                </div>
            </div>
        </div>

    @endsection
</x-market-layout>
