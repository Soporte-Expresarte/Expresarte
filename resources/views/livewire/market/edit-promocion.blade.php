<div>
    <div class="bg-gray-100">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Editar una Promoción
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
                    <label class="font-light text-sm text-gray-800" for="cuerpo">{{ __('* Descripción') }}</label>
                    <textarea name="descripcion" id="descripcion"
                              class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="16"
                              wire:model="descripcion" :value="old('descripcion')"></textarea>
                    @error('descripcion')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div
                    class="mt-6 form-group">
                    <label class="font-light text-sm text-gray-800"
                           for="seccion_index">{{ __('* Elegir ubicación en el sitio principal de Market') }}</label>

                    <select class="box-content border max-w-full h-6" name="seccion_index" id="seccion_index"
                            wire:model="seccion_index">
                        <option @if($seccion_index == 'SUPERIOR') selected @endif value="SUPERIOR" wire:value="SUPERIOR">Superior</option>
                        <option @if($seccion_index == 'INFERIOR') selected @endif value="INFERIOR" wire:value="INFERIOR">Inferior</option>
                    </select>
                </div>

                <div class="mt-6 form-group">
                    <label for="banner">{{ __('Imagen banner actual') }}</label>
                    <img class="rounded-md mt-2" name="banner" id="banner" wire:model="banner"
                         src="{{ asset($this->banner) }}">
                </div>

                <div class="mt-6 form-group">
                    <label for="portada">{{ __('Imagen principal actual') }}</label>
                    <img class="rounded-md mt-2" name="portada" id="portada" wire:model="portada"
                         src="{{ asset($this->portada) }}">
                </div>


                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="banner">{{ __('Nueva Imagen Banner') }}</label>

                    <input id="banner" class="block mt-1 w-full" type="file" name="banner"
                           required wire:model="nuevo_banner" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @error('banner') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="portada">{{ __('Nueva Imagen Principal') }}</label>

                    <input id="portada" class="block mt-1 w-full" type="file" name="portada"
                           required wire:model="nueva_portada" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @error('portada') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
