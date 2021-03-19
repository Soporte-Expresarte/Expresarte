<div class="border">
    <h2 class="pt-12 pl-12 text-xl font-bold text-gray-600">{{ $categoria_id != "" ? "Categoría: $categoria_nombre" : "Búsqueda: $busqueda"}}</h2>

    <div class="flex flex-col md:flex-row justify-around p-12">
        <select name="tema_id" wire:model="tema_id" class="form-input rounded-md shadow-sm">
            <option value="" selected>Todos los Temas</option>
            @foreach ($temas as $t)
                <option value={{$t->id}}>{{$t->nombre}}</option>
            @endforeach
        </select>
        @if($this->busqueda == "")
        <input wire:keydown.enter="render" wire:model="busqueda_nombre_producto" class="form-input rounded-md shadow-sm" type="text" placeholder="Buscar producto...">
        <input wire:keydown.enter="render" wire:model="busqueda_nombre_artista" class="form-input rounded-md shadow-sm" type="text" placeholder="Buscar artista...">
        @endif
        <select name="ordenamiento" wire:model="ordenamiento" class="form-input rounded-md shadow-sm">
            <option value="" selected>Ordenar por</option>
            <option value="precioAsc">Precio m&aacute;s bajo</option>
            <option value="precioDesc">Precio m&aacute;s alto</option>
            <option value="stockAsc">Stock m&aacute;s bajo</option>
            <option value="stockDesc">Stock m&aacute;s alto</option>
        </select>
    </div>

    @if(!$productos->count())
        <div class="w-full flex justify-center font-bold p-12">
            <p>No hay resultados para la búsqueda @if(!empty($busqueda_nombre_producto)) '{{$busqueda_nombre_producto}}'@endif @if(!empty($busqueda_nombre_artista)) del artista '{{$busqueda_nombre_artista}}'@endif en @if(!empty($tema_id)) '{{$tema_nombre}}'@else ningun tema.@endif</p>
        </div>
    @else
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 justify-items-center">
            @foreach($productos as $producto)
                        <div class="flex flex-col justify-around transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                            <a href="{{ route('ver-producto', ['slug' => $producto->slug]) }}">
                                <div class="flex flex-col items-center">
                                    <img class="object-contain h-96 w-96 md:object-scale-down lazyload" id={{$producto->id}}
                                    src="{{isset($producto->imagenes[0])? asset($producto->imagenes[0]->ruta) : asset('images/imagen-default.jpg')}}"
                                    alt="img-{{$producto->slug}}">
                                    <p class="w-96 text-center leading-5 font-bold">{{$producto->nombre}}</p>
                                    <p class="text-center leading-5 font-bold">Artista: {{$producto->artista->name}}</p>
                                    <p class="text-center leading-5 font-medium">${{number_format($producto->precio, 0, ",", ".")}} CLP</p>
                                </div>
                            </a>
                        </div>
            @endforeach
        </div>
        <div class="mt-12 border-t">
            <div class="w-full flex justify-around py-8">
                <select wire:change="resetPaginaUno()" wire:model="por_pagina" class="form-input rounded-md">
                    <option value='' selected disabled>Mostrar por página</option>
                    <option value="3">3 por página</option>
                    <option value="9">9 por página</option>
                    <option value="18">18 por página</option>
                    <option value="24">24 por página</option>
                    <option value="36">36 por página</option>
                    <option value="99">99 por página</option>
                </select>
                <div class="px-4 flex items-center justify-between border-gray-200 sm:px-6">
                    {{ $productos->links("livewire.paginacion-personalizada") }}
                </div>
            </div>
        </div>
    @endif

</div>
