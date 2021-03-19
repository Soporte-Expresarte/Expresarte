@extends('galeria.helpers.body')

@section('title_head', 'Registrar artista')

@section('content_body')

    <div class="bg-gray-100 pb-16 pt-10">
        <x-jet-authentication-card>
            <div>
                @if (session()->has('success'))
                    <div class="my-4 p-3 bg-green-300 text-green-700 rounded shadow-sm">
                        {{ session('success') }} ✔️
                    </div>
                @endif
            </div>

            <x-slot name="logo"></x-slot>

            <x-jet-validation-errors class="mb-4"/>

            @livewire('formulario-registro')

        </x-jet-authentication-card>
    </div>

@endsection
