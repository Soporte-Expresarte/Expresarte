<div class="bg-white overflow-hidden shadow-xl sm:rounded">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div>
                @if (session()->has('success'))
                    <div class="my-4 p-3 bg-green-300 text-green-700 rounded shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            @if($eventos->count() != 0)
                <div class="flex w-full flex-col shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                Autor
                            </th>
                            <th class="text-center font-sans text-exp-azul">
                                Fecha de evento
                            </th>
                            <th class="text-center font-sans text-exp-azul">
                                Fecha de solicitud
                            </th>
                            <th class="text-center font-sans text-exp-azul">
                                Acción
                            </th>
                        </tr>
                        </thead>
                        @foreach ($eventos as $evento)
                            <tbody class="bg-white">
                            <tr>
                                <td class="w-1/6 mx-2 my-2 whitespace-nowrap">
                                    <p class="text-center">{{$evento->estado}}</p>
                                </td>
                                <td class="w-1/6 whitespace-nowrap">
                                    <a href="{{ route('show-evento', $evento->id) }}">
                                        <div class="mx-2 my-2 flex items-center">
                                            <div class="flex-shrink-0 h-20 w-20">
                                                <img class="h-20 w-20 rounded-full"
                                                     src="{{isset($evento->foto_portada)? asset($evento->foto_portada) : asset('images/imagen-default.jpg')}}"
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
                                <td class="w-1/6 mx-2 my-2 whitespace-nowrap">
                                    <p class="text-center">{{ $evento->usuario->name }} {{ $evento->usuario->apellido }}</p>
                                </td>
                                <td class="w-1/6 mx-2 my-2 whitespace-nowrap">
                                    <p class="text-center">{{$evento->fecha_evento}}</p>
                                </td>
                                <td class="w-1/6 mx-2 my-2 whitespace-nowrap">
                                    <p class="text-center">{{$evento->created_at}}</p>
                                </td>
                                <td class="m-4 whitespace-nowrap flex flex-col">
                                    <button class="font-bold bg-green-500 hover:bg-green-700 rounded-xl px-3 py-2 m-4"
                                            style="outline: 0px;" wire:click="aprobado({{ $evento }})">
                                        Aprobar
                                    </button>

                                    <button class="font-bold bg-red-500 hover:bg-red-700 rounded-xl px-3 py-2 m-4"
                                            style="outline: 0px;" wire:click="rechazado({{ $evento }})">
                                        Rechazar
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
                    <h1 class="flex justify-center | text-xl font-bold italic | mb-10">No hay eventos pendientes</h1>
                </div>
            @endif
            {{$eventos->links()}}
        </div>
    </div>
</div>
