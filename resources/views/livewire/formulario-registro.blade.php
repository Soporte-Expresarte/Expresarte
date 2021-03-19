<div>
    <form method="POST" wire:submit.prevent="submit">
        @csrf

        <div class="text-center">
            <h1 class="font-semibold text-4xl text-grey-darkest my-8 w-full">
                Registrar nuevo Artista
            </h1>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-jet-label for="name" value="{{ __('* Nombre') }}"/>
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name" wire:model="name"/>
                @error('name') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-jet-label for="apellido" value="{{ __('* Apellido') }}"/>
                <x-jet-input id="apellido" class="block mt-1 w-full" type="text" name="apellido"
                             :value="old('apellido')" required autofocus wire:model="apellido"/>
                @error('apellido') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <x-jet-label for="apodo" value="{{ __('* Nombre de usuario') }}"/>
                <x-jet-input id="apodo" class="block mt-1 w-full" type="text" name="apodo" :value="old('apodo')"
                             required autofocus wire:model="apodo"/>
                @error('apodo') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-jet-label for="rut" value="{{ __('* Rut (12345678-9)') }}"/>
                <x-jet-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')"
                             wire:model="rut"/>
                <span id="rut_alert" class="text-red-700"></span>
                @error('rut') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-4">
            <x-jet-label for="email" value="{{ __('* Email') }}"/>
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         wire:model="email"/>
            @error('email') <span class="text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4" x-data="{ show: true }">
            <x-jet-label for="password" value="{{ __('* Contraseña') }}"/>
            <div class="relative mt-1">
                <input placeholder="" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-md w-full
                bg-white border placeholder-gray-600 shadow-sm
                focus:placeholder-gray-500
                focus:shadow-outline-blue
                focus:ring
                focus:border-blue-300
                focus:outline-none" id="password" type="password" name="password" required
                       autocomplete="password" wire:model="password">

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                         :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                         viewbox="0 0 576 512">
                        <path fill="currentColor"
                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                        </path>
                    </svg>

                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                         :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                         viewbox="0 0 640 512">
                        <path fill="currentColor"
                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                        </path>
                    </svg>
                </div>
            </div>
            @error('password') <span class="text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4" x-data="{ show: true }">
            <x-jet-label for="password_confirmation" value="{{ __('* Confirmar contraseña') }}"/>
            <div class="relative mt-1">
                <input placeholder="" :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-md w-full
                bg-white border placeholder-gray-600 shadow-sm
                focus:placeholder-gray-500
                focus:shadow-outline-blue
                focus:ring
                focus:border-blue-300
                focus:outline-none" id="password_confirmation" type="password" name="password_confirmation" required
                       autocomplete="password_confirmation" wire:model="password_confirmation">

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                         :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                         viewbox="0 0 576 512">
                        <path fill="currentColor"
                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                        </path>
                    </svg>

                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                         :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                         viewbox="0 0 640 512">
                        <path fill="currentColor"
                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                        </path>
                    </svg>
                </div>
            </div>
            @error('password_confirmation') <span class="text-red-700">{{ $message }}</span> @enderror
        </div>

        <div class="grid sm:grid-cols-2 grid-cols-1 gap-4 mt-4">
            <div>
                <x-jet-label for="fecha_nacimiento" value="{{ __('Fecha de nacimiento') }}"/>
                <x-jet-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento"
                             :value="old('fecha_nacimiento')" wire:model="fecha_nacimiento"/>
                @error('fecha_nacimiento') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-jet-label for="telefono" value="{{ __('Telefono móvil (9 dígitos)') }}"/>
                <x-jet-input id="telefono" class="block mt-1 w-full" type="tel" pattern="9[3-9][0-9]{7}" name="telefono"
                             :value="old('telefono')" wire:model="telefono"/>
                @error('telefono') <span class="text-red-700">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="h-4"></div>
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="mb-6 mt-10 flex justify-center">

                <x-jet-button class="ml-4 py-4">
                    {{ __('Registrar Artista') }}
                </x-jet-button>
            </div>
        @else
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Si ya tienes cuenta inicia sesión aquí') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        @endif

    </form>
</div>
