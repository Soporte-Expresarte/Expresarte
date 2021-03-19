<div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Roboto@100;300;500" rel="stylesheet">

    <div class="bg-gray-100">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Crear un nuevo Proyecto
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
                    <label class="font-light text-sm text-gray-800" for="bajada">{{ __('* Sub-Título') }}</label>
                    <textarea name="sub_titulo" id="sub_titulo"
                              class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="4"
                              wire:model="sub_titulo" :value="old('sub_titulo')"></textarea>
                    @error('sub_titulo')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="form-group">
                        <label class="font-light text-sm text-gray-800"
                               for="duracion_dias">{{ __('* Duración días') }}</label>
                        <input type="number" name="duracion_dias" id="duracion_dias"
                               class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                               autocomplete="duracion_dias" wire:model="duracion_dias" :value="old('duracion_dias')">
                        @error('duracion_dias')
                        <div class="text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-light text-sm text-gray-800" for="meta">{{ __('* Meta') }}</label>
                        <input type="number" name="meta" id="meta"
                               class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                               autocomplete="meta" wire:model="meta" :value="old('meta')">
                        @error('meta')
                        <div class="text-red-600">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 form-group">
                    <label class="font-light text-sm text-gray-800"
                           for="url_video">{{ __('* URL de video en Youtube') }}</label>
                    <input type="text" name="url_video" id="url_video"
                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                           autocomplete="url_video" wire:model="url_video" :value="old('url_video')">
                    @error('url_video')
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
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="imagen_portada">{{ __('* Imagen de Portada') }}</label>

                    <input id="imagen_portada" class="block mt-1 w-full" type="file" name="imagen_portada"
                           required wire:model="imagen_portada" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @error('imagen_portada') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div
                    class="mt-6 form-group"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <label class="font-light text-sm text-gray-800"
                           for="imagenes[]">{{ __('* Imagenes adicionales') }}</label>

                    <input id="imagenes[]" class="block mt-1 w-full" type="file" name="imagenes[]"
                           required multiple wire:model="imagenes" accept=".png,.jpg,.jpeg"/>

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    @error('imagenes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-6">
                    <button wire:click="agregarPremio"
                            class="bg-blue-600 hover:bg-blue-500 transition duration-500 px-3 py-2 text-white rounded-md">
                        Agregar Premio
                    </button>
                    <div class="text-sm mt-2">
                        Puede agregar los premios que necesite. Los que deje con los campos llenos serán registrados.
                    </div>
                </div>
                @error('premios') <span
                    class="text-red-600"> @if(count($premios) == 0 ) {{ $message }} @endif </span> @enderror

                <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 mt-6">
                    @for($i=0; $i<count($premios) ; $i++)
                        <div
                            class="bg-orange-500 text-white rounded-xl p-2">
                            <div class="font-sans text-center">Premio {{$i+1}}</div>

                            <div class="pb-2">
                                <div class="mt-2 form-group">
                                    <label class="font-light text-sm text-white"
                                           for="nombre">{{ __('* Título') }}</label>
                                    <input type="text"
                                           class="block mt-1 w-full ring-4 text-gray-800 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                           wire:model="premios.{{$i}}.nombre">
                                    @error("premios.{$i}.nombre") <span
                                        class="text-red-700">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div
                                class="mt-4 font-light border-dashed border-2 px-2 py-1 rounded-xl border-gray-800">
                                <div
                                    class="form-group">
                                    <label class="font-light text-sm text-white"
                                           for="descripcion">{{ __('* Descripción') }}</label>
                                    <textarea
                                        class="block mt-1 w-full text-gray-800 ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                        rows="6"
                                        wire:model="premios.{{$i}}.descripcion"></textarea>
                                    @error("premios.{$i}.descripcion") <span
                                        class="text-red-700">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div
                                class="bg-red-600 p-2 rounded-xl mt-4">
                                <div class="form-group">
                                    <label class="font-light text-sm text-white"
                                           for="meta">{{ __('* Precio mínimo') }}</label>
                                    <input type="number"
                                           class="block mt-1 w-full ring-4 text-gray-800 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                           wire:model="premios.{{$i}}.precio_minimo">
                                    @error("premios.{$i}.precio_minimo") <span
                                        class="text-red-700">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <label class="font-light text-sm text-white"
                                           for="meta">{{ __('* Cantidad máxima') }}</label>
                                    <input type="number"
                                           class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border text-gray-800 rounded-md shadow-sm"
                                           wire:model="premios.{{$i}}.cantidad_maxima">
                                    @error("premios.{$i}.cantidad_maxima") <span
                                        class="text-red-700">{{ $message }}</span> @enderror
                                </div>

                                <div class="mt-4 block text-center">
                                    <button wire:click="eliminarPremio({{$i}})"
                                            class="bg-gray-800 hover:bg-gray-600 transition duration-500 px-3 py-2 text-white rounded-md">
                                        Eliminar
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endfor
                </div>

                <div class="mt-6 flex justify-center">
                    <button wire:click="submit"
                            class="bg-gray-800 hover:bg-gray-700 transition duration-500 font-semibold px-5 py-3 text-white rounded-md">
                        {{ __('Crear Proyecto') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
