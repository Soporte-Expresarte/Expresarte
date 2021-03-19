<div>

    <div class="px-6">
        <div class="lg:max-w-6xl w-full mx-auto lg:mb-10 mb-4">

            <div class="text-center desaparece_5_segs">
                @if (session()->has('success'))
                    <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <!-- TITULO PRINCIPAL DEL INDEX DE OBRAS -->
            <div class="text-center text-gray-800 font-extrabold text-5xl md:py-10 py-6">
                <p>Administración de Exposiciones</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <!-- noticias del artista imagenes-->
            <div class="py-2">
                <div class="grid grid-flow-row auto-rows-max grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @forelse($expo_all->sortByDesc('created_at') as $expo_uni)
                        <div
                            class="shadow-md rounded-md bg-gray-800 hover:bg-gray-700 transition duration-500">

                            <div class="p-2 rounded-lg">

                                <div class="p-2">
                                    <a href="{{ route('show-expo', $expo_uni->id) }}">
                                        <div class="grid grid-cols-2">
                                            @foreach ($expo_uni->obras as $obra)
                                                <div class="col-span-1 row-span-1">
                                                    <img class="h-48 m-auto object-cover w-max-content"
                                                         src="{{ isset($obra->imagenes->last()->ruta)? asset($obra->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">
                                                </div>
                                                @if($loop->index == 3) @break @endif
                                            @endforeach
                                        </div>
                                    </a>
                                </div>

                                <div class="font-bold px-2 pb-4 text-white">
                                    <div class="mt-4">
                                        Título: <span class="font-light">{{ $expo_uni->titulo }}</span>
                                    </div>
                                    <div class="mt-2">
                                        Fecha: <span class="font-light mr-4">{{ $expo_uni->created_at }}</span>

                                        Obras: <span class="font-light">{{ $expo_uni->obras->count() }} </span>
                                    </div>

                                    <div class="mt-4 flex justify-center">
                                        <button wire:click="edit({{ $expo_uni->id }})"
                                                class="bg-green-600 hover:bg-green-500 font-semibold px-5 py-3 text-white rounded-md transition duration-500">
                                            {{ __('Editar') }}
                                        </button>

                                        <div class="px-4"></div>
                                        <button wire:click="delete({{ $expo_uni }})"
                                                class="bg-red-600 hover:bg-red-500 font-semibold px-5 py-3 text-white rounded-md transition duration-500">
                                            {{ __('Eliminar') }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="text-center">
                            <div class="text-center">No hay Noticias registradas</div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
