<x-crowdfunding-layout>
    @section('content')

        @livewire('crowdfunding.escoger-premios-component', ['proyecto' => $proyecto,'despacho' => $despacho])

    @endsection
</x-crowdfunding-layout>