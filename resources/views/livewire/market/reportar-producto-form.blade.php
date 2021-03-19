<div class="bg-gray-100">
    <div class="sm:py-16 sm:px-6 px-2 py-8">
        <div class="max-w-lg mx-auto sm:px-6 px-4 pb-12 bg-white shadow-md rounded-lg">

            <div class="text-center">
                <h1 class="font-semibold text-4xl text-grey-darkest pt-12 w-full">
                    Reportar un Producto
                </h1>
            </div>

            <div class="mt-10">
                <x-jet-label for="razones" value="{{ __('* Motivo') }}"/>
                <select name="razones" id="razones"
                        class="block mt-1 w-full h-8 form-control rounded-md shadow-sm border"
                        :value="old('razon')" required wire:model="razon">
                    <option value="" selected>Seleccione una opción</option>
                    <option value="Nombre indebido">Nombre indebido</option>
                    <option value="Contenido indebido">Contenido fuerte</option>
                    <option value="Precio indebido">Precio no razonable</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('razon') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
            </div>

            <div
                class="mt-4">
                <label class="font-light text-sm text-gray-800" for="descripcion">{{ __('* Descripción') }}</label>
                <textarea name="descripcion" id="descripcion"
                          class="block mt-1 w-full p-2 border rounded-md shadow-sm focus:shadow-outline-blue focus:outline-none focus:ring focus:border-blue-300" rows="6"
                          wire:model="desc" :value="old('desc')"></textarea>
                @error('desc')
                <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mt-12 flex justify-center">
                <x-jet-button wire:click="reportar"
                              class="bg-gray-800 hover:bg-gray-700 font-semibold px-5 py-3 text-white rounded-md">
                    Reportar
                </x-jet-button>
            </div>

        </div>
    </div>
</div>
