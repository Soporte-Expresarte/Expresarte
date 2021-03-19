<div>


    <style>
        .limitlines3 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
    </style>

    <!-- barra de busqueda -->
    @livewire('market.buscador', ['texto'=>'', 'hay_resultados'=>'no', 'on_index'=>'no'])

    <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white sm:px-6 px-4 rounded-md">

                <!-- Titulo del producto -->
                <div class="text-center py-6">
                    <p class="text-4xl text-gray-800 font-bold">
                        Productos en Carrito para compras
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3">

                    <div class="col-span-2 sm:mr-4 pb-2">
                        @forelse($productos_carrito as $producto_artista)
                            <div class="bg-blue-700 text-white p-2 rounded-md mb-4 grid grid-cols-3">

                                <a href="{{ route("ver-producto", ['slug' => $producto_artista->slug]) }}"
                                   class="flex flex-wrap content-center">
                                    <img class="h-32 w-32 object-cover rounded-md"
                                         src="{{isset($producto_artista->imagenes->last()->ruta)? asset($producto_artista->imagenes->last()->ruta) : asset('images/imagen-default.jpg')}}">
                                </a>

                                <div class="flex flex-wrap content-center px-2">
                                    <div class="font-semibold limitlines3">
                                        {{ $producto_artista->nombre }}
                                    </div>
                                    <div class="mt-2">
                                        <p>${{number_format($producto_artista->precio, 0, ",", ".")}} CLP c/u</p>
                                    </div>
                                </div>

                                <div class="flex flex-wrap content-center justify-end">
                                    <div class="grid grid-rows-2">
                                        <x-jet-input class="text-black w-16 h-10" type="number" min="1"
                                                     max="{{$producto_artista->stock}}"
                                                     wire:change="actualizarCantidad({{ $producto_artista }}, $event.target.value)"
                                                     value="{{$producto_artista->pivot->cantidad}}"/>

                                        <button type="button" wire:click="eliminarProducto({{$producto_artista->id}})"
                                                class="bg-red-600 mt-1 hover:bg-red-500 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                 fill="currentColor"
                                                 class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <div class="h-16"></div>
                            <div class="grid grid-cols-1 mt-12 pb-8">
                                <p class="text-2xl text-gray-800 font-bold mx-auto text-center">
                                    Actualmente no hay Productos en el Carrito.
                                </p>
                            </div>
                            <div class="h-16"></div>

                        @endforelse
                    </div>

                    <div class="col-span-1 col-span-2 sm:col-span-1 pb-6">
                        <div class="bg-gray-800 rounded-2xl p-4 text-white">
                            <p class="text-center text-xl font-bold">
                                Detalles de la Compra
                            </p>

                            <div class="text-lg grid grid-cols-2 mt-4">
                                <div>
                                    <p class="inline-block">Productos</p>
                                </div>

                                <div>
                                    ${{number_format($carrito->monto_total, 0, ",", ".")}} CLP
                                </div>
                            </div>

                            <div class="text-lg text-white">
                                Env&iacute;o por pagar
                            </div>


                            <!-- Línea divisoria -->
                            <div class="py-4">
                                <div class="border-t border-gray-300"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <p class="text-lg font-bold">Total</p>
                                <p class="text-lg">${{number_format($carrito->monto_total, 0, ",", ".")}} CLP</p>
                            </div>

                            <form method="GET" action="{{ route("despacho") }}">
                                <button type="submit"
                                        class="bg-green-500 w-full mt-4 text-xl py-2 hover:bg-green-400 rounded-md text-center transition duration-500">
                                    Continuar
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
