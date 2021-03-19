<div class="bg-gray-100">
    <div class="sm:py-16 sm:px-6 px-2 py-8">
        <div class="max-w-xl mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

            <div class="text-center">
                <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                    Editar un Carrusel
                </h1>
            </div>

            <div class="mt-10 form-group">
                <label class="font-light text-sm text-gray-800" for="titulo">{{ __('Título') }}</label>
                <input type="text" name="titulo" id="titulo"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       autofocus
                       autocomplete="titulo" wire:model="titulo" :value="old('titulo')">
                @error('titulo')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="cuerpo">{{ __('Descripción') }}</label>
                <textarea name="descripcion" id="descripcion"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="16"
                          wire:model="descripcion" :value="old('descripcion')"></textarea>
                @error('descripcion')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="link">{{ __('Boton con Link') }}</label>
                <input type="text" name="link" id="link"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       autocomplete="link" wire:model="link" :value="old('link')">
                @error('link')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- imagenes subidas actualmente en el modelo -->
            <div class="mt-6 form-group">
                <label class="font-light text-sm text-gray-800" for="banner">{{ __('Imagen banner actual') }}</label>
                <img class="rounded-md" name="banner" id="banner" wire:model="banner"
                     src="{{ asset($this->banner) }}">
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800"
                       for="nuevo_banner">{{ __('Subir Imagen Banner') }}</label>

                <input id="nuevo_banner" class="block mt-1 w-full" type="file" name="nuevo_banner"
                       required wire:model="nuevo_banner" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                @error('banner') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-12 flex justify-center">
                <button wire:click="update({{ $car_id }})"
                        class="bg-green-500 hover:bg-green-400 font-semibold px-5 py-3 text-white rounded-md">
                    {{ __('Actualizar') }}
                </button>

                <div class="px-4"></div>
                <button
                    class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                    <a href="{{route('admin-carrusel')}}">{{ __('Cancelar') }}</a>
                </button>
            </div>


        </div>
    </div>
</div>
