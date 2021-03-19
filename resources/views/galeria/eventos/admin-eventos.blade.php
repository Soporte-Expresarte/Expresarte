@extends('galeria.helpers.body')

@section('title_head', 'Administrar Eventos')


@section('content_body')

    @livewire('galeria.admin-eventos', ['eventos' => $eventos])

@endsection
