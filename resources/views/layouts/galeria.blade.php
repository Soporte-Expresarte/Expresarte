<x-app-layout>

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
        @livewire("galeria.inicio-espacio")
    </x-slot>

    @yield("content")

</x-app-layout>
