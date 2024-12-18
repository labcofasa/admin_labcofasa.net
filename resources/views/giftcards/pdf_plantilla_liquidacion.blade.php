<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Liquidacion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .tabla-con-borde th, .tabla-con-borde td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        /* Tabla sin bordes */
        .tabla-sin-borde th, .tabla-sin-borde td {
            border: none;  /* Sin bordes */
            text-align: left;
            padding: 8px;
        }
        table th {
            background-color: #f2f2f2;
        }

        .totals {
            text-align: right;
            margin-top: 10px;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt; /* Aquí puedes ajustar el tamaño, por ejemplo a 10pt */
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Control de paquetes patrocinios</h2>
    <table class="tabla-sin-borde">
        <tr>
            <td style="padding: 2px 0; width: 50%;"><strong>Código de cliente:</strong> {{ $data['codigoCliente'] }}</td>
            <td style="padding: 2px 0; width: 50%;"><strong>Colaborador responsable:</strong> {{ $data['nombreVendedor'] }}</td>
        </tr>
        <tr>
            <td style="padding: 2px 0; width: 50%;"><strong>Nombre de Cliente:</strong> {{ $data['nombreCliente'] }}</td>
            <td style="padding: 2px 0; width: 50%;"><strong>Fecha de Liquidación:</strong> {{ \Carbon\Carbon::parse($data['fechaMovimiento'])->format('d/m/Y') }}</td>
        </tr>
    </table>
    <br>
    <br>
    <table class="tabla-con-borde">
        <thead>
            <tr>
                <th style="text-align: center; width: 15%;">Código Productos</th>
                <th style="text-align: center; width: 70%;">Productos</th>
                <th style="text-align: center; width: 15%;">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalUnidades = 0;
            @endphp
            @foreach ($data['movimientos'] as $movimiento)
                @php
                    $totalUnidades += $movimiento['cantidadArticulo'];
                @endphp
                <tr>
                    <td style="text-align: center; width: 15%;">{{ $movimiento['codigoArticulo'] }}</td>
                    <td style="text-align: center; width: 70%;">{{ $movimiento['Articulo'] }}</td>
                    <td style="text-align: right; width: 15%;">{{ $movimiento['cantidadArticulo'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table class="tabla-sin-borde">
        <tr>
            <td style="text-align: left; margin-top: 10px;"><strong>Gift Card a Liquidar</strong>  ${{ $data['valorMovimiento'] }}</td>
            <td style=" text-align: right; margin-top: 10px;"><strong>Total de Unidades:</strong> {{ $totalUnidades }}</td>
        </tr>
    </table>
    <br>
    <br>
    <hr style="width:35%">
        Firma<strong>  

</body>
</html>
