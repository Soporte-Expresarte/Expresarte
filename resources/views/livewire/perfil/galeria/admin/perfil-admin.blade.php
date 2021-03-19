<div class="mt-4">
    <div class="grid border-none outline-none grid-cols-2 font-sans text-white">
        <button type="button" wire:click="$set('vistaAdmin', 'aprobar-obras')"
                class="text-center @if ($vistaAdmin == "aprobar-obras") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-4 rounded-l-lg transition duration-500">
            Aprobar Obras
        </button>

        <button type="button" wire:click="$set('vistaAdmin', 'aprobar-eventos')"
                class="text-center @if ($vistaAdmin == "aprobar-eventos") bg-teal-400 hover:bg-teal-300 @else bg-teal-700 hover:bg-teal-600 @endif p-4 rounded-r-lg transition duration-500">
            Aprobar Eventos
        </button>
    </div>

    @if ($vistaAdmin == "aprobar-obras")
        <div class="mx-8">
            <div class="bg-white my-10"></div>
            <h2 class="text-xl font-bold text-gray-500">Aprobación de obras</h2>
            @livewire('perfil.galeria.admin.aprobar-obras')
        </div>
        <x-jet-section-border/>
    @elseif ($vistaAdmin == "aprobar-eventos")
        <div class="mx-8">
            <div class="bg-white my-10"></div>
            <h2 class="text-xl font-bold text-gray-500">Aprobación de eventos</h2>
            @livewire('perfil.galeria.admin.aprobar-eventos')
        </div>
        <x-jet-section-border/>
    @endif
</div>
