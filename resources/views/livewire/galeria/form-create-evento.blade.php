<div class="bg-gray-100">
    <div class="sm:py-16 sm:px-6 px-2 py-8">
        <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

            <div class="text-center">
                <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                    Crear una nuevo Evento
                </h1>
            </div>

            <div class="mt-10 form-group">
                <label class="font-light text-sm text-gray-800" for="titulo">{{ __('* Título') }}</label>
                <input type="text" name="titulo" id="titulo" placeholder="Ingrese su Titulo aquí!"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       autofocus
                       autocomplete="titulo" wire:model="titulo" :value="old('titulo')">
                @error('titulo')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="descripcion">{{ __('* Descripción') }}</label>
                <textarea name="descripcion" id="descripcion"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="4"
                          wire:model="descripcion" :value="old('descripcion')"
                          placeholder="Ingrese su Descripción aquí!"></textarea>
                @error('descripcion')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mt-4">
                <label class="font-light text-sm text-gray-800"
                       for="fecha_inicio">{{ __('* Fecha de Inicio del Evento') }}</label>
                <x-jet-input id="fecha_inicio" class="block mt-1 w-full" type="datetime-local" name="fecha_inicio"
                             :value="old('fecha_inicio')" wire:model="fecha_inicio"/>
                @error('fecha_inicio') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="font-light text-sm text-gray-800"
                       for="fecha_termino">{{ __('* Fecha de Termino del Evento') }}</label>
                <x-jet-input id="fecha_termino" class="block mt-1 w-full" type="datetime-local" name="fecha_termino"
                             :value="old('fecha_termino')" wire:model="fecha_termino"/>
                @error('fecha_termino') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="lugar">{{ __('* Lugar') }}</label>
                <input type="text" name="lugar" id="lugar" placeholder="Ingrese su Lugar aquí!"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       autocomplete="lugar" wire:model="lugar" :value="old('lugar')">
                @error('lugar')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800" for="foto_portada">{{ __('* Subir Imagen Banner') }}</label>
                <input id="foto_portada" class="block mt-1 w-full" type="file" name="foto_portada"
                       required wire:model="foto_portada" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @error('foto_portada') <span
                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800" for="foto_evento">{{ __('* Subir Imagen Principal') }}</label>
                <input id="foto_evento" class="block mt-1 w-full" type="file" name="foto_evento"
                       required wire:model="foto_evento" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @error('foto_evento') <span
                    class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-12 flex justify-center">
                <button wire:click="guardar"
                        class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                    {{ __('Crear Evento') }}
                </button>
            </div>

        </div>
    </div>
</div>
