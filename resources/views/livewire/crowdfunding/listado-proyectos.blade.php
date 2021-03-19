<div class="my-8 mx-16">
    <div class="w-full grid grid-flow-row auto-rows-max">
        <div class="mx-auto w-1/3">
            <input wire:model.debounce.300ms="busqueda" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Buscar Título...">  
        </div>

        @foreach($proyectos as $proyecto)
            <div class="w-full grid grid-cols-5 gap-4 my-5 mx-8">
                <div class="col-span-5 h-auto mt-8 text-3xl font-semibold">
                    {{$proyecto['titulo']}}
                </div>

                <div class="col-span-3 flex flex-col mt-8">
                    <div class="mr-32">
                        <img src={{ asset($proyecto['imagen_portada']) }} class=" object-cover h-auto max-h-c1 w-full rounded-3xl">
                    </div>                            
                </div>

                <div class="col-span-2 flex flex-col mt-8">
                    <div class="my-auto mr-32">
                        <div>
                            <p class="text-justify text-lg">{{$proyecto['descripcion']}}</p>
                        </div>
                        <div class="w-full">
                            <div class="flex ">
                                <a href="{{ route('mostrar-proyecto',['id' => $proyecto->id])  }}" class=" no-underline hover:no-underline mx-auto ">
                                    <button class="bg-blue-300 hover:bg-yellow-400 font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider cursor-default focus:outline-none ">
                                        Ver más
                                    </button>
                                </a>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div><br>    
            <hr>
        @endforeach
        <br>
        {{ $proyectos->links() }}
        
    </div>
</div>
