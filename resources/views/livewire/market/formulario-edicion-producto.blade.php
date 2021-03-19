<div>
    <div class="bg-gray-100">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Editar un Producto
                    </h1>
                </div>

                <div class="mt-10">
                    <div>
                        <x-jet-label for="nombre" value="{{ __('* Nombre') }}"/>
                        <x-jet-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                     :value="old('nombre')"
                                     required
                                     autofocus autocomplete="nombre" wire:model="nombre"/>
                        @error('nombre') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div
                    class="mt-4">
                    <label class="font-light text-sm text-gray-800" for="descripcion">{{ __('* Descripción') }}</label>
                    <textarea name="descripcion" id="descripcion"
                              class="block mt-1 w-full p-2 border rounded-md shadow-sm focus:shadow-outline-blue focus:outline-none focus:ring focus:border-blue-300"
                              rows="8"
                              wire:model="descripcion" :value="old('descripcion')"></textarea>
                    @error('descripcion')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="categoria_id" value="{{ __('* Categoría') }}"/>
                    <select name="categoria_id" id="categoria_id"
                            class="block mt-1 w-full h-8 form-control rounded-md shadow-sm border"
                            :value="old('categoria_id')" required wire:model="categoria_id">
                        <option value="" selected>Seleccione una categoría</option>
                        @foreach ($categorias as $c)
                            <option value="{{$c->id}}"> {{$c->nombre}}</option>
                        @endforeach
                    </select>
                    @error('categoria_id') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <x-jet-label for="tema_id" value="{{ __('* Tema') }}"/>
                    <select name="tema_id" id="tema_id"
                            class="block mt-1 w-full h-8 form-control rounded-md shadow-sm border"
                            :value="old('tema_id')" required wire:model="tema_id">
                        <option value="" selected>Seleccione un tema</option>
                        @foreach ($temas as $t)
                            <option value="{{$t->id}}"> {{$t->nombre}}</option>
                        @endforeach
                    </select>
                    @error('tema_id') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-3">
                    <div>
                        <x-jet-label for="largo" value="{{ __('* Largo (cm)') }}"/>
                        <x-jet-input id="largo" class="block mt-1 w-full" type="text" name="largo" :value="old('largo')"
                                     required
                                     wire:model="largo"/>
                        @error('largo') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-jet-label for="ancho" value="{{ __('* Ancho (cm)') }}"/>
                        <x-jet-input id="ancho" class="block mt-1 w-full" type="number" name="ancho"
                                     :value="old('ancho')"
                                     required
                                     wire:model="ancho"/>
                        @error('ancho') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-jet-label for="alto" value="{{ __('Alto (cm)') }}"/>
                        <x-jet-input id="alto" class="block mt-1 w-full" type="number" name="alto" :value="old('alto')"
                                     wire:model="alto"/>
                        @error('alto') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                    <div>
                        <x-jet-label for="precio" value="{{ __('* Precio') }}"/>
                        <x-jet-input id="precio" class="block mt-1 w-full" type="number" min="1" max="2147483647"
                                     name="precio"
                                     required wire:model="precio"/>
                        @error('precio') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-jet-label for="stock" value="{{ __('* Stock') }}"/>
                        <x-jet-input id="stock" class="block mt-1 w-full" type="number" min="1" max="2147483647"
                                     name="stock"
                                     required wire:model="stock"/>
                        @error('stock') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group mt-6 mb-2">
                    <label class="font-light text-sm text-gray-800"
                           for="portada">{{ __('Imagen banner actual') }}</label>
                    @foreach ($imagenesAntiguas as $imagen)

                        <img class="rounded-md mb-4" id="{{$imagen->id}}"
                             src="{{ asset($imagen->ruta) }}">
                    @endforeach
                </div>

                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="imagenes">{{ __('Subir Imagenes') }}</label>

                    <input id="imagenes" class="block mt-1 w-full" type="file" name="imagenes"
                           required multiple wire:model="imagenes" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @error('imagenes.*') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-12 flex justify-center">
                    <button wire:click="submit"
                            class="bg-green-500 hover:bg-green-400 transition duration-500 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Actualizar') }}
                    </button>

                    <div class="px-4"></div>
                    <button wire:click="cancel"
                            class="bg-gray-800 hover:bg-gray-700 transition duration-500 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Cancelar') }}
                    </button>
                </div>

            </div>
        </div>
    </div>


</div>
