<div class="justify-center">
    @if($eventos->count() != 0)
        <div class="flex flex-col shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="table-fixed divide-y divide-gray-500">
                <thead>
                <tr>
                    <th class="text-center font-sans text-exp-azul">
                        Estado
                    </th>
                    <th class="text-center font-sans text-exp-azul">
                        Título
                    </th>
                    <th class="text-center font-sans text-exp-azul">
                        Fecha de evento
                    </th>
                    <th class="text-center font-sans text-exp-azul">
                        Fecha de solicitud
                    </th>
                </tr>
                </thead>
                @foreach ($eventos as $evento)
                    <tbody class="bg-white">
                        <tr>
                            <td class="w-1/4 mx-2 my-2 whitespace-nowrap">
                                <p class="text-center">{{$evento->estado}}</p>
                            </td>
                            <td class="w-1/4 whitespace-nowrap">
                                <a href="{{ route('show-evento', $evento->id) }}">
                                    <div class="mx-2 my-2 flex items-center">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            <img class="h-20 w-20 rounded-full" src="{{isset($evento->foto_portada)? asset($evento->foto_portada) : asset('images/imagen-default.jpg')}}"
                                            alt="img-{{$evento->slug}}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-900">
                                                {{$evento->titulo}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td class="w-1/4 mx-2 my-2 whitespace-nowrap">
                                <p class="text-center">{{$evento->fecha_evento}}</p>
                            </td>
                            <td class="w-1/4 mx-2 my-2 whitespace-nowrap">
                                <p class="text-center">{{$evento->created_at}}</p>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    @else
        <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
            <h1 class="flex justify-center | text-xl font-bold italic | mb-10">No tiene eventos creados</h1>
        </div>
    @endif
    {{ $eventos->links() }}
</div>
