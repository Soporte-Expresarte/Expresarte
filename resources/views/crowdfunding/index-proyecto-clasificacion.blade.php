<x-crowdfunding-layout>
    @section('content')
        <style>
            .limitlines1 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 1; /* number of lines to show */
                -webkit-box-orient: vertical;
            }

            .limitlines2 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        </style>

        <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 pb-2 rounded-md">

                    <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                    <div class="text-center desaparece_5_segs">
                        @if (session()->has('success'))
                            <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                                ✔️{{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-sans">
                            @if($clasificacion == 'todos-activos-novedad')
                                Proyectos activos en orden de novedad

                            @elseif($clasificacion == 'todos-orden-visitas')
                                Proyectos ordenados por visitas

                            @elseif($clasificacion == 'todos-orden-menos-apoyo')
                                Proyectos activos con menor apoyo

                            @elseif($clasificacion == 'todos-finalizados')
                                Proyectos ya finalizados

                            @else
                                Todos los proyectos

                            @endif
                        </p>
                    </div>

                    <div class="h-16"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-4">
                        @forelse($los_proyectos as $proyecto)

                            <div
                                class="bg-gray-800 hover:bg-gray-700 transition duration-500 rounded-t-lg rounded-b-2xl relative">
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
                                                    <a class="py-1 px-2 bg-red-600 hover:bg-red-500 transition duration-500 inline-block rounded-md"
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
                            <div class="text-center p-4 text-gray-800">No hay resultados para el tipo de busqueda.</div>
                            <div class="h-8"></div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>


    @endsection
</x-crowdfunding-layout>
