<x-crowdfunding-layout>
    @section('content')
        @livewire('crowdfunding.listado-proyectos')
    @endsection

    @section('styles')
        <style>
            .max-h-c1{
                max-height: 30rem;
            }
        </style>
    @endsection
</x-crowdfunding-layout>