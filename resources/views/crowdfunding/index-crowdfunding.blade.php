<x-crowdfunding-layout>

    @section('content')
        <style>
            .limitlines7 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 7; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines5 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 5; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines2 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines1 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 1; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        </style>

        @livewire('carrusel-unico', ['tipo'=>'crowd'])

        <div class="px-6 ">
            <div class="lg:max-w-6xl w-full mx-auto lg:pb-10 pb-4">

                <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                <div class="text-center desaparece_5_segs">
                    @if (session()->has('success'))
                        <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                            ✔️{{ session('success') }}
                        </div>
                    @endif
                </div>

                <!-- TITULO PRINCIPaL-->
                <div class="text-center text-gray-800 font-extrabold text-5xl md:pt-10 pt-6">
                    <p>Crowdfunding Expresarte</p>
                    <hr class="max-w-xl mx-auto mt-6 border-2">
                </div>
                <div class="h-16"></div>

                <!-- ultimos proyectos agregados -->
                <div class=" bg-gray-900 rounded-lg">
                    <div class="grid grid-cols-2 md:grid-cols-3">
                        <div class="col-span-2 p-4">

                            <div class="bg-purple-700 p-2 rounded-lg mb-8 text-center">
                                <div class="inline-block text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </div>
                                <span class="text-xl font-bold text-white inline-block">¡Proyectos recientemente
                                    agregados!</span>

                                @if( $proyectos_pasados->count() >= 3)
                                    <a class="inline-block text-white hover:text-gray-200 transition duration-500 underline mx-6"
                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-activos-novedad']) }}">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-grid-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                                            </svg>
                                        </div>
                                        Ver todo
                                    </a>
                                @endif
                            </div>

                            @forelse($proyectos_novedosos as $proyecto)
                                <div
                                    class="bg-purple-700 hover:bg-purple-600 transition duration-500 rounded-t-lg rounded-b-3xl">
                                    <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                        <img
                                            src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}"
                                            class="w-full object-cover rounded-t-lg" style="height: 400px">
                                    </a>

                                    <div class="text-white px-4 pb-4 ">
                                        <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                            <p class="text-3xl font-bold mt-4 text-center limitlines2">{{ $proyecto->titulo }}</p>
                                        </a>

                                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2">
                                            <div class="bg-gray-800 px-4 pt-4 pb-3 mx-auto rounded-xl">

                                                <!-- CIRCULO CON LA FOTO DE PERFIL DEL ARTISTA -->
                                                <div class="flex">
                                                    <div class="mr-2 flex-shrink-0">
                                                        <img class="rounded-full sm:h-12 h-8 sm:w-12 w-8"
                                                             src="{{asset( $proyecto->publicador->profile_photo_url)}}"/>
                                                    </div>

                                                    <!-- NOMBRE DE ARTISTA Y TEMA DE PROYECTO -->
                                                    <div class="font-light">
                                                        <div class="limitlines1">
                                                            {{ $proyecto->publicador->name}} {{ $proyecto->publicador->apellido}}
                                                        </div>
                                                        @if($proyecto->estado == 'EN CURSO')
                                                            <a class="py-1 px-2 bg-yellow-300 hover:bg-yellow-200 transition duration-500 inline-block rounded-md"
                                                               href="{{ route('index-clasificacion', ['clasificacion' => 'todos-activos']) }}">
                                                                <div class=" text-sm text-white ">
                                                                    en curso
                                                                </div>
                                                            </a>
                                                        @else
                                                            <a class="py-1 px-2 bg-red-600 hover:bg-red-500 transition duration-500 inline-block rounded-md"
                                                               href="{{ route('index-clasificacion', ['clasificacion' => 'todos-finalizados']) }}">
                                                                <div class=" text-sm text-white ">
                                                                    finalizado
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- datos acerca del proyecto -->
                                                <div class="mt-2">
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-calendar-check-fill"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                                        </svg>
                                                    </div>
                                                    @if($proyecto->fecha_inicio> today())
                                                        Se iniciará el @else Se inició el @endif
                                                    <span>{{ date_format(date_create($proyecto->fecha_inicio), 'd-m-Y H:i') }}</span>
                                                </div>
                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-eye-fill"
                                                             viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>
                                                    </div>
                                                    Idea visitada
                                                    <span>{{ $proyecto->contador_visitas }}</span> veces.
                                                </div>
                                            </div>

                                            <div class="limitlines5 italic mt-2">
                                                <p>{{ $proyecto->sub_titulo }}</p>
                                            </div>
                                        </div>

                                    @php
                                        $progreso = round($proyecto->monto_actual/$proyecto->meta * 100.0);
                                    @endphp
                                    <!-- BARRA DEL PROGRESO -->
                                        <div class=" mt-2 md:mt-4">

                                            <!-- barra del progreso fisica -->
                                            <div
                                                class="overflow-hidden mx-auto h-8 w-full text-xs flex rounded-full bg-gray-200 relative">
                                                <div id="progress_bar" style="width:{{$progreso.'%'}}"
                                                     class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400">
                                                </div>

                                                <div class="grid grid-cols-1 mx-auto">
                                                    <div
                                                        class="bg-transparent absolute bottom-0 inset-1 text-center text-lg text-gray-800 font-semibold"
                                                        style="mx-auto;">{{$progreso}} %
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="@if($loop->last==false) h-8 @endif"></div>
                            @empty
                                <div class="h-8"></div>
                                <div class="text-center p-4 text-gray-800">No hay proyectos agregados recientemente.</div>
                                <div class="h-8"></div>
                            @endforelse
                        </div>

                        <!-- CUADROS CON LOS PROYECTOS MAS VISTADOS -->
                        <div class="col-span-2 md:col-span-1 p-4">

                            <div class="bg-blue-700 p-2 rounded-lg mb-4 text-center">
                                <span class="text-xl font-bold text-white">¡Las Ideas mas visitadas últimamente!</span>

                                @if( $proyectos_populares->count() >= 6)
                                    <a class="inline-block text-white hover:text-gray-200 transition duration-500 underline mx-6"
                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-orden-visitas']) }}">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-grid-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                                            </svg>
                                        </div>
                                        Ver todo
                                    </a>
                                @endif
                            </div>

                            @forelse($proyectos_populares as $proyecto)
                                <div
                                    class="bg-blue-700 hover:bg-blue-600 transition duration-500 rounded-t-lg rounded-b-xl">
                                    <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                        <img
                                            src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}"
                                            class="w-full object-cover rounded-t-lg h-48">
                                    </a>

                                    <div class="text-white px-2">
                                        <div class="mt-2">
                                            <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                                <p class="font-semibold limitlines2">{{ $proyecto->titulo }}</p>
                                            </a>
                                        </div>

                                        <div class="grid grid-cols-2 mt-2">
                                            <div>
                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-person-fill"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                        </svg>
                                                    </div>
                                                    <span> {{ $proyecto->publicador->name}} {{ $proyecto->publicador->apellido}}.</span>
                                                </div>
                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-eye-fill"
                                                             viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>
                                                    </div>
                                                    <span>{{ $proyecto->contador_visitas }}</span>
                                                </div>
                                            </div>

                                            <div>
                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-calendar-check-fill"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                                        </svg>
                                                    </div>
                                                    <span>{{ date_format(date_create($proyecto->fecha_inicio), 'd-m-Y') }}</span>
                                                </div>
                                                <div>
                                                    @if($proyecto->estado == 'EN CURSO')
                                                        <a class="py-1 px-2 bg-yellow-300 hover:bg-yellow-200 transition duration-500 inline-block rounded-md"
                                                           href="{{ route('index-clasificacion', ['clasificacion' => 'todos-activos']) }}">
                                                            <div class=" text-sm text-white ">
                                                                en curso
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a class="py-1 px-2 bg-red-600 hover:bg-gray-700 transition duration-500 inline-block rounded-md"
                                                           href="{{ route('index-clasificacion', ['clasificacion' => 'todos-finalizados']) }}">
                                                            <div class=" text-sm text-white ">
                                                                finalizado
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div
                                        class="overflow-hidden mt-2 mx-auto h-4 w-full text-xs flex rounded-full bg-gray-200">
                                        <div id="progress_bar"
                                             style="width:{{round($proyecto->monto_actual/$proyecto->meta * 100.0).'%'}}"
                                             class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400"></div>
                                    </div>
                                </div>

                                <div class="@if($loop->last==false) h-4 @endif"></div>
                            @empty
                                <div class="h-8"></div>
                                <div class="text-center p-4 text-gray-800">No hay proyectos con mas visitas.</div>
                                <div class="h-8"></div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Esta es la ultima semana -->

                <!-- Hoy es todo o nada -->

                <div class="h-16"></div>

                <!-- DEMOS UNA OPORTUNIDAD LOS MENOS FINANCIADOS  -->
                <div>
                    <div class="bg-gray-800 p-2 rounded-lg text-center">
                        <span class="text-xl font-bold text-white">¡Grades Ideas a la espera de tu apoyo!</span>

                        @if( sizeof($proyectos_menos_financiamiento) >= 6)
                            <a class="inline-block text-white hover:text-gray-200 transition duration-500 underline mx-6"
                               href="{{ route('index-clasificacion', ['clasificacion' => 'todos-orden-menos-apoyo']) }}">
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-grid-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                                    </svg>
                                </div>
                                Ver todo
                            </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mt-4">
                        @forelse($proyectos_menos_financiamiento as $proyecto)

                            <div
                                class="bg-gray-800 hover:bg-gray-200 text-white hover:text-gray-800 transition duration-500 rounded-t-lg rounded-b-xl relative">
                                <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                    <img
                                        src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-t-lg h-64">
                                </a>

                                <div class="px-4">
                                    <div class="mt-2">
                                        <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                            <p class="font-semibold text-xl text-center limitlines1">{{ $proyecto->titulo }}</p>
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-2 mt-2 gap-2">
                                        <div>
                                            <div>
                                                <p class="limitlines5">{{ $proyecto->sub_titulo }}</p>

                                                <div class="inline-block mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-person-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    </svg>
                                                </div>
                                                <span
                                                    class="font-semibold"> {{ $proyecto->publicador->name}} {{ $proyecto->publicador->apellido}}.</span>
                                            </div>
                                            <div class="grid grid-cols-2">
                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-calendar-check-fill"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                                        </svg>
                                                    </div>
                                                    <span>{{ date_format(date_create($proyecto->fecha_inicio), 'd-m-Y') }}</span>
                                                </div>

                                                <div>
                                                    <div class="inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-eye-fill"
                                                             viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>
                                                    </div>
                                                    <span>{{ $proyecto->contador_visitas }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <p class="limitlines7">{{ $proyecto->descripcion }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="h-4"></div>
                                <div
                                    class="overflow-hidden absolute bottom-0 mx-auto h-4 w-full text-xs flex rounded-full bg-gray-200">
                                    <div id="progress_bar"
                                         style="width:{{round($proyecto->monto_actual/$proyecto->meta * 100.0).'%'}}"
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400"></div>
                                </div>
                                <div class="h-4"></div>

                            </div>
                        @empty
                            <div class="h-8"></div>
                            <div class="text-center p-4 text-gray-800">No hay proyectos con poco apoyo.</div>
                            <div class="h-8"></div>
                        @endforelse
                    </div>
                </div>

                <!-- ultimos proyectos agregados -->
                <div class="h-16"></div>

                <!-- historial de proyectos terminados -->
                <div>
                    <div class="bg-red-600 p-2 rounded-lg text-center">
                        <span class="text-xl font-bold text-white">¡Historial de Proyectos finalizados!</span>

                        @if( $proyectos_pasados->count() >= 6)
                            <a class="inline-block text-white hover:text-gray-200 transition duration-500 underline mx-6"
                               href="{{ route('index-clasificacion', ['clasificacion' => 'todos-finalizados']) }}">
                                <div class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-grid-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                                    </svg>
                                </div>
                                Ver todo
                            </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                        @forelse($proyectos_pasados as $proyecto)

                            <div
                                class="bg-red-600 hover:bg-red-500 transition duration-500 rounded-t-lg rounded-b-2xl relative">
                                <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                    <img
                                        src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-t-lg h-48">
                                </a>

                                <div class="text-white px-2">
                                    <div class="mt-2">
                                        <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])}}">
                                            <p class="font-semibold text-center limitlines2">{{ $proyecto->titulo }}</p>
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-2 mt-2 gap-2">
                                        <div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-person-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    </svg>
                                                </div>
                                                <span> {{ $proyecto->publicador->name}} {{ $proyecto->publicador->apellido}}.</span>
                                            </div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-eye-fill"
                                                         viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </div>
                                                <span>{{ $proyecto->contador_visitas }}</span>
                                            </div>
                                        </div>

                                        <div>
                                            <div>
                                                <div class="inline-block">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-calendar-x-fill"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
                                                    </svg>
                                                </div>
                                                <span>{{ date_format(date_create($proyecto->fecha_limite), 'd-m-Y') }}</span>
                                            </div>
                                            <div>
                                                @if($proyecto->estado == 'EN CURSO')
                                                    <a class="py-1 px-2 bg-yellow-300 hover:bg-yellow-200 transition duration-500 inline-block rounded-md"
                                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-activos']) }}">
                                                        <div class=" text-sm text-white ">
                                                            en curso
                                                        </div>
                                                    </a>
                                                @else
                                                    <a class="py-1 px-2 bg-gray-800 hover:bg-gray-700 transition duration-500 inline-block rounded-md"
                                                       href="{{ route('index-clasificacion', ['clasificacion' => 'todos-finalizados']) }}">
                                                        <div class=" text-sm text-white ">
                                                            finalizado
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $progreso = round($proyecto->monto_actual/$proyecto->meta * 100.0);
                                @endphp

                                <div class="h-4"></div>
                                <div
                                    class="overflow-hidden mt-2 mx-auto h-6 w-full text-xs flex rounded-full bg-gray-200 absolute bottom-0">
                                    <div id="progress_bar"
                                         style="width:{{round($proyecto->monto_actual/$proyecto->meta * 100.0).'%'}}"
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400">
                                    </div>
                                    <div class="grid grid-cols-1 mx-auto">
                                        <div
                                            class="bg-transparent absolute bottom-0 inset-0 text-center text-lg text-gray-800 font-semibold"
                                            style="mx-auto;">{{$progreso}} %
                                        </div>
                                    </div>
                                </div>
                                <div class="h-4"></div>

                            </div>
                        @empty
                            <div class="h-8"></div>
                            <div class="text-center p-4 text-gray-800">Aún no hay proyectos finalizados.</div>
                            <div class="h-8"></div>
                        @endforelse
                    </div>
                </div>
                <div class="h-16"></div>

            </div>
        </div>

    @endsection
</x-crowdfunding-layout>

