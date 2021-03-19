@extends('galeria.helpers.body')

@section('title_head', 'Editar Evento')

@section('content_body')

    @livewire('galeria.form-edit-evento', ['evento' => $evento])

@endsection
