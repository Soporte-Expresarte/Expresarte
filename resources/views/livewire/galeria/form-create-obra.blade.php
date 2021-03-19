<div class="bg-gray-100">
    <div class="sm:py-16 sm:px-6 px-2 py-8">
        <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

            <div class="text-center">
                <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                    Crear una nueva Obra
                </h1>
            </div>

            <div class="mt-10 form-group">
                <label class="font-light text-sm text-gray-800" for="titulo">{{ __('* Título') }}</label>
                <input type="text" name="titulo" id="titulo" placeholder="Ingrese su Título aquí!"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       autofocus
                       autocomplete="titulo" wire:model="titulo" :value="old('titulo')">
                @error('titulo')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800"
                       for="descripcion">{{ __('* Descripción') }}</label>
                <textarea name="descripcion" id="descripcion"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                          rows="10"
                          wire:model="descripcion" :value="old('descripcion')"
                          placeholder="Ingrese su Descripción aquí!"></textarea>
                @error('descripcion')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-6 form-group">
                <label class="font-light text-sm text-gray-800"
                       for="tipo">{{ __('* Tipos de obra ') }}</label>

                <select class="box-content border" name="tipo" id="tipo"
                        wire:model="tipo">
                    <option>ninguno</option>

                    @forelse (\App\Models\TipoObra::all() as $tipo)
                        <option value={{$tipo->id}}>{{$tipo->nombre}}</option>
                    @empty
                        <option>No hay Tipos recibidos</option>
                    @endforelse

                </select>
                @error('tipo') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800"
                       for="especificaciones">{{ __('* Especificaciones') }}</label>
                <textarea name="especificaciones" id="especificaciones"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                          rows="8"
                          wire:model="especificaciones" :value="old('especificaciones')"
                          placeholder="Ingrese sus Especificaciones aquí!"></textarea>
                @error('especificaciones')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800"
                       for="nuevas_imagenes">{{ __('* Subir Imagen (al menos una)') }}</label>
                <input id="nuevas_imagenes" class="block mt-1 w-full" type="file" name="nuevas_imagenes"
                       required multiple wire:model="nuevas_imagenes" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @error('nuevas_imagenes') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-12 flex justify-center">
                <button wire:click="store"
                        class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                    {{ __('Crear Obra') }}
                </button>
            </div>

        </div>
    </div>
</div>
