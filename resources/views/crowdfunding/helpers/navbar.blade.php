    <!-- Navbar -->
    <style>
        .dropdown:hover .dropdown-menu {
        display: block;
        }
    </style>

	<div class="fixed z-50 w-full flex justify-between items-center py-6 bg-gray-900">
		<div class="flex-shrink-0 ml-10 cursor-pointer shadow-sm">
			<i class="fas fa-drafting-compass fa-2x text-orange-500"></i>
			<img src="{{asset('images/logoConSombra.png')}}" alt="Expresarte Logo" style="height: 80px;">
		</div>
		<i class="fas fa-bars fa-2x visible md:invisible mr-10 md:mr-0 text-blue-200 cursor-pointer"></i>
		<ul class="hidden md:flex overflow-x-hidden mr-10 font-semibold">
			{{-- <li class="mr-6 p-1 border-b-2 border-orange-500">
				<a class="text-blue-200 cursor-default" href="#">Inicio</a>
			</li> --}}
			<li class="mr-6 p-2">
				<a class="text-white hover:text-blue-300" href="{{ route('index-galeria') }}">Galería</a>
			</li>
			<li class="mr-6 p-2">
				<a class="text-white hover:text-blue-300" href="{{ route('index-market') }}">Marketplace</a>
			</li>
			<li class="mr-6 p-2">
				<a class="text-blue-200 cursor-default hover:text-blue-300" href="{{ route('index-crowdfunding') }}">Crowdfunding</a>
            </li>
            
			<li class="mr-6 p-2">  
                <div class="dropdown inline-block">
                    @if (Auth::check())
                        <button class="bg-gray-900 text-white font-semibold px-4 rounded inline-flex items-center">
                            <span class="mr-1">{{Auth::user()-> name}}</span>    
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden text-gray-700 p-3 divide-y divide-gray-100">
                            <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('vista-perfil') }}">Ver perfil</a></li>
                            <li class=""><a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Opción 2</a></li>   
                            
                            @if (Auth::user()->current_team_id == 2)
                                <li class="">
                                    <a class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('crear-proyecto') }}">Crear Proyecto</a>
                                </li>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="border-gray-100">
                                    <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap relative" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"">
                                        Cerrar sesión
                                    </a>
                                </li>
                            </form>
                        </ul>
                    @else
                        <button class="bg-gray-900 text-white font-semibold px-4 inline-flex items-center">
                            <span class="mr-1"><a href="#">Opciones</a></span>    
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/> </svg>
                        </button> {{-- ring-1 ring-black ring-opacity-5 --}}
                        <ul class="dropdown-menu absolute hidden text-gray-700 p-3 divide-y divide-gray-100">
                            <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{ route('register') }}">Registrarse</a></li>
                            
                            <li class="border-gray-100">
                                <a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap relative" href="{{ route('login') }}">
                                    Acceder
                                </a>
                            </li>                        
                        </ul>
                    @endif
                </div>
			</li>
		</ul>
		<!--Progress bar-->
	</div>
    <br>