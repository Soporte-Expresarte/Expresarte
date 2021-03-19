<div>
    <div class="bg-gray-100">
        <div class="sm:py-16 sm:px-6 px-2 py-8">
            <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

                <div class="text-center">
                    <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                        Editar un Proyecto
                    </h1>
                </div>

                <div class="mt-10">
                    <div>
                        <x-jet-label for="titulo" value="{{ __('* Título') }}"/>
                        <x-jet-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"
                                     :value="old('titulo')"
                                     autofocus autocomplete="titulo" wire:model="titulo"/>
                        @error('titulo') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div
                    class="mt-4">
                    <label class="font-light text-sm text-gray-800" for="sub_titulo">{{ __('* Sub-título') }}</label>
                    <textarea name="sub_titulo" id="sub_titulo"
                              class="block mt-1 w-full p-2 border rounded-md shadow-sm focus:shadow-outline-blue focus:outline-none focus:ring focus:border-blue-300"
                              rows="6"
                              wire:model="sub_titulo" :value="old('sub_titulo')"></textarea>
                    @error('sub_titulo')
                    <div class="text-red-600">{{ $message }}</div> @enderror
                </div>

                <div
                    class="mt-4">
                    <label class="font-light text-sm text-gray-800" for="descripcion">{{ __('* Descripción') }}</label>
                    <textarea name="descripcion" id="descripcion"
                              class="block mt-1 w-full p-2 border rounded-md shadow-sm focus:shadow-outline-blue focus:outline-none focus:ring focus:border-blue-300"
                              rows="12"
                              wire:model="descripcion" :value="old('descripcion')"></textarea>
                    @error('descripcion')
                    <div class="text-red-600">{{ $message }}</div> @enderror
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

                <div class="mt-6 form-group">
                    <label for="imagen_portada_actual">{{ __('Imagen principal actual') }}</label>
                    <img class="rounded-md mt-2" name="imagen_portada_actual" id="imagen_portada_actual"
                         wire:model="imagen_portada_actual"
                         src="{{ asset($this->imagen_portada_actual) }}">
                </div>

                <div class="mt-6 form-group">
                    <label for="demas_imagenes_actuales">{{ __('Imagenes adicionales nuevas') }}</label>

                    @forelse($demas_imagenes_actuales as $img)
                        <img class="rounded-md mb-4 @if($loop->index==0) mt-2 @endif" name="demas_imagenes_actuales"
                             id="demas_imagenes_actuales"
                             wire:model="demas_imagenes_actuales"
                             src="{{ asset($img->ruta) }}">
                    @empty
                        <div class="text-center">No hay imagenes adicionales.</div>
                    @endforelse
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
                    <label class="font-light text-sm  text-gray-800"
                           for="premios">{{ __('* Premios Actuales') }}</label>

                    <div class="text-white grid md:grid-cols-2 grid-cols-1 gap-2">
                        @forelse($premios as $premio)
                            <div
                                class="bg-orange-500 rounded-xl hover:bg-orange-400 transition duration-500 p-2">
                                <div class="text-center limitlines2">
                                    {{ $premio->nombre }}
                                </div>

                                <div
                                    class="mt-2 font-light border-dashed border-2 px-2 py-1  rounded-xl border-gray-800 limitlines8">
                                    {{$premio->descripcion}}
                                </div>

                                <div
                                    class="bg-red-600 hover:bg-red-500 transition duration-500 p-2 rounded-xl mt-2">
                                    <div>
                                        Mínimo de ${{number_format($premio->precio_minimo ,0,',','.')}} CLP
                                    </div>

                                    <div class="mt-2">
                                        {{ $premio->cantidad_actual }} disponibles
                                        de {{ $premio->cantidad_maxima }}
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

                <hr class="my-4">

                <div class="mt-2">
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

                <div class="mt-6">
                    <label class="font-light text-sm  text-gray-800"
                           for="premios">{{ __('Premios Nuevos') }}</label>

                    @if(count($nuevos_premios) == 0)
                        <div class="text-center py-2">No hay Premios nuevos agregados</div>
                    @else
                        <div class="grid sm:grid-cols-2 grid-cols-1 mt-1 gap-4">
                            @for($i=0; $i<count($nuevos_premios) ; $i++)
                                <div
                                    class="bg-orange-500 text-white rounded-xl p-2">
                                    <div class="font-sans text-center">Premio {{$i+ count($premios)}}</div>

                                    <div class="pb-2">
                                        <div class="mt-2 form-group">
                                            <label class="font-light text-sm text-white"
                                                   for="nombre">{{ __('* Título') }}</label>
                                            <input type="text"
                                                   class="block mt-1 w-full ring-4 text-gray-800 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                                   wire:model="nuevos_premios.{{$i}}.nombre">
                                            @error("nuevos_premios.{$i}.nombre") <span
                                                class="text-gray-200">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div
                                        class="mt-2 font-light border-dashed border-2 px-2 py-1 rounded-xl border-gray-800">
                                        <div
                                            class="form-group">
                                            <label class="font-light text-sm text-white"
                                                   for="descripcion">{{ __('* Descripción') }}</label>
                                            <textarea
                                                class="block mt-1 w-full text-gray-800 ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                                rows="6"
                                                wire:model="nuevos_premios.{{$i}}.descripcion"></textarea>
                                            @error("nuevos_premios.{$i}.descripcion") <span
                                                class="text-gray-200">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div
                                        class="bg-red-600 p-2 rounded-xl mt-4">
                                        <div class="form-group">
                                            <label class="font-light text-sm text-white"
                                                   for="meta">{{ __('* Precio mínimo') }}</label>
                                            <input type="number"
                                                   class="block mt-1 w-full ring-4 text-gray-800 ring-indigo-300 p-2 border rounded-md shadow-sm"
                                                   wire:model="nuevos_premios.{{$i}}.precio_minimo">
                                            @error("nuevos_premios.{$i}.precio_minimo") <span
                                                class="text-gray-200">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group mt-4">
                                            <label class="font-light text-sm text-white"
                                                   for="meta">{{ __('* Cantidad máxima') }}</label>
                                            <input type="number"
                                                   class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border text-gray-800 rounded-md shadow-sm"
                                                   wire:model="nuevos_premios.{{$i}}.cantidad_maxima">
                                            @error("nuevos_premios.{$i}.cantidad_maxima") <span
                                                class="text-gray-200">{{ $message }}</span> @enderror
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

                    @endif

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
