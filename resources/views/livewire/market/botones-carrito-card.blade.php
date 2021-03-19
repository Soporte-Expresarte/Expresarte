<div class="mt-2 pb-4 text-white grid grid-cols-2"
     style="position:absolute; bottom:0; left:0;">

@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::id()!=1)
    @if ($productoEnCarrito)

        <!-- boton eliminar acarrito -->
            <button type="button" wire:click="borrarDelCarrito({{$producto_artista->id}})"
                    class="bg-red-600 hover:bg-red-500 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                     class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                </svg>
            </button>
    @else

        <!-- boton agregar acarrito -->
            <button wire:click="agregar" type="button"
                    class="bg-purple-700 hover:bg-purple-600 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                     fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
    @endif
@else
    <!-- boton agregar acarrito -->
        <button wire:click="registrarsePrimero" type="button"
                class="bg-gray-800 hover:bg-gray-700 transition duration-500 sm:py-2 py-1 sm:px-4 px-2 rounded-md mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                 fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
            </svg>
        </button>
    @endif

    <p class="m-auto">
        ${{ number_format($producto_artista->precio, 0, ",", ".") }} CLP
    </p>
</div>
