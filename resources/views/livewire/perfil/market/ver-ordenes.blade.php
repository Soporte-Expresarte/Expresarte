<div class="container justify-center">
    @if($ordenes->count() != 0)
        @foreach ($ordenes as $orden)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-15 items-center mb-4">
                <div class="bg-white | p-4 | shadow-md | border | relative | mb-4">
                    <h4 class="text-2xl font-black | mb-4">DETALLE DE ORDEN N°{{$orden->id}}</h4>
                    <p class="font-bold">Fecha: {{$orden->created_at = date("d-m-Y")}}</p>
                    <p class="font-bold">Nombre: {{$orden->despacho->nombre}}</p>
                    <p class="font-bold">Apellido: {{$orden->despacho->apellido}}</p>
                    <p class="font-bold">Calle: {{$orden->despacho->calle}}</p>
                    <p class="font-bold">N&uacute;mero: {{$orden->despacho->numero_hogar}}</p>
                    <p class="font-bold">Comuna: {{$orden->despacho->comuna}}</p>
                    <p class="font-bold">Regi&oacute;n: {{$orden->despacho->region}}</p>
                    <p class="font-bold">Pa&iacute;s: {{$orden->despacho->pais}}</p>
                    <p class="font-bold">Celular: {{$orden->despacho->celular}}</p>
                    <x-jet-section-border/>
                        <div class="grid grid-cols-2">
                            <p class="flex text-lg font-bold">Monto total</p>

                            <p class="flex justify-end text-lg font-bold">${{number_format($orden->monto_total, 0, ",", ".")}}</p>

                        </div>
                </div>
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="flex flex-col shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="table-fixed divide-y divide-gray-500 border">
                                <thead>
                                <tr>
                                    <th class="text-center font-sans text-exp-azul">
                                        Producto
                                    </th>
                                    <th class="text-center font-sans text-exp-azul">
                                        Cantidad
                                    </th>
                                    <th class="text-center font-sans text-exp-azul">
                                        Precio
                                    </th>
                                    <th class="text-center font-sans text-exp-azul">
                                        Estado
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($orden->productos as $producto)
                                        <tr>
                                            <td class="w-2/5 whitespace-nowrap">
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
                                            <td class="w-1/5 mx-2 my-2 whitespace-nowrap">
                                                <p class="text-center">{{$producto->pivot->cantidad}}</p>
                                            </td>
                                            <td class="w-1/5 mx-2 my-2 whitespace-nowrap">
                                                <p class="text-center">${{number_format($producto->precio, 0, ",", ".")}}</p>
                                            </td>
                                            <td class="w-1/5 mx-2 my-2 whitespace-nowrap">
                                                <p class="text-center">{{$producto->pivot->enviado == 0 ? "NO ENVIADO" : "ENVIADO"}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="w-full flex justify-around mt-8">
            <div class="px-4 flex items-center justify-between border-gray-200 sm:px-6">
                {{$ordenes->links('livewire.paginacion-personalizada', ['elemento' => "orden"])}}
            </div>
        </div>
    @else
        <div class="px-4 py-3 flex justify-center border-gray-200 sm:px-6">
            <h1 class="text-xl font-bold italic | mb-10">No has realizado ninguna compra todav&iacute;a. &iexcl;Ve y compra algo asombroso!</h1>
        </div>
    @endif
</div>
