<div>
    <div class="bg-gray-100 mt-4 rounded-lg">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Editar Perfil de Artista
                    </h1>
                </div>

                <div
                    class="mt-10 form-group">
                    <label class="font-light text-sm text-gray-800" for="cita">{{ __('* Cita') }}</label>
                    <textarea name="cita" id="cita"
                              class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="4"
                              wire:model="cita" :value="old('cita')"></textarea>
                    @error('cita')
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

                <div class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800" for="facebook">{{ __('Facebook') }}</label>
                    <input type="text" name="facebook" id="facebook"
                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                           wire:model="facebook" :value="old('facebook')">
                    @error('facebook')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800" for="twitter">{{ __('Twitter') }}</label>
                    <input type="text" name="twitter" id="twitter"
                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                           wire:model="twitter" :value="old('twitter')">
                    @error('twitter')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800" for="instagram">{{ __('Instagram') }}</label>
                    <input type="text" name="instagram" id="instagram"
                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                           wire:model="instagram" :value="old('instagram')">
                    @error('instagram')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="mt-6 form-group">
                    <label class="font-light text-sm text-gray-800"
                           for="foto_portada">{{ __('Foto Principal Actual') }}</label>
                    <img class="rounded-md" src="{{asset($fotoArtistaActual)}}">
                </div>

                <div class="mt-6 form-group">
                    <label class="font-light text-sm text-gray-800"
                           for="foto_evento">{{ __('Imagen Banner Actual') }}</label>
                    <img class="rounded-md" src="{{asset($fotoPortadaActual)}}">
                </div>

                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="fotoArtista">{{ __('* Subir Imagen Principal') }}</label>
                    <input id="fotoArtista" class="block mt-1 w-full" type="file" name="fotoArtista"
                           required wire:model="fotoArtista" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                    @error('fotoArtista') <span
                        class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="fotoPortada">{{ __('* Subir Imagen Baner') }}</label>
                    <input id="fotoPortada" class="block mt-1 w-full" type="file" name="fotoPortada"
                           required wire:model="fotoPortada" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                    @error('fotoPortada') <span
                        class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-12 flex justify-center">
                    <button wire:click="accion"
                            class="bg-green-500 hover:bg-green-400 transition duration-500 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Actualizar') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
