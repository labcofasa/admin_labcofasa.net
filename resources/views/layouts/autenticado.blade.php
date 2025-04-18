<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="manifest" href="/manifest.json">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/autenticado.css') }}">
        @stack('styles')

        <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/graficas/chart.js') }}"></script>
        

        <!-- Titulo del sitio -->
        <title>@yield('titulo')</title>
        {{-- @laravelPWA --}}
    </head>

    <body>
        <header class="side-menu">
            <div class="sidebar-bg"></div>
            <x-sidebar-desktop />
        </header>
        <x-navbar :usuario="$usuario" />

        <main class="main-content">
            @yield('contenido')
        </main>

        <!-- Scripts -->
        @stack('scripts')
        <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>

</html>
