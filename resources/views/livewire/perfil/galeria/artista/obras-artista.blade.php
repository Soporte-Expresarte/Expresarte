<div class="justify-center">
    @if($obras->count() != 0)
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
                        Fecha de solicitud
                    </th>
                </tr>
                </thead>
                @foreach ($obras as $obra)
                    <tbody class="bg-white">
                        <tr>
                            <td class="w-1/3 mx-2 my-2 whitespace-nowrap">
                                <p class="text-center">{{$obra->estado}}</p>
                            </td>
                            <td class="w-1/3 whitespace-nowrap">
                                <a href="{{ route('show-obra', $obra) }}">
                                    <div class="mx-2 my-2 flex items-center">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            <img class="h-20 w-20 rounded-full" src="{{isset($obra->imagenes->first()->ruta)? asset($obra->imagenes->first()->ruta): asset('images/imagen-default.jpg')}}"
                                            alt="img-{{$obra->slug}}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-900">
                                                {{$obra->titulo}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td class="w-1/3 mx-2 my-2 whitespace-nowrap">
                                <p class="text-center">{{$obra->created_at}}</p>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    @else
        <div class="px-4 py-3 flex items-center justify-between border-gray-200 sm:px-6">
            <h1 class="flex justify-center | text-xl font-bold italic | mb-10">No tiene obras subidas</h1>
        </div>
    @endif
    {{ $obras->links() }}
</div>
