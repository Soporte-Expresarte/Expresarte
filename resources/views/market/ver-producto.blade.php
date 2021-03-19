<x-market-layout>
    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset("css/expresarte.css") }}">

    @section("content")

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

        <!-- barra de busqueda -->
        @livewire('market.buscador', ['texto'=>'', 'hay_resultados'=>'no', 'on_index'=>'no'])

        <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 rounded-md">

                    <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                    <div class="text-center desaparece_5_segs">
                        <div class="h-3"></div>
                        @if (session()->has('success'))
                            <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                                ✔️{{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-bold">
                            {{ $producto->nombre }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 grid-cols-1 mt-4">
                        <!-- Imagen del producto -->
                        <div class="mb-4 sm:mb-0">
                            <img class="rounded-md mx-auto"
                                 src="{{ isset($producto->imagenes->last()->ruta)? asset($producto->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">

                            <!-- reportar producto -->
                            @if(\Illuminate\Support\Facades\Auth::check())
                                @if(\Illuminate\Support\Facades\Auth::user()->currentTeam->id == 2 || \Illuminate\Support\Facades\Auth::user()->currentTeam->id == 3)
                                    <div class="mt-4 inline-block">
                                        <a href="{{ route('reportar-producto', ['id' => $producto->id]) }}">
                                            <div
                                                class="py-1 px-3 rounded-lg bg-red-600 hover:bg-red-500 transition duration-500 text-white text-sm">
                                                Reportar
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- datos del artistas y tipos -->
                        <div class="sm:pl-4">

                            <div class="bg-gray-800 rounded-2xl p-4 mx-auto text-white">
                                <div class="flex">
                                    <div class="mr-4 inline-block">
                                        <img class="rounded-full h-14 w-14" alt="Foto perfil artista"
                                             src="{{asset($producto->artista->profile_photo_url)}}"/>
                                    </div>

                                    <div class="my-2">
                                        <p class="text-lg font-bold limitlines1">{{ $producto->artista->name }} {{ $producto->artista->apellido }}</p>
                                        <p class="limitlines1">{{Carbon\Carbon::parse($producto->artista->fecha_nacimiento)->age}}
                                            Años de edad.</p>
                                    </div>
                                </div>

                                <a class="py-1 px-2 bg-yellow-300 hover:bg-yellow-200 text-gray-800 transition duration-500 inline-block rounded-md mr-2"
                                   href="{{ route('buscarPorTema', [$producto->tema->id]) }}">
                                    <p>
                                        {{ $producto->tema->nombre }}
                                    </p>
                                </a>
                                <a class="py-1 px-2 bg-purple-700 hover:bg-purple-600 transition duration-500 inline-block rounded-md"
                                   href="{{ route('buscarPorCategoria', [$producto->categoria->id]) }}">
                                    <p
                                        class="text-white">
                                        {{ $producto->categoria->nombre }}
                                    </p>
                                </a>
                            </div>

                            <!-- Impresion de datos del producto -->
                            <div class="sm:mt-8 mt-6">
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
                                    </svg>
                                </div>

                                <span class="text-lg font-sans font-bold">Stock: </span>

                                <div class="inline-block text-lg font-light">
                                    {{$producto->stock}} unidades disponibles
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-rulers" viewBox="0 0 16 16">
                                        <path
                                            d="M1 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h5v-1H2v-1h4v-1H4v-1h2v-1H2v-1h4V9H4V8h2V7H2V6h4V2h1v4h1V4h1v2h1V2h1v4h1V4h1v2h1V2h1v4h1V1a1 1 0 0 0-1-1H1z"/>
                                    </svg>
                                </div>

                                <span class="text-lg font-sans font-bold">Dimensiones: </span>

                                <div class="inline-block text-lg font-light">
                                    {{$producto->largo}}
                                    * {{$producto->ancho}} {{isset($producto->alto) ? " * ".$producto->alto." ".html_entity_decode("cm&sup3;") : " wire:".html_entity_decode("cm&sup2;")}}
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-truck" viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>

                                <span class="text-lg font-sans font-bold">Costo de Envío: </span>

                                <div class="inline-block text-lg font-light">
                                    Envío por pagar
                                </div>
                            </div>

                            <div class="mt-2">
                                <!-- boton de agregar al carrito -->
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-cash" viewBox="0 0 16 16">
                                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                        <path
                                            d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                                    </svg>
                                </div>

                                <span class="text-lg font-sans font-bold">Precio: </span>

                                <div class="inline-block text-lg font-light">
                                    ${{ number_format($producto->precio, 0, ",", ".") }} CLP
                                </div>
                            </div>

                            @livewire("market.agregar-producto-form", ['producto' => $producto])
                        </div>
                    </div>

                    <div class="mt-8">
                        <p class="text-lg font-sans font-bold">Descripción:
                            <span class="text-gray-600 font-light">
                                {!! str_replace("\n", "<br>", $producto->descripcion) !!}
                            </span>
                        </p>
                    </div>

                    <!-- titulo mas creaciones del artista-->
                    <div class="grid grid-cols-1 mt-12">
                        <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                            Más Creaciones de {{ $producto->artista->name }} {{ $producto->artista->apellido }}
                        </p>
                    </div>

                    <!-- todas las creaciones del artista en venta-->
                    <div
                        class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 mt-8 pb-6">
                        @forelse($relacionados as $producto_artista)

                            <div
                                class="bg-blue-600 shadow-md p-2 sm:p-4 rounded-md hover:bg-blue-500 transition duration-500"
                                style="position: relative">
                                <div>
                                    <a href="{{ route('ver-producto', [$producto_artista->slug]) }}">
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
                            <div
                                class="hover:bg-gray-200 rounded-md transition duration-500">
                                <div class="flex h-full text-2xl font-semibold text-gray-800 p-2">
                                    <div class="m-auto text-center">
                                        <p>
                                            Actualmente no hay Productos nuevos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- titulo mas creaciones del artista-->
                    <div class="grid grid-cols-1 mt-12">
                        <p class="text-4xl text-gray-800 font-bold mx-auto text-center">
                            Creaciones de la misma Categoria {{ $producto->categoria->nombre }}
                        </p>
                    </div>

                    <!-- todas las creaciones del artista en venta-->
                    <div
                        class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 mt-8 pb-6">

                        @forelse($categoria_rel as $producto_artista)

                            <div
                                class="bg-blue-600 shadow-md p-2 sm:p-4 rounded-md hover:bg-blue-500 transition duration-500"
                                style="position: relative">
                                <div>
                                    <a href="{{ route('ver-producto', [$producto_artista->slug]) }}">
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
                            <div
                                class="hover:bg-gray-200 rounded-md transition duration-500">
                                <div class="flex h-full text-2xl font-semibold text-gray-800 p-2">
                                    <div class="m-auto text-center">
                                        <p>
                                            Actualmente no hay Productos nuevos.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    @endsection
</x-market-layout>
