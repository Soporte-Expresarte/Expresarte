<x-market-layout>
    @section('title')
        Carrito
    @endsection

    @section("market_styles")
        <link rel="stylesheet" href="{{ asset("css/expresarte.css")}}">
        <link rel="stylesheet" href="{{ asset("css/market/loaderCarrito.css")}}">
    @endsection

    @section("content")
        <div>
            @livewire("market.productos-carrito")
        </div>
    @endsection

</x-market-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset("js/market/loaderCarrito.js") }}"></script>
