<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href={{ route("root") }}>
                <img src="{{asset('images/logoConSombra.png')}}" style="width: 600px; height: 100px;"/>
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('* Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required autofocus/>
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
                           autocomplete="current-password">

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
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="grid grid-rows-2 mr-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('¿No tienes cuenta?') }}
                    </a>

                <!--
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 mt-1"
                           href="{{ route('password.request') }}">
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                    -->
                </div>

                <x-jet-button class="ml-4 uppercase">
                    {{ __('Ingresar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>