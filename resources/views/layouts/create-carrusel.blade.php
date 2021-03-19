@extends('galeria.helpers.body')

@section('title_head', 'Crear Carrusel')

@section('content_body')

    @livewire('utilidades.crear-carruseles',
    ['id' => $id])

@endsection
