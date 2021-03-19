<div x-data="{mostrarModal:false}" x-bind:class="{ 'model-open': mostrarModal }">
            
    <div>
        <button {{$id != "" ? "id='$id'" : ""}} @click={mostrarModal=true} type="button" class="{{$clasesBoton}}" style="{{$estilosBoton}}">
            {{$titulo}}
        </button>
    </div>
    
    <template x-if="mostrarModal">
        <div
            class="bottom-0 left-0 right-0 z-40 my-auto top-96 fixed | w-full h-full overflow-auto">
            <div class="relative z-50 p-3 mx-auto my-0 | max-w-full" style="width: 500px;">
                <div class="flex flex-col | px-10 py-10 | overflow-hidden | bg-white | border rounded shadow-lg">
                    <div class="text-center">
                        <span
                            class="p-4 | font-bold {{$colorTexto}} | border-2 | {{$colorBordeIcono}} | rounded-full material-icons">
                            {{$tipoIcono}}
                        </span>
                    </div>
                    <div class="py-6 | text-2xl text-center font-bold text-gray-700">&iquest;Estás seguro?</div>
                    <div class="mb-8 | font-light text-center text-gray-700">
                        <p>
                            Recuerde que luego de {{$tema}}, el cambio es permanente.
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <button @click={mostrarModal=false} type="button"
                            class="px-6 py-2 mx-1 | text-gray-900 | bg-gray-300 hover:bg-gray-500 | rounded focus:outline-none">
                            Cancelar
                        </button>

                        @if ($form)
                            <button type="submit" @click={mostrarModal=false}
                            class="px-6 py-2 mx-1 | text-gray-200 | {{$colorBg}} {{$colorBgHover}} | rounded focus:outline-none">{{ucfirst($tema)}}</button>
                        @else
                            <a href="{{ route($rutaHref, ['id' => $idParamRuta]) }}">
                                {{--href="{{ route('aprobar-proyecto',['id' => $proyecto->id]) }}"--}}
                                <button type="submit"
                                    class="px-6 py-2 mx-1 | text-gray-200 | {{$colorBg}} {{$colorBgHover}} | rounded focus:outline-none">{{ucfirst($tema)}}</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <button type="button" @click={mostrarModal=false} class="fixed top-0 bottom-0 left-0 right-0 z-40 | w-full h-full overflow-auto | bg-black opacity-50"></button>
        </div>
    </template>

</div>