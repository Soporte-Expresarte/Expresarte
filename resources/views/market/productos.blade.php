<x-market-layout>
    @section('market_styles')
        <link rel="stylesheet" href="{{ asset("css/expresarte.css")}}">
    @endsection

    @section("content")
        @livewire('market.grid-productos', ['slug' => isset($slug) ? $slug : "", 'busqueda' => isset($busqueda) ? $busqueda : ""])
    @endsection

</x-market-layout>