<div class="bg-white">
    @section('title')
        Despacho
    @endsection

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
    </x-slot>

    <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">

        @if ($informacion_activa == "formulario_despacho")
            <div class="sm:py-16 sm:px-6 px-2 py-8">
                <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                    <div class="text-center">
                        <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                            Datos para despacho de Productos
                        </h1>
                    </div>

                    <form method="POST" wire:submit.prevent="mostrarInstructivoPago">
                        @csrf
                        <div class="mt-10 grid grid-cols-2 gap-4">
                            <div>
                                <x-jet-label class="text-sm font-medium" for="nombre"
                                             value="{{ __('* Nombre del destinatario') }}"/>
                                <x-jet-input id="nombre" class="w-full mt-1" type="text" name="nombre"
                                             :value="old('nombre')" autofocus autocomplete="nombre"
                                             wire:model="nombre"/>
                                @error('nombre') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-jet-label class="text-sm font-medium" for="apellido"
                                             value="{{ __('* Apellido del destinatario') }}"/>
                                <x-jet-input id="apellido" class="w-full mt-1" type="text" name="apellido"
                                             :value="old('apellido')" autofocus autocomplete="apellido"
                                             wire:model="apellido"/>
                                @error('apellido') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <div class="mt-4">
                            <x-jet-label class="text-sm font-medium" for="calle" value="{{ __('* Calle') }}"/>
                            <x-jet-input id="calle" class="w-full mt-1" type="text" name="calle" :value="old('calle')"
                                         autofocus autocomplete="calle" wire:model="calle"/>
                            @error('calle') <span class="text-red-700">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4">
                            <x-jet-label class="text-sm font-medium" for="comuna" value="{{ __('* Comuna') }}"/>
                            <x-jet-input id="comuna" class="w-full mt-1" type="text" name="comuna"
                                         :value="old('comuna')" autofocus autocomplete="comuna" wire:model="comuna"/>
                            @error('comuna') <span class="text-red-700">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <x-jet-label class="text-sm font-medium" for="numero_hogar"
                                             value="{{ __('* Número domicilio') }}"/>
                                <x-jet-input id="numero_hogar" class="w-full mt-1" type="number" name="numero_hogar"
                                             :value="old('numero_hogar')" autofocus autocomplete="numero_hogar"
                                             wire:model="numero_hogar"/>
                                @error('numero_hogar') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-jet-label class="text-sm font-medium" for="celular"
                                             value="{{ __('* Telefono Celular')}}"/>
                                <x-jet-input id="celular" class="w-full mt-1" type="number" pattern="9[3-9][0-9]{7}"
                                             name="celular" :value="old('celular')" autofocus autocomplete="celular"
                                             wire:model="celular"/>
                                @error('celular') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>


                            <div>
                                <x-jet-label class="text-sm font-medium" for="pais" value="{{ __('* País') }}"/>
                                <x-jet-input id="pais" class="w-full mt-1" type="text" name="pais" :value="old('pais')"
                                             autofocus autocomplete="pais" wire:model="pais"/>
                                @error('pais') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <x-jet-label class="text-sm font-medium" for="region" value="{{ __('* Región') }}"/>
                                <x-jet-input id="region" class="w-full mt-1" type="text" name="region"
                                             :value="old('region')" autofocus autocomplete="region"
                                             wire:model="region"/>
                                @error('region') <span class="text-red-700">{{ $message }}</span> @enderror
                            </div>
                        </div>


                        <div class="mt-12 flex justify-center">
                            <button type="button" wire:click="mostrarInstructivoPago"
                                    class="bg-gray-800 hover:bg-gray-700 transition duration-500 font-semibold px-5 py-3 text-white rounded-md">
                                Proceder al pago
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        @elseif ($informacion_activa == "instructivo_pago")
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 pb-2 rounded-md">

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-sans">
                            Detalles del pago
                        </p>
                    </div>

                    <div class="font-light text-xl mb-4">
                        Monto total a pagar ${{ number_format($carrito->monto_total,0,',','.') }} CLP.
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
                                Luego de hacer el depósito correspondiente, debe enviar una foto con el
                                comprobante de
                                pago
                                al correo pagos@expresarte.cl. En poco tiempo un administrador de Expresarte.cl
                                te
                                contactará para coordinar el despacho.
                            </div>

                            <div class="mt-12 grid grid-cols-2 gap-4">
                                <div class="flex justify-center">
                                    <button wire:click="mostrarFormularioDespacho()" type="button"
                                            class="bg-gray-800 hover:bg-gray-700 font-semibold px-6 py-3 text-white rounded-md">
                                        {{ __('Atras') }}
                                    </button>
                                </div>

                                <div class="flex justify-center">
                                    <form method="POST" wire:submit.prevent='submit'>
                                        <button type="submit"
                                                class="bg-green-500 hover:bg-green-400 font-semibold px-6 py-3 text-white rounded-md">
                                            {{ __('Simular pago') }}
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
