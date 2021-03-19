<div>
    <nav x-data="{ open: false}" class="{{$background}} py-2">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                    <!-- Mobile menu button-->
                    <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-expanded="false">
                        <span class="sr-only">Abrir men&uacute; principal</span>

                        <!-- Icon when menu is closed. -->
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg :class="{'hidden': open, 'block': ! open }" class="h-6 w-6"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>

                        <!-- Icon when menu is open. -->
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg :class="{'block': open, 'hidden': ! open }" class="h-6 w-6"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <!-- Logo -->
                    <!-- TODO: Cambiar logo -->
                    <!-- Clases solo funcionan en tailwind2.0?-->
                    <div
                        class="flex flex-row">
                        <a href="{{ url('/') }}">
                            <img class="hidden sm:block w-auto object-scale-down pr-4"
                                 src="{{asset('images/logoConSombra.png')}}">
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px md:flex  ">
                        <div class="flex space-x-4">

                            <x-utilidades.nav-link href="{{ route('index-galeria') }}"
                                                   :active="request()->routeIs('index-galeria')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Inicio') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-artistas') }}"
                                                   :active="request()->routeIs('index-artistas')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Artistas') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-exposiciones') }}"
                                                   :active="request()->routeIs('index-exposiciones')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Obras') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-expo') }}"
                                                   :active="request()->routeIs('index-expo')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Exposiciones') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-noticias') }}"
                                                   :active="request()->routeIs('index-noticias')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Noticias') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-eventos') }}"
                                                   :active="request()->routeIs('index-eventos')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Eventos') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-market') }}"
                                                   :active="request()->routeIs('index-market')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Market') }}
                            </x-utilidades.nav-link>

                            <x-utilidades.nav-link href="{{ route('index-crowdfunding') }}"
                                                   :active="request()->routeIs('index-crowdfunding')"
                                                   class="{{$colorNavLinks}}">
                                {{ __('Crowdfunding') }}
                            </x-utilidades.nav-link>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <div class="top-0 right-0 px-6">
                    @if(Auth::user())
                        <!-- Settings Dropdown -->
                            <div class="md:flex md:items-center sm:ml-8 ml-15" >
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <button
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                     src="{{ Auth::user()->profile_photo_url }}"
                                                     alt="{{ Auth::user()->name }}"/>
                                            </button>
                                        @else
                                            <button
                                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                <div>{{ Auth::user()->name }}</div>

                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </button>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Gestión de cuenta -->
                                        <div class="block px-4 py-2 text-xs text-gray-500">{{ __('Gestión') }}</div>

                                        <x-jet-dropdown-link
                                            href="{{ route('vista-perfil') }}">{{ __('Perfil') }}</x-jet-dropdown-link>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-jet-dropdown-link
                                                href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</x-jet-dropdown-link>
                                        @endif

                                        @if (Auth::user()->current_team_id == 1)
                                            <x-jet-dropdown-link href="{{ route('crear_artista') }}">
                                                {{ __('Crear Artista') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-carrusel') }}">
                                                {{ __('Admin Carruseles') }}
                                            </x-jet-dropdown-link>

                                            <!-- Funcionalidades relacionadas al Galería -->
                                            <div class="block px-4 py-2 text-xs text-gray-500">{{ __('Galería') }}</div>

                                            <x-jet-dropdown-link href="{{ route('create-expo') }}">
                                                {{ __('Crear Exposición') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-expo') }}">
                                                {{ __('Admin Exposiciones') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('create-noticia') }}">
                                                {{ __('Crear Noticias') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-noticias') }}">
                                                {{ __('Administrar Noticias') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('crear-evento') }}">
                                                {{ __('Crear Evento') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-eventos') }}">
                                                {{ __('Administrar Eventos') }}
                                            </x-jet-dropdown-link>

                                            <!-- Funcionalidades relacionadas al Market -->
                                            <div class="block px-4 py-2 text-xs text-gray-500">{{ __('Market') }}</div>

                                            <x-jet-dropdown-link href="{{ route('create-promocion') }}">
                                                {{ __('Crear Promoción') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-promocion') }}">
                                                {{ __('Admin Promociones') }}
                                            </x-jet-dropdown-link>

                                        @endif

                                        @if (Auth::user()->current_team_id == 2)

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Funcionalidades relacionadas al Galería -->
                                            <div class="block px-4 py-2 text-xs text-gray-500">{{ __('Galería') }}</div>

                                            <x-jet-dropdown-link href="{{ route('create-obra') }}">
                                                {{ __('Crear Obra') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('admin-obras') }}">
                                                {{ __('Administrar Obras') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('crear-evento') }}">
                                                {{ __('Crear Evento') }}
                                            </x-jet-dropdown-link>

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Funcionalidades relacionadas al Market -->
                                            <div class="block px-4 py-2 text-xs text-gray-500">{{ __('Market') }}</div>

                                            <x-jet-dropdown-link href="{{ route('crear-producto') }}">
                                                {{ __('Crear Producto') }}
                                            </x-jet-dropdown-link>

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Funcionalidades relacionadas al Market -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-500">{{ __('Crowdfunding') }}</div>

                                            <x-jet-dropdown-link href="{{ route('crear-proyecto') }}">
                                                {{ __('Crear Proyecto') }}
                                            </x-jet-dropdown-link>
                                        @endif

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Team Management -->
                                        <!-- Solo el Administrador podría tener acceso a esta parte. -->
                                    {{-- @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-jet-dropdown-link>
                                    @endif --}}

                                    <!-- Authentication -->
                                        <form class="mt-2" method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                 onclick="event.preventDefault();this.closest('form').submit();">
                                                {{ __('Cerrar sesión') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @elseif(Route::has('login'))
                            <div class="md:flex md:items-center ml-15 sm:ml-8">
                                <a href="{{ route('login') }}" class="sm:flex text-sm text-white underline">Ingresar</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="lg:ml-5 text-sm text-white underline">Registro</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, toggle classes based on menu state. -->
        <div :class="{'block': open, 'hidden': ! open }" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">

                <x-utilidades.nav-link href="{{ route('index-galeria') }}" :active="request()->routeIs('index-galeria')"
                                       class="{{$colorNavLinks}}">
                    {{ __('Inicio') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-artistas') }}"
                                       :active="request()->routeIs('index-artistas')" class="{{$colorNavLinks}}">
                    {{ __('Artistas') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-exposiciones') }}"
                                       :active="request()->routeIs('index-exposiciones')" class="{{$colorNavLinks}}">
                    {{ __('Obras') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-expo') }}"
                                       :active="request()->routeIs('index-expo')" class="{{$colorNavLinks}}">
                    {{ __('Exposiciones') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-noticias') }}"
                                       :active="request()->routeIs('index-noticias')" class="{{$colorNavLinks}}">
                    {{ __('Noticias') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-eventos') }}" :active="request()->routeIs('index-eventos')"
                                       class="{{$colorNavLinks}}">
                    {{ __('Eventos') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-market') }}" :active="request()->routeIs('index-market')"
                                       class="{{$colorNavLinks}}">
                    {{ __('Market') }}
                </x-utilidades.nav-link>

                <x-utilidades.nav-link href="{{ route('index-crowdfunding') }}"
                                       :active="request()->routeIs('index-crowdfunding')" class="{{$colorNavLinks}}">
                    {{ __('Crowdfunding') }}
                </x-utilidades.nav-link>
            </div>
        </div>
    </nav>
</div>
