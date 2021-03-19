<x-market-layout>
    @section('title')
        Crear Promoción
    @endsection

    @section('market_styles')
        <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
        <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">
    @endsection

    @section('content')

        @livewire('market.form-create-promocion')

    @endsection
</x-market-layout>
