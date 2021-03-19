<div class="justify-center">
    @if($productos->count() != 0)
        <div class="-my-2 overflow-x-auto | sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="flex flex-col shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table-fixed divide-y divide-gray-500">
                        <thead>
                            <tr>
                                <th class="w-1/5 text-center font-sans text-exp-azul">
                                    Producto
                                </th>
                                <th class="w-1/5 text-center font-sans text-exp-azul">
                                    Stock
                                </th>
                                <th class="w-1/5 text-center font-sans text-exp-azul">
                                    Vendidos
                                </th>
                                <th class="w-1/5 text-center font-sans text-exp-azul">
                                    Precio
                                </th>
                                <th class="w-1/5 text-center font-sans text-exp-azul">
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-400">
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="whitespace-nowrap">
                                        <div class="mx-2 my-2 flex items-center">
                                            <a href="{{ route('ver-producto', ['slug' => $producto->slug]) }}">
                                                <div class="flex-shrink-0 h-20 w-20">
                                                    <img class="h-20 w-20 rounded-full" src="{{isset($producto->imagenes[0])? asset($producto->imagenes[0]->ruta) : asset('images/imagen-default.jpg')}}"
                                                    alt="img-{{$producto->slug}}">
                                                </div>
                                            </a>
                                            <div class="ml-4">
                                                <div class="text-sm text-gray-900">
                                                    {{$producto->nombre}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="m-4 whitespace-nowrap">
                                        <p class="text-center">{{$producto->stock}}</p>
                                    </td>
                                    <td class="m-4 whitespace-nowrap">
                                        <p class="text-center">{{$producto->vendidos}}</p>
                                    </td>
                                    <td class="m-4 whitespace-nowrap">
                                        <p class="text-center">${{number_format($producto->precio, 0, ",", ".")}}</p>
                                    </td>
                                    <td class="m-4 whitespace-nowrap flex justify-center">
                                        <form action="{{ route('editar-producto', $producto->slug) }}" method="GET">
                                            <button class="w-32 font-bold bg-green-500 hover:bg-green-700 rounded-xl px-3 py-2 m-4 focus:outline-none">
                                                Editar Producto
                                            </button>
                                        </form>
                                        <form method="POST" wire:submit.prevent="eliminarProducto({{$producto->id}})">
                                            <!-- Se deja sin ID ya que está dentro de un foreach y causa problemas de duplicación al ponerle id -->
                                            <x-utilidades.modal-confirmacion id="" titulo="Eliminar producto" tema="eliminar" estilosBoton=""
                                            clasesBoton="w-32 font-bold bg-red-500 hover:bg-red-700 rounded-xl px-3 py-2 m-4 normal-case focus:outline-none"
                                            colorBg="bg-red-500" colorBgHover="hover:bg-red-700" colorTexto="text-red-500" colorBordeIcono="border-red-500"
                                            tipoIcono="delete" form="true" rutaHref="" idParamRuta=""/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-around mt-8">
            <div class="px-4 flex items-center justify-between border-gray-200 sm:px-6">
                <select wire:change="resetPaginaUno()" wire:model="por_pagina" class="form-input rounded-md my-2 mx-5">
                    <option value='' selected disabled>Mostrar por p&aacute;gina</option>
                    <option value="3">3 por p&aacute;gina</option>
                    <option value="9">9 por p&aacute;gina</option>
                    <option value="18">18 por p&aacute;gina</option>
                    <option value="24">24 por p&aacute;gina</option>
                    <option value="36">36 por p&aacute;gina</option>
                    <option value="99">99 por p&aacute;gina</option>
                </select>
                {{$productos->links('livewire.paginacion-personalizada')}}
            </div>
        </div>
        <!--AGREGAR PAGINACIÓN - NO FUNCIONABA -->
    @else
        <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
            <h1 class="flex justify-center | text-xl font-bold italic | mb-10">No tiene productos en venta</h1>
        </div>
    @endif
</div>
