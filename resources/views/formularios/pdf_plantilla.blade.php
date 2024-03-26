<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del formulario</title>
    <style>
        .logo {
            max-width: 200px;
            height: auto;
        }

        .datos {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <img class="logo" src="{{ asset('images/cofasa.svg') }}" alt="Logo">

    <div class="datos">
        <h1>Datos del formulario:</h1>
        <ul>
            <li><strong>Campo 1:</strong> {{ $data['campo1'] }}</li>
            <li><strong>Campo 2:</strong> {{ $data['campo2'] }}</li>
        </ul>
    </div>
</body>

</html>
