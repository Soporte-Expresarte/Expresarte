<div class="mt-4">
    <div class="grid border-none outline-none grid-cols-3 font-sans text-white">
        <button type="button" wire:click="$set('vistaArtista', 'datos-artista')"
                class="text-center @if($vistaArtista == "datos-artista") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-4 rounded-l-lg transition duration-500">
            Datos Artista
        </button>

        <button type="button" wire:click="$set('vistaArtista', 'obras')"
                class="text-center @if($vistaArtista == "obras") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-4 transition duration-500">
            Obras
        </button>

        <button type="button" wire:click="$set('vistaArtista', 'eventos')"
                class="text-center @if($vistaArtista == "eventos") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-4 rounded-r-lg transition duration-500">
            Eventos
        </button>
    </div>

    @if ($vistaArtista == "datos-artista")
        @livewire('perfil.galeria.artista.datos-artista')

    @elseif ($vistaArtista == "obras")
        <div class="mx-8">
            <div class="bg-white my-10"></div>
            <h2 class="text-xl font-bold text-gray-500">Tus obras</h2>
            @livewire('perfil.galeria.artista.obras-artista')
        </div>
        <x-jet-section-border/>

    @elseif ($vistaArtista == "eventos")
        <div class="mx-8">
            <div class="bg-white my-10"></div>
            <h2 class="text-xl font-bold text-gray-500">Tus eventos</h2>
            @livewire('perfil.galeria.artista.eventos-artista')
        </div>
        <x-jet-section-border/>
    @endif
</div>
