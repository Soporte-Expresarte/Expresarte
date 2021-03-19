<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom Tailwind -->
    <link href="https://unpkg.com/tailwindcss@^1/dist/tailwind.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fuentes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/expresarte.css') }}">

    @yield('styles')

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased static">
<div class="min-h-screen bg-white">
@yield("navbar")

{{-- <x-general-navbar fondo="bg-exp-naranja"/> --}}

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

</div>

<!-- sobre las politicas de privacidad -->
<!-- @livewire('modal-aviso-privacidad') -->

<x-utilidades.footer/>

@stack('modals')

@livewireScripts
</body>
</html>
