<x-crowdfunding-layout>
    @section('content')

        <style>
            /* MEDIA */
            /* EMBED VIDEO */
            .embed {
                position: relative;
                padding-bottom: 56%; /* padding-bottom = iframe width */
                clear: both;
                height: 0;
                overflow: hidden;
                max-width: 100%;
                height: auto;
            }

            .embed iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            .flex-height {
                display: flex !important;
                flex-flow: column !important;
            }

            .fill-height {
                flex-grow: 1 !important;
            }

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

            .limitlines8 {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 8; /* number of lines to show */
                -webkit-box-orient: vertical;
            }
        </style>

        <div class="bg-gray-100 min-h-screen sm:pb-12 sm:pt-8 sm:px-6 px-2 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white sm:px-6 px-4 pb-2 rounded-md">

                    <!-- MENSAJES DE CONFIRMACION POR ACCIONES EN FORMULARIOS -->
                    <div class="text-center desaparece_5_segs pt-1">
                        @if (session()->has('success'))
                            <div class="my-4 p-3 mx-auto max-w-6xl bg-green-300 text-green-700 rounded shadow-sm">
                                ✔️{{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <!-- Titulo del producto -->
                    <div class="text-center py-6">
                        <p class="text-4xl text-gray-800 font-sans">
                            {{ $proyecto->titulo }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 grid-cols-1 gap-4 mt-4">
                        <!-- Imagen principal del proyecto -->
                        <div class="mb-4 sm:mb-0 col-span-1 sm:col-span-2">
                            <img class="rounded-md mx-auto"
                                 src="{{ isset($proyecto->imagen_portada)? asset($proyecto->imagen_portada): asset('images/imagen-default.jpg') }}">
                        </div>

                        <div>
                            <div class="bg-gray-800 px-4 pt-4 pb-3 text-white mx-auto rounded-xl">

                                <!-- CIRCULO CON LA FOTO DE PERFIL DEL ARTISTA -->
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-2">
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
                                               href="#">
                                                <div class=" text-sm text-white ">
                                                    en curso
                                                </div>
                                            </a>
                                        @else
                                            <a class="py-1 px-2 bg-red-600 hover:bg-red-500 transition duration-500 inline-block rounded-md"
                                               href="#">
                                                <div class=" text-sm text-white ">
                                                    finalizado
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- datos acerca del proyecto -->
                                @if($proyecto->publicador->obras)
                                    <div class="mt-4">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-palette-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.433 10.07C14.133 10.585 16 11.15 16 8a8 8 0 1 0-8 8c1.996 0 1.826-1.504 1.649-3.08-.124-1.101-.252-2.237.351-2.92.465-.527 1.42-.237 2.433.07zM8 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm4.5 3a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM5 6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                            </svg>
                                        </div>
                                        <span>Exponedor de Obras.</span>
                                    </div>
                                @endif

                                @if($proyecto->publicador->productos)
                                    <div class="mt-2">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                            </svg>
                                        </div>
                                        <span>Socio en Market.</span>
                                    </div>
                                @endif

                                @if($tiene_mas_proy == 'SI')
                                    <div class="mt-2">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        </div>
                                        <span>Tiene más proyectos.</span>
                                    </div>
                                @endif

                            </div>

                            <div class="limitlines5 italic mt-4">
                                <p>{{ $proyecto->sub_titulo }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="h-8"></div>

                    @php
                        $ahora = new DateTime("now");
                        $fecha_limite = new DateTime($proyecto->fecha_limite);
                        $tiempo_restante = $fecha_limite->diff($ahora)->format("%a días, %h horas y %I minutos");
                        $tiempo_pasado= $fecha_limite->diff($ahora)->format("%a días, %h horas y %I minutos");
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div class="col-span-1 bg-purple-600 rounded-xl p-4">
                        @php
                            $progreso = round($proyecto->monto_actual/$proyecto->meta * 100.0);
                        @endphp
                        <!-- BARRA DEL PROGRESO -->
                            <div>
                                <div class="text-white">
                                    <div class="text-3xl text-center">
                                        $ {{number_format($proyecto->monto_actual,0,',','.')}} CLP
                                    </div>

                                    <div class="text-xl text-center"> para la meta de
                                        $ {{number_format($proyecto->meta,0,',','.')}} CLP
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 mt-4">
                                    <div class="text-white">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="currentColor"
                                                 class="bi bi-people-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                                <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                            </svg>
                                        </div>

                                        <span class="inline-block">{{ $colaboradores->count() }} colaboradores.</span>
                                    </div>

                                    <div class="text-white">
                                        <div class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="currentColor" class="bi bi-eye-fill"
                                                 viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                            </svg>
                                        </div>

                                        <span class="inline-block">{{ $proyecto->contador_visitas }} visitas.</span>
                                    </div>
                                </div>

                                <div class="text-white">
                                    <div class="inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-calendar-check-fill"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                        </svg>
                                    </div>
                                    @if($proyecto->fecha_inicio> today())
                                        El proyecto iniciará el @else El proyecto inició el @endif
                                    <span>{{ date_format(date_create($proyecto->fecha_inicio), 'd-m-Y') }}.</span>
                                </div>

                                <div class="text-white">
                                    <div class="inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-calendar-x-fill"
                                             viewBox="0 0 16 16">
                                            <path
                                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
                                        </svg>
                                    </div>
                                    @if($proyecto->estado == 'EN CURSO')
                                        <span>Finalizará en {{ $tiempo_restante }}.</span>
                                    @else
                                        <span>Finalizó hace {{ $tiempo_pasado }}.</span>
                                    @endif
                                </div>

                                <!-- barra del progreso fisica -->
                                <div
                                    class="overflow-hidden mt-4 mx-auto h-8 w-full text-xs flex rounded-full bg-gray-200 relative">
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

                        <div class="relative">
                            <div class="rounded-md p-2 text-center block bg-gray-200">
                                <div class="inline-block text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-share-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                                    </svg>
                                </div>
                                Compartir Proyecto por Redes Sociales
                            </div>

                            <div class="grid grid-cols-3 mt-4">
                                <div class="mx-auto">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                                       target="_blank">
                                        <img class="h-16 w-16"
                                             src="{{ URL::to('/images/RRSS/face-v1.svg') }}">
                                    </a>
                                </div>

                                <div class="mx-auto">
                                    <a href="https://twitter.com/intent/tweet?text=Se%20parte%20de%20una%20gran%20idea&url={{ Request::fullUrl() }}"
                                       target="_blank">
                                        <img class="h-16 w-16"
                                             src="{{ URL::to('/images/RRSS/twitt-v1.svg') }}">
                                    </a>
                                </div>

                                <div class="mx-auto">
                                    <a href="https://api.whatsapp.com/send?text=Se%20parte%20de%20una%20gran%20idea%20{{ Request::fullUrl()  }}"
                                       target="_blank">
                                        <img class="h-16 w-16"
                                             src="{{ URL::to('/images/RRSS/what-v1.svg') }}">
                                    </a>
                                </div>
                            </div>

                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->current_team_id != 1 && $proyecto->estado == 'EN CURSO')


                                @if(\Illuminate\Support\Facades\Auth::user()->current_team_id ==2 || \Illuminate\Support\Facades\Auth::user()->current_team_id ==3)

                                    @if($es_dueno == 'SI')
                                        <a href="{{ route('editar-proyecto', ['id' => $proyecto->id]) }}"
                                           class="p-4 mt-4 text-xl block mx-auto text-center text-white rounded-xl bg-blue-800 hover:bg-blue-700 transition duration-500">
                                            <div class="inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                     fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                </svg>
                                            </div>
                                            <span class="inline-block">Editar Proyecto</span>
                                        </a>
                                    @else
                                        <div class="md:h-24 h-0"></div>
                                    @endif


                                    <a href="{{ route('escoger-premios-art', ['id' => $proyecto->id]) }}"
                                       class="p-4 mt-4 text-xl block text-center mx-auto rounded-xl bg-green-500 hover:bg-green-400 transition duration-500">
                                        <div class="inline-block text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                 fill="currentColor"
                                                 class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                            </svg>
                                        </div>
                                        <span class="inline-block text-white">Patrocinar Proyecto</span>
                                    </a>
                                @else
                                    <a href="{{ route('escoger-premios', ['id' => $proyecto->id]) }}"
                                       class="p-4 text-xl block text-center absolute bottom-0 inset-x-0 mx-auto rounded-xl
       bg-green-500 hover:bg-green-400 transition duration-500">
                                        <div class="inline-block text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                 fill="currentColor"
                                                 class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                            </svg>
                                        </div>
                                        <span class="inline-block text-white">Patrocinar Proyecto</span>
                                    </a>
                                @endif

                            @else
                                <div class="h-12"></div>
                                <div class="h-12"></div>

                                <a @if($proyecto->estado == 'FINALIZADO')
                                   @else href="{{ route('login') }} @endif"
                                   class="p-4 text-xl block text-center absolute bottom-0 inset-x-0 mx-auto rounded-xl
       bg-gray-800 hover:bg-gray-700 transition duration-500">
                                    <div class="inline-block text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor"
                                             class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                        </svg>
                                    </div>
                                    <span class="inline-block text-white"> @if($proyecto->estado == 'FINALIZADO')
                                            Proyecto Finalizado @else Patrocinar Proyecto @endif </span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="h-8"></div>

                    <div class="mt-4">
                        <div class="font-light">
                            {!! str_replace("\n", "<br>", $proyecto->descripcion) !!}
                        </div>
                    </div>

                    <div class="h-8"></div>

                    <div class="mt-4">
                        <div class="embed rounded-md">
                            <iframe
                                src={{ $proyecto->url_video }} frameborder="0" allowfullscreen="">
                            </iframe>
                        </div>
                    </div>

                    <div class="h-8"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 mt-4 mb-2 gap-4">
                        <div class="col-span-1 sm:col-span-2">
                            <div class="bg-purple-700 p-2 mb-4 rounded-md text-white text-center font-sans text-lg">
                                Galería de imagenes
                            </div>

                            @forelse($proyecto->imagenes as $imagen_uni)
                                <div class="mb-4">
                                    <img class="rounded-md mx-auto"
                                         src="{{ isset($imagen_uni->ruta)? asset($imagen_uni->ruta): asset('images/imagen-default.jpg') }}">
                                </div>
                            @empty
                                <div class="h-8"></div>
                                <div class="text-center p-4 text-gray-800">No hay Recompensas registradas aún.</div>
                                <div class="h-8"></div>
                            @endforelse
                        </div>

                        <!-- DESPLIEGUE DE LAS RECOMPENSAS -->
                        <div>
                            <div class="bg-orange-500 p-2 mb-4 rounded-md text-white text-center font-sans text-lg">
                                Recompensas por apoyar el Proyecto
                            </div>

                            <div class="text-white">
                                @forelse($proyecto->premios as $premio)
                                    <div
                                        class="mb-4 bg-orange-500 rounded-xl hover:bg-orange-400 transition duration-500 p-2">
                                        <div class="text-center limitlines2">
                                            {{ $premio->nombre }}
                                        </div>

                                        <div
                                            class="mt-2 font-light border-dashed border-2 px-2 py-1  rounded-xl border-gray-800 limitlines8">
                                            {!! str_replace("\n", "<br>", $premio->descripcion) !!}
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
                    </div>

                    <div class="h-16"></div>


                    <!-- titulo mas creaciones del artista-->
                    <div class="grid grid-cols-1">
                        <p class="text-3xl text-gray-800 font-sans mx-auto">
                            @if($tiene_mas_proy == 'SI')
                                Más ideas del mismo Artista
                            @else
                                Más ideas para conocer
                            @endif
                        </p>
                    </div>
                    <div class="h-8"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-4">

                        @forelse($los_relacionados as $one_proy)

                            <div
                                class="bg-gray-800 hover:bg-gray-700 transition duration-500 rounded-t-lg rounded-b-2xl relative">
                                <a href="{{ route('mostrar-proyecto',['id' => $one_proy->id])}}">
                                    <img
                                        src="{{ isset($one_proy->imagen_portada)? asset($one_proy->imagen_portada): asset('images/imagen-default.jpg') }}"
                                        class="w-full object-cover rounded-t-lg h-48">
                                </a>

                                <div class="text-white px-2">
                                    <div class="mt-2">
                                        <a href="{{ route('mostrar-proyecto',['id' => $one_proy->id])}}">
                                            <p class="font-semibold text-center limitlines2">{{ $one_proy->titulo }}</p>
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
                                                <span> {{ $one_proy->publicador->name}} {{ $one_proy->publicador->apellido}}.</span>
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
                                                <span>{{ $one_proy->contador_visitas }}</span>
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
                                                <span>{{ date_format(date_create($one_proy->fecha_inicio), 'd-m-Y') }}</span>
                                            </div>
                                            <div>
                                                @if($one_proy->estado == 'EN CURSO')
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
                                    $progreso = round( $one_proy->monto_actual/$one_proy->meta * 100.0);
                                @endphp

                                <div class="h-4"></div>
                                <div
                                    class="overflow-hidden mt-2 mx-auto h-6 w-full text-xs flex rounded-full bg-gray-200 absolute bottom-0">
                                    <div id="progress_bar"
                                         style="width:{{round($one_proy->monto_actual/$one_proy->meta * 100.0).'%'}}"
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


