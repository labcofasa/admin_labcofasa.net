<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulario PDF</title>
    <style>
        .titulo {
            text-align: center;
            margin-bottom: 20px;
        }

        .subtitulo {
            font-size: 13px;
            margin-bottom: 30px;
        }

        .datos {
            font-size: 10px;
        }

        .tabla {
            margin: 0 0 10px 0;
        }
    </style>
</head>

<body>
    <img src="images/pdfcofasalogo.png" width="100" height="50">
    <h2 class="titulo">Formulario Conozca a su Cliente y Contraparte</h2>
    <h6 class="subtitulo">A. Información persona natural - representante legal</h6>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Tipo de persona</th>
                <th class="datos">Nombre</th>
                <th class="datos">Fecha de nacimiento</th>
                <th class="datos">Nacionalidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos">{{ $tipo_persona }}</td>
                <td class="datos">{{ $nombre }} {{ $apellido }}</td>
                <td class="datos">{{ $fecha_de_nacimiento }}</td>
                <td class="datos">{{ $nacionalidad }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">País</th>
                <th class="datos">Departamento</th>
                <th class="datos">Municipio</th>
                <th class="datos">Profesión u oficio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $pais }}</td>
                <td class="datos" scope="col">{{ $departamento }}</td>
                <td class="datos" scope="col">{{ $municipio }}</td>
                <td class="datos" scope="col">{{ $profesion_u_oficio }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Tipo de documento</th>
                <th class="datos">Número de documento</th>
                <th class="datos">Fecha de vencimiento</th>
                <th class="datos">Registro NRC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $tipo_de_documento }}</td>
                <td class="datos" scope="col">{{ $numero_de_documento }}</td>
                <td class="datos" scope="col">{{ $fecha_de_vencimiento }}</td>
                <td class="datos" scope="col">{{ $registro_iva_nrc }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Actividad económica</th>
                <th class="datos">Teléfono</th>
                <th class="datos">Correo electrónico</th>
                <th class="datos">Fecha de nombramiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $giro }}</td>
                <td class="datos" scope="col">{{ $telefono }}</td>
                <td class="datos" scope="col">{{ $email }}</td>
                <td class="datos" scope="col">{{ $fecha_de_nombramiento }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $direccion }}</td>
            </tr>
        </tbody>
    </table>
    <h6 class="subtitulo">B. Información persona jurídica</h6>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre comercial</th>
                <th class="datos">Tipo de contribuyente</th>
                <th class="datos">Nacionalidad</th>
                <th class="datos">Número de NIT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $nombre_comercial_juridico }}</td>
                <td class="datos" scope="col">{{ $clasificacion }}</td>
                <td class="datos" scope="col">{{ $nacionalidad_juridico }}</td>
                <td class="datos" scope="col">{{ $numero_de_nit_juridico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Actividad económica</th>
                <th class="datos">Fecha de constitución</th>
                <th class="datos">Número de registro NRC</th>
                <th class="datos">País</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $giro_juridico }}</td>
                <td class="datos" scope="col">{{ $fecha_de_constitucion_juridico }}</td>
                <td class="datos" scope="col">{{ $registro_nrc_juridico }}</td>
                <td class="datos" scope="col">{{ $pais_juridico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Departamento</th>
                <th class="datos">Municipio</th>
                <th class="datos">Sitio web</th>
                <th class="datos">Número de FAX</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $departamento_juridico }}</td>
                <td class="datos" scope="col">{{ $municipio_juridico }}</td>
                <td class="datos" scope="col">{{ $sitio_web_juridico }}</td>
                <td class="datos" scope="col">{{ $numero_de_fax_juridico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $direccion_juridico }}</td>
            </tr>
        </tbody>
    </table>
    <h6 class="subtitulo">C. Información de la administración, sus accionistas o miembros</h6>
    {{-- <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre</th>
                <th class="datos">Nacionalidad</th>
                <th class="datos">No. Identidad</th>
                <th class="datos">Porcentaje de participación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $nombre_accionista }}</td>
                <td class="datos" scope="col">{{ $nacionalidad_accionista }}</td>
                <td class="datos" scope="col">{{ $numero_identidad_accionista }}</td>
                <td class="datos" scope="col">{{ $porcentaje_participacion_accionista }}</td>
            </tr>
        </tbody>
    </table> --}}
    <h6 class="subtitulo">D. Información de Personas Expuestas Políticamente - PEP's</h6>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre</th>
                <th class="datos">Nombre del cargo</th>
                <th class="datos">Fecha de nombramiento</th>
                <th class="datos">Período de nombramiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $nombre_politico }}</td>
                <td class="datos" scope="col">{{ $nombre_cargo_politico }}</td>
                <td class="datos" scope="col">{{ $fecha_hasta_politico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">País donde ejerce/ejerció el cargo</th>
                <th class="datos">Departamento</th>
                <th class="datos">Municipio</th>
                <th class="datos">Nombre del cliente / proveedor Directo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $pais_politico }}</td>
                <td class="datos" scope="col">{{ $departamento_politico }}</td>
                <td class="datos" scope="col">{{ $municipio_politico }}</td>
                <td class="datos" scope="col">{{ $nombre_cliente_politico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">País donde ejerce/ejerció el cargo</th>
                <th class="datos">Porcentaje de participación</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $pais_politico }}</td>
                <td class="datos" scope="col">{{ $porcentaje_participacion_politico }}</td>
            </tr>
        </tbody>
    </table>
</body>


</html>
