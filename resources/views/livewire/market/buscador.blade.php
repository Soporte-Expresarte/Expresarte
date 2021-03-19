<section>
    <div class="sm:flex sm:flex-row justify-center @if($on_index=='no') bg-gray-100 @endif pt-8 px-2">

        <div class="sm:inline-block sm:mr-4 ">
            <div class="flex border-grey-light border rounded-md">
                <input class="w-full rounded ml-1 p-2 bg-white" type="search" name="texto" id="texto"
                       placeholder="Buscar por título..." wire:model="texto" :value="old('texto')">

                <button wire:click="buscar_por_texto" type="submit"
                        class="bg-gray-800 border-grey border-l rounded-r-md shadow hover:bg-red-600 transition duration-500">
                        <span
                            class="w-auto flex justify-end items-center text-white px-4 py-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 mt-2 sm:mt-0 gap-2">

            @if($hay_resultados == 'si')
                <div class="sm:inline-block col-span-1 sm:mr-4 sm:mt-0">
                    <x-jet-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="flex-none p-3 bg-purple-600 hover:bg-purple-500 w-full rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Ordenar Por
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @foreach($ordenamiento_all as $ordenamiento)
                                <x-jet-dropdown-link
                                    href="{{ route('buscarPorTexto', [$texto, $ordenamiento] ) }}">
                                    <p>{{ $ordenamiento }}</p>
                                </x-jet-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @endif

            @auth
                @if(\Illuminate\Support\Facades\Auth::id()!=1)
                    <button
                        class="bg-purple-600 hover:bg-purple-500 py-2 sm:px-3 col-span-1 rounded-md sm:inline-block col-start-2 transition duration-500"
                        wire:click="ver_carrito">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 class="bi bi-cart-fill inline-block mr-2 text-white" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <p class="rounded-full px-3 bg-yellow-300 text-white inline-block" wire:model="carrito_num">
                                {{ $carrito_num }}
                            </p>
                        </div>
                    </button>
                @endif
            @endauth

        </div>

    </div>
</section>
