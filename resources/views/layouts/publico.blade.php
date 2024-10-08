<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.svg') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/publico.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles/components/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles/components/notificaciones.css') }}">


    <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

    <!-- Titulo del sitio -->
    <title>@yield('titulo') - {{ config('app.name') }}</title>
</head>

<body>
    <main>
        @yield('contenido')
    </main>

    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
