@extends('galeria.helpers.body')

@section('title_head', 'Crear Obra')

@section('content_body')

    @livewire('galeria.admin-obras', [
    'action'=>$action
    ])

@endsection
