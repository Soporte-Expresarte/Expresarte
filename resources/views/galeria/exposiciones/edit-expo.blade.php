@extends('galeria.helpers.body')

@section('title_head', 'Editar Exposiciones')


@section('content_body')

    @livewire('galeria.edit-exposiciones', [
    'id'=>$id
    ])

@endsection
