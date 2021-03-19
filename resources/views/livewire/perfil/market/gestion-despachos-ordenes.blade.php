<div class="bg-white overflow-hidden shadow-xl sm:rounded">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex flex-row justify-around bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <input wire:model="busqueda_nombre" class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text" placeholder="Buscar nombre del destinatario...">
                <input wire:model="busqueda_apellido" class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text" placeholder="Buscar apellido del destinatario...">
                <input wire:model="busqueda_producto" class="flex flex-row justify-around form-input rounded-md shadow-sm mx-2" type="text" placeholder="Buscar producto...">
                <select wire:model="asc_desc" class="flex flex-row justify-around form-input rounded-md shadow-sm">
                    <option value='desc'>Fecha descendente</option>
                    <option value='asc'>Fecha ascendente</option>
                </select>
            </div>
            @if($productos->count())
                <table class="w-full table-fixed divide-y divide-gray-500">
                    <thead>
                        <tr>
                            <th class="w-4/12 text-center font-sans text-exp-azul">
                                Datos Destinatario
                            </th>
                            <th class="w-3/12 text-center font-sans text-exp-azul">
                                Producto a enviar
                            </th>
                            <th class="w-1/12 text-center font-sans text-exp-azul">
                                Cantidad
                            </th>
                            <th class="w-2/12 text-center font-sans text-exp-azul">
                                Fecha del pedido
                            </th>
                            <th class="w-2/12 text-center font-sans text-exp-azul">
                                Estado de envio
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-400">
                        @foreach($productos as $producto_y_despacho)
                            <tr>
                                <td class="w-4/12 whitespace-nowrap">
                                    <div class="my-4 mx-4 items-center">
                                        <div class="container">
                                            <p class="text-center font-bold">
                                                {{$producto_y_despacho->pais}},{{$producto_y_despacho->region}},{{$producto_y_despacho->comuna}}
                                            </p>
                                            <p class="text-center font-medium">
                                                {{$producto_y_despacho->calle}} {{$producto_y_despacho->numero_hogar}}
                                            </p>
                                            <p class="text-center font-medium">
                                                Destinatario: {{$producto_y_despacho->nombre_destinatario}} {{$producto_y_despacho->apellido_destinatario}}
                                            </p>
                                            <p class="text-center font-medium">
                                                Telefono contacto: {{$producto_y_despacho->celular_contacto}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-3/5 whitespace-nowrap">
                                    <div class="mx-2 my-2 flex items-center">
                                        <a href="{{ route('ver-producto', ['slug' => $producto_y_despacho->slug]) }}">
                                            <div class="flex-shrink-0 h-20 w-20">
                                                <img class="h-20 w-20 rounded-full" src="{{isset($producto_y_despacho->imagenes[0])? asset($producto_y_despacho->imagenes[0]->ruta) : asset('images/imagen-default.jpg')}}"
                                                alt="img-{{$producto_y_despacho->slug}}">
                                            </div>
                                        </a>
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-900">
                                                {{$producto_y_despacho->nombre}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-1/12 whitespace-nowrap">
                                    <p class="text-center font-medium">
                                        {{$producto_y_despacho->cantidad_comprada}}
                                    </p>
                                </td>
                                <td class="w-2/12 whitespace-nowrap">
                                    <p class="text-center">{{DateTime::createFromFormat('Y-m-d H:i:s',$producto_y_despacho->despacho_created_at)->format("d-m-Y H:i:s")}}</p>
                                </td>
                                <td class="w-2/12 whitespace-nowrap">
                                    <form method="PUT" class="flex justify-center" wire:submit.prevent="productoEnviado({{$producto_y_despacho->ordenes_productos_id}})">
                                        <x-utilidades.modal-confirmacion id="" titulo="Confirmar envio" tema="confirmar" estilosBoton=""
                                        clasesBoton="font-bold bg-green-500 hover:bg-green-700 rounded-xl px-3 py-2 m-4 normal-case focus:outline-none w-32"
                                        colorBg="bg-green-500" colorBgHover="hover:bg-green-700" colorTexto="text-green-500" colorBordeIcono="border-green-500"
                                        tipoIcono="check_circle" form="true" rutaHref="" idParamRuta=""/>
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
                        {{$productos->links("livewire.paginacion-personalizada")}}
                    </div>
                </div>
            @else
                <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
                    <p>No existen &oacute;rdenes de sus productos, prontamente le comprar&aacute;n productos</p>
                </div>
            @endif
        </div>
    </div>
</div>
