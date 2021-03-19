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
            <div class="text-center text-gray-800 font-extrabold text-4xl md:py-10 py-6">
                <p>Administración de Carruseles</p>
                <hr class="max-w-xl mx-auto my-6 border-2">
            </div>

            <div>
                @foreach(\App\Models\CarruselCompleto::all() as $car)

                    <div class="text-2xl p-2 bg-gray-200 text-gray-800 my-4 flex justify-center rounded-md capitalize">
                        Sección {{ $car->seccion }}
                    </div>

                    @foreach($car->carruseles as $carrusel)
                        <div class="rounded-md bg-gray-800 hover:bg-gray-700 transition duration-500 text-white mb-4">
                            <img class="h-48 m-auto object-cover w-max-content rounded-t-md"
                                 src="{{ isset($carrusel->banner)? asset($carrusel->banner): asset('images/imagen-default.jpg') }}">

                            <div class="grid md:grid-cols-4 grid-cols-2 p-4">
                                <div class="md:col-span-3 col-span-2">
                                    <a @if( $car->seccion == 'inicio')
                                       href="{{ route('index-galeria') }}"
                                       @elseif( $car->seccion == 'artistas')
                                       href="{{ route('index-artistas') }}"
                                       @elseif( $car->seccion == 'obras')
                                       href="{{ route('index-exposiciones') }}"
                                       @elseif( $car->seccion == 'exposiciones')
                                       hred="{{ route('index-expo') }}"
                                       @elseif( $car->seccion == 'noticias')
                                       href="{{ route('index-noticias') }}"
                                       @elseif( $car->seccion == 'eventos')
                                       href="{{ route('index-eventos') }}"
                                       @elseif( $car->seccion == 'market')
                                       href="{{ route('index-market') }}"
                                       @elseif( $car->seccion == 'crowdfunding')
                                       href="{{ route('index-crowdfunding') }}"
                                       @else
                                       href="{{ route('index-galeria') }}"
                                        @endif
                                    >

                                        <div class="">Título:
                                            @if($carrusel->titulo == "") Sin Título
                                            @else <span class="font-semibold"> {{ $carrusel->titulo }} </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 font-light">Descripción: @if($carrusel->descripcion == "") Sin
                                            Descripción @else {{ $carrusel->descripcion }} @endif</div>
                                    </a>

                                </div>

                                <div class="m-2 mx-auto col-span-2 md:col-span-1">
                                    <button wire:click="edit({{ $carrusel->id }})"
                                            class="bg-green-500 hover:bg-green-400 font-semibold px-5 py-3 text-white rounded-md transition duration-500">
                                        {{ __('Editar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="h-8"></div>
                @endforeach
            </div>

        </div>
    </div>
</div>
