<x-app-layout>
    @section('title')
        Crear producto
    @endsection

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
    </x-slot>

    @livewire('market.formulario-creacion-producto')

</x-app-layout>
