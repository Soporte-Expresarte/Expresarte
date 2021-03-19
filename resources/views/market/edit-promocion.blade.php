<x-market-layout>
    @section('title')
        Editar Promoción
    @endsection

    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">
    @endsection

    @section('content')

        @livewire('market.edit-promocion', [
        'id_promo' => $id_promo
        ])

    @endsection
</x-market-layout>
