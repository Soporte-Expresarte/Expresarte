<div class="bg-white overflow-hidden shadow-xl sm:rounded">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if ($tipo_usuario_actual == "Usuarios")
                <div class="mt-10 sm:mt-0">
                    <h1 class="text-3xl mb-2"> ¡ Bienvenido {{Auth::user()->name}} {{Auth::user()->apellido}} !</h1>
                    <hr>
                </div>
                <br>
                <div>
                    <div class="w-full grid grid-flow-row auto-rows-max">
                        {{-- Por cada proyecto donado  --}}

                        @for($i = 0; $i < count($proyectos_donados); $i++)
                            @php
                                $proyecto = $proyectos_donados[$i];
                                $orden = $proyectos_ordenes[$i];
                                $despacho = $orden->despacho;
                            @endphp
                            <div
                                class="w-full grid grid-cols-5 gap-4 py-16 px-8 mt-16 bg-blue-100 shadow-lg rounded-md">
                                <div class="col-span-2 flex flex-col">
                                    <div class="">
                                        <img src="{{ asset($proyecto['imagen_portada']) }}"
                                             class="object-cover h-64 max-h-c1 w-full rounded-3xl">
                                    </div>
                                </div>

                                <div class="col-span-3 flex flex-col">
                                    <div class=" grid grid-cols-10 gap-4 ml-16">
                                        <div class="col-span-10 h-auto text-2xl text-center font-semibold">
                                            {{$proyecto['titulo']}}
                                        </div>

                                        <div class="col-span-10 h-auto text-lg text-center font-semibold">
                                            Estado: {{$proyecto['estado']}}
                                        </div>

                                        <div class="col-span-5 mt-8">
                                            <div class="mt-10">
                                                <h1 class="text-xl font-semibold uppercase w-full text-gray-900 text-center py-1">
                                                    Monto total pagado:</h1>
                                                <h1 class="text-xl w-full text-gray-900 text-center py-1">
                                                    $ {{number_format($orden->monto_pagado,0,',','.')}} DE
                                                    $ {{number_format($orden->monto_total,0,',','.')}}</h1>
                                            </div>
                                        </div>

                                        <div class="col-span-5 mt-10">
                                            <div class="w-full">
                                                <div class="flex flex-col">
                                                    <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])  }}"
                                                       class=" no-underline hover:no-underline mx-auto ">
                                                        <button
                                                            class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default focus:outline-none ">
                                                            Ver proyecto
                                                        </button>
                                                    </a>

                                                    <button wire:click="mostrarOcultarPremios({{$i}})"
                                                            class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default focus:outline-none no-underline hover:no-underline mx-auto">
                                                        @if($estado_botones[$i])
                                                            Ocultar premios
                                                        @else
                                                            Ver premios
                                                        @endif
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            {{-- Premios --}}
                            @if ($estado_botones[$i])
                                <div>

                                    @foreach($proyecto->premios as $premio)
                                        @php
                                            $cantidad_premio = 0;
                                            $monto_donado_premio = 0;
                                        @endphp
                                        @foreach($donaciones as $donacion)
                                            @if ($donacion->usuario_id == $id_usuario_actual && $donacion->premio_id == $premio->id)
                                                @php
                                                    $cantidad_premio = $donacion->cantidad;
                                                    $monto_donado_premio = $donacion->monto_donado;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($cantidad_premio != 0)
                                            <div class="border border-gray-600 rounded-md shadow-lg bg-yellow-100 p-5">
                                                <h1 class="text-2xl font-semibold w-full text-gray-900 text-center pt-1 pb-4">{{$premio->nombre}}</h1>
                                                <div class="flex content-start my-2">
                                                    <div class="w-auto text-xl font-semibold text-gray-900 pr-2">
                                                        Descripción:
                                                    </div>
                                                    <div class="w-auto text-xl text-gray-900 text-justify px-2">
                                                        {{$premio->descripcion}}
                                                    </div>
                                                </div>

                                                <div class="flex content-start my-2">
                                                    <div class="w-auto text-xl font-semibold text-gray-900 pr-2">
                                                        Donación:
                                                    </div>
                                                    <div class="w-auto text-xl text-gray-900 text-justify px-2">
                                                        $ {{number_format($monto_donado_premio,0,',','.')}}
                                                    </div>
                                                </div>

                                                <div class="flex content-start my-2">
                                                    <div class="w-auto text-xl font-semibold text-gray-900 pr-2">
                                                        Cantidad:
                                                    </div>
                                                    <div class="w-auto text-xl text-gray-900 text-justify px-2">
                                                        {{$cantidad_premio}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($despacho != null)
                                        <div class="border border-gray-600 rounded-md bg-green-200 p-5">
                                            <h1 class="text-2xl font-semibold w-full text-gray-900 text-center pt-1 pb-4">
                                                Detalles del despacho</h1>
                                            <div class="grid grid-flow-col grid-cols-2 grid-rows-3 gap-4 px-5">
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    @if($despacho->n_seguimiento == null)
                                                        Número seguimiento: No asignado
                                                    @else
                                                        Número seguimiento: {{ $despacho->n_seguimiento }}
                                                    @endif
                                                </div>
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    @if($despacho->compania_despacho == null)
                                                        Empresa que entrega: No asignada
                                                    @else
                                                        Empresa que entrega: {{ $despacho->compania_despacho }}
                                                    @endif
                                                </div>
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    Telefono: {{$despacho->celular}}
                                                </div>
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    Dirección: {{$despacho->calle}} #{{$despacho->numero_hogar}}
                                                </div>
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    Ciudad: {{$despacho->comuna}}
                                                </div>
                                                <div class="text-xl font-semibold text-gray-900 pr-2">
                                                    Región: {{$despacho->region}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endfor
                        @if(count($proyectos_donados) == 0)
                            <div class="text-center">No hay donaciones registradas</div>
                        @endif
                        <br>
                    </div>
                </div>
                <x-jet-section-border/>
        </div>

        @elseif ($tipo_usuario_actual == "Artistas")

            <div>
                <div class="grid grid-flow-col gap-4">
                    <div class="col-auto">
                        <h1 class="text-2xl text-black-200 font-bold text-justify ml-16"> Mis proyectos:</h1>
                    </div>

                    <div class="col-auto gap-4 flex flex-wrap flex-row-reverse mr-16">

                        <a href={{ route('crear-proyecto') }} class=" no-underline hover:no-underline">
                        <button
                            class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full py-4 px-8 shadow-lg uppercase tracking-wider cursor-default ">
                            Crear Nuevo Proyecto
                        </button>
                        </a>
                        <!--.
                        <a href="#" class=" no-underline hover:no-underline">
                            <button class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default ">
                                Ejemplo
                            </button>
                        </a>

                        <a href="#" class=" no-underline hover:no-underline">
                            <button class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default ">
                                Ejemplo
                            </button>
                        </a>-->

                    </div>
                </div>

                <x-jet-section-border/>

                <div class="my-8 mx-16">
                    <div class="w-full grid grid-flow-row auto-rows-max">
                        @foreach($proyectos_artista as $proyecto)
                            <div class="w-full grid grid-cols-5 gap-4 py-16 px-8 bg-blue-100">
                                <div class="col-span-2 flex flex-col">
                                    <div class="">
                                        <img src={{ asset($proyecto['imagen_portada']) }} class=" object-cover h-64
                                             max-h-c1 w-full rounded-3xl">
                                    </div>
                                </div>

                                <div class="col-span-3 flex flex-col">
                                    <div class=" grid grid-cols-10 gap-4 ml-16">
                                        <div class="col-span-10 h-auto text-2xl text-center font-semibold">
                                            {{$proyecto['titulo']}}
                                        </div>

                                        <div class="col-span-10 h-auto text-lg text-center font-semibold">
                                            Estado: {{$proyecto['estado']}}
                                        </div>

                                        <div class="col-span-5 mt-8">
                                            @php
                                                $progreso = round($proyecto['monto_actual']/$proyecto['meta']*100,0)
                                            @endphp
                                            <div
                                                class="overflow-hidden mx-auto h-4 w-full mb-4 text-xs flex rounded-full border-2 border-black bg-white">
                                                <div id="progress_bar" style="width:{{$progreso.'%'}}"
                                                     class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400"></div>
                                            </div>

                                            <h1 class="text-xl w-full text-gray-900 text-center py-1"> Recaudado:</h1>
                                            <h1 class="text-xl w-full text-gray-900 text-center py-1">
                                                $ {{number_format($proyecto['monto_actual'],0,',','.')}} de
                                                $ {{number_format($proyecto['meta'],0,',','.')}}</h1>
                                        </div>

                                        <div class="col-span-5 mt-8">
                                            <div class="w-full">
                                                <div class="flex">
                                                    <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])  }}"
                                                       class=" no-underline hover:no-underline mx-auto ">
                                                        <button
                                                            class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default focus:outline-none ">
                                                            Ir al proyecto
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <br>
                            <hr>
                        @endforeach
                        <br>
                    </div>
                </div>
            </div>

        @elseif ($tipo_usuario_actual == "Administradores")
            <div>

                <x-jet-section-border/>

                <div class="mx-auto">
                    <h1 class="text-3xl text-center my-10">Proyectos Pendientes</h1>
                    <div>
                        <div class="w-full flex pb-10">
                            <div class="w-3/6 mx-1">
                                <input wire:model.debounce.300ms="busqueda" type="text"
                                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                       placeholder="Buscar Título...">
                            </div>
                            <div class="w-1/6 relative mx-1">
                                <select wire:model="ordenar_por"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state">
                                    <option value="id">Ordenar por ID</option>
                                    <option value="titulo">Ordenar por Título</option>
                                    <option value="duracion_dias">Ordenar por Duración</option>
                                    <option value="meta">Ordenar por Meta</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-1/6 relative mx-1">
                                <select wire:model="orden_ascendente"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state">
                                    <option value="1">Orden Ascendente</option>
                                    <option value="0">Orden Descendente</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-1/6 relative mx-1">
                                <select wire:model="proyectos_por_pagina"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-state">
                                    <option value="5">5 por página</option>
                                    <option value="10">10 por página</option>
                                    <option value="15">15 por página</option>
                                    <option value="20">20 por página</option>
                                    <option value="30">30 por página</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <table class="table-fixed divide-y divide-gray-500 md:w-full mb-6">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Titulo</th>
                                <th class="px-4 py-2">Duración</th>
                                <th class="px-4 py-2">Meta</th>
                                <th class="px-4 py-2">Acción</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($proyectos_pendientes as $proyecto)
                                <tr>
                                    <td class="w-1/6 mx-2 my-2 whitespace-nowrap w-min-content p-2">{{ $proyecto->id }}</td>
                                    <td class="w-1/6 mx-2 my-2 whitespace-nowrap w-min-content p-2">{{ $proyecto->titulo }}</td>
                                    <td class="w-1/6 mx-2 my-2 whitespace-nowrap w-min-content p-2">{{ $proyecto->duracion_dias }}
                                        días
                                    </td>
                                    <td class="w-1/6 mx-2 my-2 whitespace-nowrap w-min-content p-2">
                                        $ {{number_format($proyecto['meta'],0,',','.')}}CLP
                                    </td>
                                    <td class="w-1/6 mx-2 my-2 whitespace-nowrap w-min-content p-2">
                                        <div class="grid grid-cols-1 ml-6 md:ml-0">
                                            <a href={{ route('mostrar-proyecto-admin',['id' => $proyecto->id]) }} class="
                                               place-self-center no-underline hover:no-underline">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg py-3 px-4 shadow-lg tracking-wider cursor-default focus:outline-none">
                                                Revisar
                                            </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $proyectos_pendientes->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
</div>
