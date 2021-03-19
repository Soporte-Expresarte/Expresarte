<div class="sm:mt-8 mt-6 pb-4 text-white flex flex-row">
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::id()!=1)

        @if ($producto->en_venta == 0)
            <p class="bg-red-300 | rounded-xl p-1 | text-red-700 font-bold text-center">Este producto ya no está
                disponible</p>

        @elseif ($producto->stock == 0)
            <p class="text-red-700 font-bold">Producto agotado</p>

        @elseif ($productoEnCarrito)
        <!--boton con accesoa  los productos en carrito actuales -->
            <a href="{{ route("carrito") }}" target="_blank"
               class="bg-green-500 hover:bg-green-400 transition duration-500 inline-block sm:py-2 py-1 sm:px-4 px-2 rounded-md mr-4">
                Producto en
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-cart-fill inline-block mr-2 text-white" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </a>

            <!-- boton eliminar acarrito -->
            <button type="button" wire:click="borrarDelCarrito({{$producto->id}})"
                    class="bg-red-600 inline-block hover:bg-red-500 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                </svg>
            </button>

        @else
        <!-- boton elegir cantidad -->
            @if($isCard != 'si')

                <x-jet-input
                    class="flex text-center bg-purple-700 hover:bg-purple-600 transition duration-500 rounded-md mr-4 inline-block"
                    type="number" min="1"
                    max="{{$producto->stock}}"
                    style="width: 70px;" value=1
                    wire:model.defer="cantidad"></x-jet-input>
            @endif

        <!-- boton agregar acarrito -->
            <button wire:click="agregar" type="button"
                    class="bg-purple-700 inline-block hover:bg-purple-600 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                     fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
        @endif

        @if($isCard != 'si')
            <a href="{{ route('carrito') }}"
               class="bg-purple-700 hover:bg-purple-600 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md">
                Comprar
            </a>
        @endif

    @else
        <x-jet-input
            class="flex text-center bg-gray-800 hover:bg-gray-700 transition duration-500 rounded-md mr-4 inline-block"
            type="number" min="1"
            max="{{$producto->stock}}"
            style="width: 70px;" value=1
            wire:model.defer="cantidad"></x-jet-input>

        <button wire:click="registrarsePrimero" type="button"
                class="bg-gray-800 hover:bg-gray-700 inline-block transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                 fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
            </svg>
        </button>

        <a href="{{ route('login') }}"
           class="bg-gray-800 hover:bg-gray-700 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md">
            Comprar
        </a>

    @endif

    @error('cantidad')
    <div class="error text-red-700 flex-none">{{ $message }}</div> @enderror

</div>
