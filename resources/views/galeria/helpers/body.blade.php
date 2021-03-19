<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expresarte - @yield('title_head')</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>

<x-galeria-layout>
    @section('content')

        <header>
            @include('galeria.helpers.navbar')
        </header>

        <main>
            @yield('content_body')
        </main>

    @endsection
</x-galeria-layout>

@livewireScripts

<!-- mostrar solos 5 segundos los mensajes de confirmacion -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $(".desaparece_5_segs").fadeOut(1500);
        }, 5000);

        setTimeout(function () {
            $(".content2").fadeIn(1500);
        }, 6000);
    });
</script>

</body>
</html>
