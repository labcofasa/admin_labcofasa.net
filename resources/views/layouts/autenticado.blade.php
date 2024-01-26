<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style-main.css') }}">
        <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

        <!-- Titulo del sitio -->
        <title>@yield('titulo') - {{ config('app.name') }}</title>
    </head>

    <body>
        <header class="side-menu">
            <x-sidebar-desktop />
        </header>
        <x-navbar :usuario="$usuario" />

        <main class="main-content">
            @yield('contenido')
        </main>

        <!-- Scripts -->
        <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>

</html>
