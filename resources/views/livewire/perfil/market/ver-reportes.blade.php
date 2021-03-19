<div class="bg-white overflow-hidden shadow-xl sm:rounded">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex flex-row justify-around bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <input wire:model="busqueda_nombre_producto"
                       class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text"
                       placeholder="Buscar producto...">
                <input wire:model="busqueda_nombre_artista"
                       class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text"
                       placeholder="Buscar artista...">
                <input wire:model="busqueda_nombre_acusador"
                       class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text"
                       placeholder="Buscar acusador...">
                <select wire:model="motivo" class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2">
                    <option value=''>Todos los motivos</option>
                    <option value='Nombre indebido'>Motivo nombre indebido</option>
                    <option value='Precio indebido'>Motivo de precio indebido</option>
                    <option value='Contenido indebido'>Motivo de contenido indebido</option>
                    <option value='Otro'>Otros motivos</option>
                </select>
                <select wire:model="asc_desc" class="flex flex-row justify-around form-input rounded-md shadow-sm">
                    <option value='desc'>Fecha descendente</option>
                    <option value='asc'>Fecha ascendente</option>
                </select>
            </div>
            @if($reportes->count())
                <table class="w-full table-fixed divide-y divide-gray-500">
                    <thead class="">
                    <tr>
                        <th class="w-2/12 text-center font-sans text-exp-azul">
                            Producto
                        </th>
                        <th class="w-1/12 text-center font-sans text-exp-azul">
                            Motivo
                        </th>
                        <th class="w-6/12 text-center font-sans text-exp-azul">
                            Descripci&oacute;n
                        </th>
                        <th class="w-1/12 text-center font-sans text-exp-azul">
                            Acusador
                        </th>
                        <th class="w-1/12 text-center font-sans text-exp-azul">
                            Fecha
                        </th>
                        <th class="w-1/12 text-center font-sans text-exp-azul">
                            Acci&oacute;n
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-400">
                    @foreach($reportes as $reporte)
                        <tr>
                            <td class="w-2/12 whitespace-nowrap">
                                <div class="mx-2 my-2 flex items-center">
                                    @if($reporte->producto)
                                        <a href="{{ route('ver-producto', ['slug' => $reporte->producto->slug ]) }}">
                                            <div class="flex-shrink-0 h-20 w-20 mr-6">
                                                <img class="h-20 w-20 rounded-full"
                                                     src="{{isset($reporte->producto->imagenes[0])? asset($reporte->producto->imagenes[0]->ruta) : asset('images/imagen-default.jpg')}}"
                                                     alt="img-{{$reporte->producto->slug}}">
                                            </div>
                                        </a>
                                        <div class="container whitespace-normal">
                                            <p class="text-center font-bold">
                                                {{$reporte->producto->nombre}}
                                            </p>
                                            <p class="text-center font-medium">
                                                {{$reporte->artista_name}}
                                            </p>
                                            <p class="text-center font-medium">
                                                {{$reporte->artista_apellido}}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="w1/12 m-4 whitespace-normal">
                                <p class="text-center">{{$reporte->motivo}}</p>
                            </td>
                            <td class="w-6/12 m-4 whitespace-nowrap">
                                <p class=" m-4 text-center">{{$reporte->descripcion != null ? $reporte->descripcion : "Sin descripción provista"}}</p>
                            </td>
                            <td class="w-1/12 m-4 whitespace-nowrap">
                                <p class="text-center font-medium whitespace-nowrap px-12">{{$reporte->acusador_name}}</p>
                                <p class="text-center font-medium whitespace-nowrap px-12">{{$reporte->acusador_apellido}}</p>
                            </td>
                            <td class="w/12 m-4 whitespace-nowrap">
                                <p class="text-center">{{$reporte->created_at = date("d-m-Y H:i")}}</p>
                            </td>
                            <td class="w/12 m-4 justify-center whitespace-nowrap">
                                <button class="font-bold bg-green-500 hover:bg-green-700 rounded-xl px-3 py-2 m-4"
                                        style="outline: 0px;" wire:click="eliminarReporte({{$reporte->id}})">
                                    Descartar Reporte
                                </button>
                                <form method="POST" wire:submit.prevent="eliminarProducto({{$reporte->producto_id}})">
                                    <x-utilidades.modal-confirmacion id="eliminarProducto" titulo="Eliminar producto"
                                                                     tema="eliminar" estilosBoton=""
                                                                     clasesBoton="font-bold bg-red-500 hover:bg-red-700 rounded-xl px-3 py-2 m-4 normal-case focus:outline-none"
                                                                     colorBg="bg-red-500"
                                                                     colorBgHover="hover:bg-red-700"
                                                                     colorTexto="text-red-500"
                                                                     colorBordeIcono="border-red-500"
                                                                     tipoIcono="delete" form="true" rutaHref=""
                                                                     idParamRuta=""/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="w-full flex justify-around border-t">
                    <select wire:change="resetPaginaUno()" wire:model="por_pagina" class="form-input rounded-md my-2">
                        <option value='' selected disabled>Mostrar por p&aacute;gina</option>
                        <option value="3">3 por p&aacute;gina</option>
                        <option value="9">9 por p&aacute;gina</option>
                        <option value="18">18 por p&aacute;gina</option>
                        <option value="24">24 por p&aacute;gina</option>
                        <option value="36">36 por p&aacute;gina</option>
                        <option value="99">99 por p&aacute;gina</option>
                    </select>
                    <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
                        {{$reportes->links("livewire.paginacion-personalizada")}}
                    </div>
                </div>
            @else
                <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
                    <p>No hay resultados @if(!empty($busqueda_nombre_producto)) para la b&uacute;squeda del producto
                        '{{$busqueda_nombre_producto}}'@endif @if(!empty($busqueda_nombre_artista)) del artista
                        '{{$busqueda_nombre_artista}}'@endif @if(!empty($busqueda_nombre_acusador)) del acusador
                        '{{$busqueda_nombre_acusador}}'@endif.</p>
                </div>
            @endif
        </div>
    </div>
</div>
