<?php
$idUser = Auth::user()->id;
?>
<div>

    <x-slot name="logo">
    </x-slot>

    @livewire('perfil.galeria.artista.editar-datos', ['idUser' => $idUser])

</div>
