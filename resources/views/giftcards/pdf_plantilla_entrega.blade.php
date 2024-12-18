<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Recibo PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid black;
            text-align: left;
            padding: 2px;
        }
        table th {
            background-color: #f2f2f2;
        }
        .totals {
            text-align: right;
        }
        .signature {
            justify-content: space-between;
            align-items: center;
        }
        .signature .line {
            width: 25%;
            display: inline-block;
            border-top: 1px solid black;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin: 2px 0;">Recibo {{\Carbon\Carbon::parse($fechaMovimiento)->format('d')}}{{\Carbon\Carbon::parse($fechaMovimiento)->format('m')}}{{\Carbon\Carbon::parse($fechaMovimiento)->format('Y')}}-{{$idVendedor}}{{$idAgrupacion}}
    </h1>
    <p style="margin: 2px 0;"><strong>Fecha de Emisión:</strong> {{ \Carbon\Carbon::parse($fechaMovimiento)->format('d/m/Y') }}</p> 
    <p style="margin: 2px 0;"><strong>Entrega a:</strong> {{ $nombreVendedor }}</p>
    <h3>Detalles de Gift Cards entregadas:</h3>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;"><strong>Comprobante</strong></th>
                <th style="text-align: center;"><strong>Denominación</strong></th>
                <th style="text-align: center;"><strong>Cantidad</strong></th>
                <th style="text-align: center;"><strong>Total</strong></th>
            </tr>
        </thead>
        @php
            $subtotal = 0;
        @endphp
        <tbody>
            @foreach ($movimientos as $movimiento)
            @php
                $subtotal += $movimiento['valorMovimiento'];
            @endphp
            <tr>
                <td>{{ $movimiento['Correlativo'] }}</td>
                <td style="text-align: right;">${{ $movimiento['valorUnitario'] }}</td>
                <td style="text-align: right;">{{ $movimiento['cantidad'] }}</td>
                <td style="text-align: right;">${{ $movimiento['valorMovimiento'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        <p class="totals" style="margin:0;"><strong>Total Recibo:</strong> ${{ $subtotal }}</p>       
        <hr style="width:35%">
        Firma<strong>   Puesto:</strong> {{ $cargoVendedor }} {{$numeroVendedorString}}
    </body>
</html>
