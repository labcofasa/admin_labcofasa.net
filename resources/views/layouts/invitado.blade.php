<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/invitado.css') }}">
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- Titulo del sitio -->
    <title>@yield('titulo') - {{ config('app.name') }}</title>
</head>

<body class="fondo">
    <main>
        @yield('contenido')
    </main>

    <!-- Scripts -->
    <script>
        var abiertoSvgUrl = "{{ asset('images/abierto.svg') }}";
        var cerradoSvgUrl = "{{ asset('images/cerrado.svg') }}";
    </script>
    <script src="{{ asset('js/formulario.js') }}"></script>

</body>

</html>
