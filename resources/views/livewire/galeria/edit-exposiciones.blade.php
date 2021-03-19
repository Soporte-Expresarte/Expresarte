<div>
    <div class="bg-gray-100">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Editar una Exposición
                    </h1>
                </div>

                <div class="mt-10 form-group">
                    <label class="font-light text-sm text-gray-800" for="titulo">{{ __('* Título') }}</label>
                    <input type="text" name="titulo" id="titulo"
                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                           autofocus
                           autocomplete="titulo" wire:model="titulo" :value="old('titulo')">
                    @error('titulo')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div
                    class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800" for="sub_titulo">{{ __('* Sub-Título') }}</label>
                    <textarea name="sub_titulo" id="sub_titulo"
                              class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="4"
                              wire:model="sub_titulo" :value="old('sub_titulo')"></textarea>
                    @error('sub_titulo')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div
                    class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800" for="cuerpo">{{ __('* Descripción') }}</label>
                    <textarea name="descripcion" id="descripcion"
                              class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="16"
                              wire:model="descripcion" :value="old('descripcion')"></textarea>
                    @error('descripcion')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>


                <!-- eleccion de obras para la exposicion -->
                <div
                    class="mt-6 form-group">
                    <label class="font-light text-sm text-gray-800"
                           for="current_obra">{{ __('Elegir Obras (Mínimo 4)') }}</label>

                    <select class="box-content border max-w-full h-6" name="current_obra" id="current_obra"
                            wire:model="current_obra">
                        <option value="" wire:value="">ninguno</option>

                        @forelse($obras_aprobadas as $obra_aprob)
                            <option value="{{ $obra_aprob->id }}">{{ $obra_aprob->titulo }}</option>
                        @empty
                            <option>No hay Obras registradas o aprobadas</option>
                        @endforelse

                    </select>

                    @error('current_obra')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-2">
                    <button wire:click="addObra"
                            class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white rounded-md">Agregar Obra
                    </button>
                </div>


                <!-- cuadro con todas las obras agregadas recientemente -->
                <div class="mt-4 form-group">
                    <div
                        class="p-3 appearance-none text-grey-dark border rounded-md w-full shadow-sm">
                        <input type="hidden" id="obra_box_box" name="obra_box_box" wire:model="obra_box_box">

                        @error('currents_obras')
                        <div class="text-red-600">{{ $message }}</div> @enderror

                        <div class="grid grid-cols-2 gap-2">
                            @forelse($this->currents_obras as $obra_in)
                                <div class="relative">
                                    <img class="h-48 m-auto object-cover w-max-content rounded-md"
                                         src="{{ isset(\App\Models\Obra::find($obra_in)->imagenes->last()->ruta)? asset(\App\Models\Obra::find($obra_in)->imagenes->last()->ruta): asset('images/imagen-default.jpg') }}">

                                    <button wire:click="removeObra({{ $obra_in }})"
                                            class="select-none appearance-none border-none ring-offset-0 absolute top-2 right-2">
                                    <span
                                        class="font-extralight rounded-full bg-gray-800 text-white px-2 text-sm">x</span>
                                    </button>
                                </div>
                            @empty
                                <div class="flex justify-center text-center">No hay Obras agregadas</div>
                            @endforelse
                        </div>

                    </div>
                </div>


                <div class="mt-12 flex justify-center">
                    <button wire:click="update({{ $prop_id }})"
                            class="bg-green-500 hover:bg-green-400 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Actualizar') }}
                    </button>

                    <div class="px-4"></div>
                    <button wire:click="cancel"
                            class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Cancelar') }}
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
