<x-app-layout>
    @section('title')
        Editar producto
    @endsection

    @section('styles')
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @endsection

    @section("navbar")
        @livewire('utilidades.general-navbar', ['background' => 'bg-gray-800', 'colorNavLinks' => 'text-white'])
    @endsection

    <x-slot name="header">
    </x-slot>

    @livewire('market.formulario-edicion-producto', ['slug' => $slug])

</x-app-layout>

<script>
    Livewire.on('marcarImagenes', imagenesParaBorrar => {
        // Por cada imagen definida para ser borrada, se le agrega la clase opacity-50.
        imagenesParaBorrar.forEach(imagen => {
            let imagenProducto = document.getElementById(imagen.id);
            let botonBorrar = document.getElementById(`borrar${imagen.id}`);
            botonBorrar.innerHTML = "X";
            imagenProducto.classList.add("opacity-50");

        });
    });
</script>
