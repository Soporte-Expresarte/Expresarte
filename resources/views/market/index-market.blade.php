<x-market-layout>
    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">
    @endsection

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

        @livewire('carrusel-unico', ['tipo'=>'market'])

        <div class="px-6 ">
            <div class="lg:max-w-6xl w-full mx-auto lg:pb-10 pb-4">

                <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                <div class="text-center desaparece_5_segs">
                    @if (session()->has('success'))
                        <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                            ✔️{{ session('success') }}
                        </div>
                    @endif
                </div>

                <!-- TITULO PRINCIPaL-->
                <div class="text-center text-gray-800 font-extrabold text-5xl md:pt-10 pt-6">
                    <p>Market Expresarte</p>
                    <hr class="max-w-xl mx-auto mt-6 border-2">
                </div>

                <!-- barra de busqueda -->
                @livewire('market.buscador', ['hay_resultados'=>'no', 'on_index'=>'si'])
                <div class="h-16"></div>

                <!-- impresion de las categorias -->
                <div>
                    <p class="text-lg md:text-2xl font-sans text-center p-2 block bg-purple-600 text-white rounded-md">
                        <span class="text-yellow-200">★</span>
                        <span class="font-bold">¡Categorias!</span> Puedes buscar creaciones por aquí
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4 mt-4">
                    @foreach($categorias as $categoria)
                        <a class="bg-purple-700 hover:bg-purple-600 transition duration-500 @if(($loop->index)%3==0) col-span-2 @endif py-4 rounded-md"
                           href="{{ route('buscarPorCategoria', [$categoria->id]) }}">
                            <div class="text-center text-white font-sans">
                                {{ $categoria->nombre }}
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="h-16"></div>

                <!-- promociones y avisos pequeños -->
                <div class="">
                    <p class="text-lg md:text-2xl font-sans text-center p-2 block bg-red-500 text-white rounded-md">
                        <span class="text-yellow-200">★</span> ¡Aquí puedes encontrar promociones y avisos de venta
                        especiales!</p>
                </div>

                <div
                    class="grid grid-flow-row grid-cols-2 gap-2 sm:gap-4 md:grid-cols-4 mt-4">
                    <div class="rounded-2xl row-span-2 col-span-2"
                         style="background-image: url('https://live.staticflickr.com/65535/50947316092_a04fb54482.jpg'); background-position: center;">
                        <div class="h-80 md:h-96"></div>
                    </div>

                    @foreach($promoSuperior as $superior)
                        @if($loop->index<3)
                            <div
                                class="rounded-2xl border hover:shadow-xl transition-shadow duration-500 @if(($loop->index)%3==0) col-span-2 @endif">
                                <a href="{{ route('ver-promocion', $superior->id) }}">
                                    <img
                                        src="{{ isset($superior->imagen_path)? asset($superior->imagen_path): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-lg h-48">
                                </a>
                            </div>
                        @else
                            <div
                                class="rounded-2xl border hover:shadow-xl transition-shadow duration-500 @if(($loop->index)%5==0 || ($loop->index)%6==0) col-span-2 @endif">
                                <a href="{{ route('ver-promocion', $superior->id) }}">
                                    <img
                                        src="{{ isset($superior->imagen_path)? asset($superior->imagen_path): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-lg h-48">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="h-16"></div>

                <!-- los productos mas nuevos -->
                <div class="">
                    <p class="text-lg md:text-2xl font-sans text-center p-2 block bg-blue-600 text-white rounded-md">
                        <span class="text-yellow-200">★</span>
                        <span class="font-bold">¡Nuevos Productos!</span> Últimos productos agregados a nuestro sitio
                    </p>
                </div>

                <div
                    class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 lg:grid-cols-4 mt-4">

                    @forelse($productosMasNuevos as $producto_artista)

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
                                <a href="{{ route('ver-producto', [$producto_artista->slug]) }}"
                                   class="mt-4 font-semibold limitlines2">
                                    {{ $producto_artista->nombre }}
                                </a>

                                <div class="flex py-2">
                                    <div class="mr-2 flex-shrink-0">
                                        <img class="rounded-full sm:h-14 h-8 sm:w-14 w-8"
                                             src="{{asset($producto_artista->artista->profile_photo_url)}}"/>
                                    </div>

                                    <div class="font-light">
                                        <div class="limitlines1">
                                            {{$producto_artista->artista->name}} {{$producto_artista->artista->apellido}}
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


                <div class="h-16"></div>

                <!-- promociones y avisos pequeños -->
                <div class="">
                    <p class="text-lg md:text-2xl font-sans text-center p-2 block bg-red-500 text-white rounded-md">
                        <span class="text-yellow-200">★</span>
                        ¡Ofertas de temporada, avisos de cursos artísticos y mucho más!</p>
                </div>

                <div
                    class="grid grid-flow-row grid-cols-2 gap-2 sm:gap-4 md:grid-cols-4 mt-4">
                    <div class="rounded-2xl row-span-2 col-span-2"
                         style="background-image: url('https://live.staticflickr.com/65535/50947091851_081f01d1fb.jpg'); background-position: center;">
                        <div class="h-80 md:h-96"></div>
                    </div>

                    @foreach($promoInferior as $inferior)
                        @if($loop->index<3)
                            <div
                                class="rounded-2xl border hover:shadow-xl transition-shadow duration-500 @if(($loop->index)%3==0) col-span-2 @endif">
                                <a href="{{ route('ver-promocion', $inferior->id) }}">
                                    <img
                                        src="{{ isset($inferior->imagen_path)? asset($inferior->imagen_path): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-lg h-48">
                                </a>
                            </div>
                        @else
                            <div
                                class="rounded-2xl border hover:shadow-xl transition-shadow duration-500 @if(($loop->index)%5==0 || ($loop->index)%6==0) col-span-2 @endif">
                                <a href="{{ route('ver-promocion', $inferior->id) }}">
                                    <img
                                        src="{{ isset($inferior->imagen_path)? asset($inferior->imagen_path): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-lg h-48">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="h-16"></div>

                <!-- los productos mas vendidos -->
                <div class="">
                    <p class="text-lg md:text-2xl font-sans text-center p-2 block bg-blue-600 text-white rounded-md">
                        <span class="text-yellow-200">★</span>
                        <span class="font-bold">¡Productos más Populares!</span> Son los más vendidos en la comunidad
                    </p>
                </div>

                <div
                    class="grid grid-flow-row auto-rows-max grid-cols-2 gap-2 sm:gap-4 sm:grid-cols-3 lg:grid-cols-4 mt-4">

                    @forelse($productosMasVendidos as $producto_artista)

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
                                <a href="{{ route('ver-producto', [$producto_artista->slug]) }}"
                                   class="mt-4 font-semibold limitlines2">
                                    {{ $producto_artista->nombre }}
                                </a>

                                <div class="flex py-2">
                                    <div class="mr-2 flex-shrink-0">
                                        <img class="rounded-full sm:h-14 h-8 sm:w-14 w-8"
                                             src="{{asset($producto_artista->artista->profile_photo_url)}}"/>
                                    </div>

                                    <div class="font-light">
                                        <div class="limitlines1">
                                            {{$producto_artista->artista->name}} {{$producto_artista->artista->apellido}}
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
                            'si', 'on_index'=>'si'])

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

                <div class="h-16"></div>

            </div>
        </div>

    @endsection
</x-market-layout>
