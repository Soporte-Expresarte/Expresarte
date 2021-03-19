@extends('galeria.helpers.body')

@section('title_head', 'Crear Noticia')

@section('content_body')

    @livewire('galeria.admin-noticias', [
    'action'=>$action
    ])

@endsection
