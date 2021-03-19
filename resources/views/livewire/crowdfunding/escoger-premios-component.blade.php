<div>

    <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">

        @if($vista_actual == "seleccionar_premios")
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 pb-2 rounded-md">

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
                        <p class="text-4xl text-gray-800 font-sans">
                            {{ $proyecto->titulo }}
                        </p>

                        <p class="text-2xl text-gray-800 font-sans">
                            Sección para definir el monto a donar y opcionalmente solicitar regalos según su
                            disponibilidad.
                        </p>
                    </div>

                    <div class="h-8"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 mt-4 mb-2 gap-4">
                        <div class="sm:col-span-2 text-white">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @forelse($proyecto->premios as $premio)
                                    <div>
                                        <div
                                            class="bg-orange-500 rounded-xl hover:bg-orange-400 transition duration-500 p-2">
                                            <div class="text-center">
                                                {{ $premio->nombre }}
                                            </div>

                                            <div
                                                class="mt-2 font-light border-dashed border-2 px-2 py-1 rounded-xl border-gray-800">
                                                {{$premio->descripcion}}
                                            </div>

                                            <div
                                                class="bg-red-600 hover:bg-red-500 transition duration-500 p-2 rounded-xl mt-2">
                                                <div>
                                                    Mínimo de ${{number_format($premio->precio_minimo ,0,',','.')}} CLP
                                                </div>

                                                <div class="mt-2">
                                                    Elegir cantidad ({{ $premio->cantidad_actual }}
                                                    de {{ $premio->cantidad_maxima }})
                                                </div>

                                                <div class="mt-2 text-gray-800">
                                                    <x-jet-input class="w-1/2 h-8" type="number" min="0"
                                                                 max="{{$premio->cantidad_actual}}" step="1"
                                                                 wire:model.lazy="cantidades_premio.{{$loop->index}}"/>
                                                </div>
                                                @error("cantidades_premio.{$loop->index}")
                                                <div class="text-red-700">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="h-8"></div>
                                    <div class="text-center p-4 text-gray-800">No hay Recompensas registradas aún.</div>
                                    <div class="h-8"></div>
                                @endforelse
                            </div>
                        </div>

                        <div class="text-white">
                            <div class="bg-gray-800 hover:bg-gray-700 transition duration-500 p-4 mb-2 rounded-xl">
                                <div class="mt-2">
                                    Donacion adicional
                                    <x-jet-input class="w-1/2 mt-2 text-gray-800 h-8"
                                                 wire:model.lazy="donacion_adicional"
                                                 type="number" min="0"/>
                                </div>
                                @error("donacion_adicional")
                                <div class="text-red-700">{{ $message }}</div> @enderror

                                <div class="text-2xl mt-8 text-center">
                                    Monto a pagar
                                    <span class="inline-block">
                                    ${{ number_format($donacion_total,0,',','.') }} CLP
                                </span>
                                </div>
                                @error("donacion_total")
                                <div class="text-red-700">{{ $message }}</div> @enderror

                                <button type="button" wire:click="vistaDespacho()"
                                        class="w-full text-lg mt-4 bg-green-500 hover:bg-green-400 transition duration-500 p-2 text-center rounded-xl">
                                    Siguiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($vista_actual == "seleccionar_despacho")
            <div class="sm:py-16 sm:px-6 px-2 py-8">
                <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                    <div class="text-center">
                        <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                            Datos para reparto
                        </h1>
                    </div>

                    <div class="mt-10 form-group">
                        <x-jet-label class="font-light text-sm text-gray-800" for="calle"
                                     value="{{ __('* Calle') }}"/>
                        <x-jet-input id="calle"
                                     class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                     type="text" name="calle"
                                     :value="old('calle')" autofocus autocomplete="calle" wire:model.lazy="calle"/>
                        @error('calle')
                        <div class="text-red-700">{{ $message }}</div> @enderror
                    </div>

                    <div class="mt-4 form-group">
                        <x-jet-label class="font-light text-sm text-gray-800" for="comuna"
                                     value="{{ __('* Comuna') }}"/>
                        <x-jet-input id="comuna"
                                     class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                     type="text" name="comuna"
                                     :value="old('comuna')" autofocus autocomplete="comuna"
                                     wire:model.lazy="comuna"/>
                        @error('comuna')
                        <div class="text-red-700">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="form-group">
                            <x-jet-label class="font-light text-sm text-gray-800"
                                         for="numero_hogar" value="{{ __('* Número domicilo') }}"/>
                            <x-jet-input id="numero_hogar"
                                         class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                         type="number" name="numero_hogar"
                                         :value="old('numero_hogar')" autofocus autocomplete="calle"
                                         wire:model.lazy="numero_hogar"/>
                            @error('numero_hogar')
                            <div class="text-red-700">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label class="font-light text-sm text-gray-800" for="celular"
                                         value="{{ __('* Telefono Celular') }}"/>
                            <x-jet-input id="celular"
                                         class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                         type="number" name="celular"
                                         :value="old('celular')" autofocus autocomplete="celular"
                                         wire:model.lazy="celular"/>
                            @error('celular')
                            <div class="text-red-700">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label class="font-light text-sm text-gray-800" for="pais"
                                         value="{{ __('* País') }}"/>
                            <x-jet-input id="pais"
                                         class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                         type="text" name="pais"
                                         :value="old('pais')" autofocus autocomplete="pais" wire:model.lazy="pais"/>
                            @error('pais')
                            <div class="text-red-700">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label class="font-light text-sm text-gray-800" for="region"
                                         value="{{ __('* Región') }}"/>
                            <x-jet-input id="region"
                                         class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                         type="text" name="region"
                                         :value="old('region')" autofocus autocomplete="region"
                                         wire:model.lazy="region"/>
                            @error('region')
                            <div class="text-red-700">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="flex justify-center">
                            <button wire:click="vistaPremios()" type="button"
                                    class="bg-gray-800 hover:bg-gray-700 font-semibold px-6 py-3 text-white rounded-md">
                                {{ __('Atras') }}
                            </button>
                        </div>

                        <div class="flex justify-center">
                            <button wire:click="vistaPago()" type="button"
                                    class="bg-green-500 hover:bg-green-400 font-semibold px-6 py-3 text-white rounded-md">
                                {{ __('Siguiente') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @elseif($vista_actual == "seleccionar_pago")
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 pb-2 rounded-md">

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-sans">
                            Detalles del pago
                        </p>
                    </div>

                    <div class="font-light text-xl mb-4">
                        Monto total a pagar ${{ number_format($donacion_total,0,',','.') }} CLP.
                        <hr class="mt-3 border border-gray-800 w-1/2">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-4">
                        <div>
                            <div class="font-light">
                                Debe hacer un depósito con el monto total de compra a la siguiente cuenta:
                            </div>

                            <div class="font-semibold mt-2">
                                Nombre: <span class="font-light">Expresarte</span>
                            </div>

                            <div class="font-semibold mt-2">
                                Número de cuenta:
                                <span class="font-light">5108 2218 72 9661298352</span>
                            </div>

                            <div class="font-semibold mt-2">
                                Tipo: <span class="font-light">Cuenta corriente</span>
                            </div>

                            <div class="font-semibold mt-2">
                                Banco: <span class="font-light">Banco de Chile</span>
                            </div>

                            <div class="font-semibold mt-2">
                                Correo: <span class="font-light">pagos@expresarte.cl</span>
                            </div>
                        </div>

                        <div>
                            <div class="font-light">
                                Luego de hacer el depósito correspondiente, debe enviar una foto con el comprobante de
                                pago
                                al correo pagos@expresarte.cl. En poco tiempo un administrador de Expresarte.cl te
                                contactará para coordinar el despacho.
                            </div>

                            <div class="mt-12 grid grid-cols-2 gap-4">
                                <div class="flex justify-center">
                                    <button wire:click="vistaDespacho()" type="button"
                                            class="bg-gray-800 hover:bg-gray-700 font-semibold px-6 py-3 text-white rounded-md">
                                        {{ __('Atras') }}
                                    </button>
                                </div>

                                <div class="flex justify-center">
                                    <button wire:click="comprarPremios()" type="button"
                                            class="bg-green-500 hover:bg-green-400 font-semibold px-6 py-3 text-white rounded-md">
                                        {{ __('Siguiente') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @endif
    </div>

</div>
