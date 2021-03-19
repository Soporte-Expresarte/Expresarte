<x-market-layout>
    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset("css/expresarte.css") }}">

    @section("content")

        @livewire("market.reportar-producto-form", ['id' => $id])

    @endsection
</x-market-layout>
