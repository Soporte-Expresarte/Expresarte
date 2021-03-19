<div class="bg-gray-100">
    <div class="sm:py-16 sm:px-6 px-2 py-8">
        <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

            <div class="text-center">
                <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                    Crear una nueva Noticia
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
                <label class="font-light text-sm text-gray-800" for="sub_titulo">{{ __('* Sub-Título') }}</label>
                <textarea name="sub_titulo" id="sub_titulo"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="4"
                          wire:model="sub_titulo" :value="old('sub_titulo')"
                          placeholder="Ingrese su Sub-Título aquí!"></textarea>
                @error('sub_titulo')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="bajada">{{ __('* Bajada') }}</label>
                <textarea name="bajada" id="bajada"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="8"
                          wire:model="bajada" :value="old('bajada')"
                          placeholder="Ingrese su Bajada aquí!"></textarea>
                @error('bajada')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div
                class="mt-4 form-group">
                <label class="font-light text-sm text-gray-800" for="cuerpo">{{ __('* Cuerpo') }}</label>
                <textarea name="cuerpo" id="cuerpo"
                          class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm" rows="16"
                          wire:model="cuerpo" :value="old('cuerpo')"
                          placeholder="Ingrese su Cuerpo aquí!"></textarea>
                @error('cuerpo')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- CREACION DE NUEVOS TAGS PARA CUALqUIER NOTICIA -->
            <div
                class="mt-6 form-group">
                <label class="font-light text-sm text-gray-800" for="for_new_tag">{{ __('Crear Nuevo Tag') }}</label>
                <input type="text" name="for_new_tag" id="for_new_tag"
                       placeholder="Ingrese su nuevo Tag aquí!"
                       class="block mt-1 w-full ring-4 ring-indigo-300 p-2 border rounded-md shadow-sm"
                       wire:model="for_new_tag" value="{{ $for_new_tag }}">
                @error('for_new_tag')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mt-4">
                <button wire:click="createTag"
                        class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white rounded-md">Crear Tag
                </button>
            </div>

            <!-- SELECCION DE TAGS PARA AGREGAR A LA NOTICIA ACTUAL -->
            <div
                class="mt-6 form-group">
                <label class="font-light text-sm text-gray-800"
                       for="current_tag">{{ __('* Elija algunos Tag (Máximo 4)') }}</label>

                <select class="box-content border" name="current_tag" id="current_tag"
                        wire:model="current_tag">
                    <option>ninguno</option>

                    @forelse($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->nombre }}</option>
                    @empty
                        <option>No hay Tags</option>
                    @endforelse

                </select>
            </div>

            <div class="mt-2">
                <button wire:click="addOldTagToNoticia"
                        class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white rounded-md">Agregar Tag
                </button>
            </div>

            <!-- BOX CON TODOS LOS TAGS ACTUALES PARA ESTA NOTICIA -->
            <div class="mt-4 form-group">
                <div
                    class="p-3 appearance-none text-grey-dark border rounded-md w-full shadow-sm">
                    <input type="hidden" id="tag_box_box" name="tag_box_box" wire:model="current_tags">

                    @error('current_tags')
                    <div class="text-red-600">{{ $message }}</div> @enderror

                    @forelse($current_tags as $curr_tag)
                        <span
                            class="text-md select-none font-light mx-1 px-3 bg-black text-white rounded-full">{{ \App\Models\Tag::find($curr_tag)->nombre }}
                        <button wire:click="removeOldTagToNoticia({{ $curr_tag }})"
                                class="select-none appearance-none border-none ring-offset-0">
                            <span class="font-extralight text-sm">x</span>
                        </button>
                    </span>
                    @empty
                        <div class="text-center mx-auto">No hay tags agregados</div>
                    @endforelse
                </div>
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800"
                       for="portada">{{ __('* Subir Imagen Banner') }}</label>

                <input id="portada" class="block mt-1 w-full" type="file" name="portada"
                       required wire:model="portada" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                @error('portada') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div
                class="mt-6 form-group"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="font-light text-sm text-gray-800"
                       for="imagen">{{ __('* Subir Imagen Principal') }}</label>

                <input id="imagen" class="block mt-1 w-full" type="file" name="imagen"
                       required wire:model="imagen" accept=".png,.jpg,.jpeg"/>

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-12 flex justify-center">
                <button wire:click="store"
                        class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                    {{ __('Crear Noticia') }}
                </button>
            </div>

        </div>
    </div>
</div>
