<x-app-layout>
    @section('title')
        Crowdfunding
    @endsection

    <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
    <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
    </x-slot>

    @yield("content")


    <!-- mostrar solos 5 segundos los mensajes de confirmacion -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function () {
                    $(".desaparece_5_segs").fadeOut(1500);
                }, 5000);

                setTimeout(function () {
                    $(".content2").fadeIn(1500);
                }, 6000);
            });
        </script>

</x-app-layout>
