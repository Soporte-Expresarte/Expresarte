<div class="block">
    <style>
        .limitlines1 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
    </style>

    @if($aux > 3)
        @if($la_sesion->with_cookies == 'NO')
            <div
                class="p-3 fixed bottom-0 inset-x-0 bg-green-500 text-center text-sm text-white @if($la_sesion->with_cookies == 'SI') hidden @endif">
                <div class="inline-block">
                    Los cookies para este sitio benefician únicamente la navegabilidad. No guardamos ni utilizamos tus
                    datos involuntariamente.
                </div>

                <a class="px-3 text-gray-200 hover:text-white transition duration-500 py-2 underline inline-block"
                   href="{{ route('politicas-privacidad') }}">
                    Más información
                </a>

                <button type="button" wire:click="aceptar"
                        class="bg-yellow-300 hover:bg-yellow-200 transition duration-500 inline-block  text-gray-800 px-3 py-2 rounded-lg mx-auto">
                    Aceptar
                </button>
            </div>
        @else
            <div class=""></div>
        @endif
    @else
        <div wire:poll="loadView"></div>
    @endif

</div>
