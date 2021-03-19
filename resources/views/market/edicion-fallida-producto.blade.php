<x-app-layout>
    @section('title')
        Editar producto
    @endsection

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
        <h2 class="flex font-semibold text-xl text-red-700 leading-tight justify-center py-6">
            {{ __('EDICIÓN FALLIDA') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mt-8">
        <h1 class="text-xl font-bold italic mb-10">No es posible editar productos que no han sido publicados por ti.</h1>
    </div>

    <a href="{{route('index-market')}}" class="flex justify-center">
        <button class="py-4 px-8 text-center bg-exp-azul hover:bg-blue-400 border border-transparent rounded-full font-bold text-md text-white uppercase tracking-widest active:bg-blue-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Volver a la p&aacute;gina principal de Market
        </button>
    </a>
</x-app-layout>
