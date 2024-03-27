<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulario PDF</title>
    <style>
        .logo {
            margin-top: 0;
            text-align: center;
        }

        .titulo {
            text-align: center;
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

        .firma {
            border: none;
            width: 30%;
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body>
    <img src="images/pdfcofasalogo.png" width="150" height="75">
    <h2 style="text-align: center">Formulario Conozca a su Cliente y Contraparte</h2>
    <p class="datos">Compañía Farmacéutica S.A. de C.V. reconoce el firme compromiso con el cumplimiento integral de
        las normativas
        legales vigentes. Por ello, se compromete en la aplicación de las buenas prácticas de "Conozca a su Cliente y
        Contraparte", de acuerdo con los Arts. 9-B, 10 literal A, Romano I y II de la Ley Contra el Lavado de Dinero y
        de Activos, y el Art. 4 del Reglamento de la Ley.
    </p>
    <table>
        <thead>
            <tr>
                <th></th>
                <th class="datos">Fecha de generación</th>
                <th class="datos">Vigencia: dic-23</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td class="datos">{{ $fecha_generacion }}</td>
                <td class="datos">Versión: 1</td>
            </tr>
        </tbody>
    </table>
    <h6 class="subtitulo">A. Información persona natural - representante legal</h6>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Tipo</th>
                <th class="datos">Tipo de persona</th>
                <th class="datos">Nombre</th>
                <th class="datos">Fecha de nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos">{{ $tipo }}</td>
                <td class="datos">{{ $tipo_persona }}</td>
                <td class="datos">{{ $nombre }} {{ $apellido }}</td>
                <td class="datos">{{ $fecha_de_nacimiento }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nacionalidad</th>
                <th class="datos">País</th>
                <th class="datos">Departamento</th>
                <th class="datos">Municipio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos">{{ $nacionalidad }}</td>
                <td class="datos" scope="col">{{ $pais }}</td>
                <td class="datos" scope="col">{{ $departamento }}</td>
                <td class="datos" scope="col">{{ $municipio }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Profesión u oficio</th>
                <th class="datos">Tipo de documento</th>
                <th class="datos">Número de documento</th>
                <th class="datos">Fecha de vencimiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $profesion_u_oficio }}</td>
                <td class="datos" scope="col">{{ $tipo_de_documento }}</td>
                <td class="datos" scope="col">{{ $numero_de_documento }}</td>
                <td class="datos" scope="col">{{ $fecha_de_vencimiento }}</td>
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
                <th class="datos">Registro NRC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $giro }}</td>
                <td class="datos" scope="col">{{ $telefono }}</td>
                <td class="datos" scope="col">{{ $email }}</td>
                <td class="datos" scope="col">{{ $registro_iva_nrc }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Fecha de nombramiento</th>
                <th class="datos">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $fecha_de_nombramiento }}</td>
                <td class="datos" scope="col">{{ $direccion }}</td>
            </tr>
        </tbody>
    </table>
    <br>
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
                <th class="datos">Teléfono</th>
                <th class="datos">Dirección</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $telefono_juridico }}</td>
                <td class="datos" scope="col">{{ $direccion_juridico }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <h6 class="subtitulo">C. Información de la administración, sus accionistas o miembros</h6>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre completo</th>
                <th class="datos">Nacionalidad</th>
                <th class="datos">No. Identidad</th>
                <th class="datos">Porcentaje de participación</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($accionistas as $accionista)
                <tr>
                    <td class="datos">{{ $accionista['nombre_accionista'] }}</td>
                    <td class="datos">{{ $accionista['nacionalidad_accionista'] }}</td>
                    <td class="datos">{{ $accionista['numero_identidad_accionista'] }}</td>
                    <td class="datos">{{ $accionista['porcentaje_participacion_accionista'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre completo</th>
                <th class="datos">Nacionalidad</th>
                <th class="datos">No. Identidad</th>
                <th class="datos">Cargo</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($miembros as $miembro)
                <tr>
                    <td class="datos">{{ $miembro['nombre_miembro'] }}</td>
                    <td class="datos">{{ $miembro['nacionalidad_miembro'] }}</td>
                    <td class="datos">{{ $miembro['numero_identidad_miembro'] }}</td>
                    <td class="datos">{{ $miembro['cargo_miembro'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <h6 class="subtitulo">Declaración jurada de origin de fondos</h6>
    <p class="datos">a) Todos los fondos, transferencias, depósitos, productos o servicios que entreguemos tendrán un
        origen
        lícito, y por ende, no estarán relacionados con los delitos de lavado de dinero y activos,
        financiamiento al terrorismo, descritos en el artículo 6 de la Ley Contra el Lavado de Dinero y de
        Activos, y ningún otro tipo de delito o actividad ilícita. Se permitirá cualquier procedimiento de
        investigación por parte de la COMPAÑÍA FARMACÉUTICA S.A. de C.V. y/o las autoridades correspondientes.
    </p>
    <p class="datos">b) Manifiesto que el pago de los productos y servicios tiene origen en la actividad económica a
        la que me
        dedico, y el monto proyectado de productos, compras o facturación mensual será el siguiente.
    </p>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Monto proyectado mensual</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $monto_proyectado }}</td>
            </tr>
        </tbody>
    </table>
    <h6 class="subtitulo">D. Información de Personas Expuestas Políticamente - PEP's</h6>
    <span>I. Identificación general del titular</span>
    <br>
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
                <td class="datos" scope="col">{{ $fecha_desde_politico }}</td>
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
    <br>
    <div>II. Información de Parientes y Asociados Comerciales o de Negocios</div>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre completo</th>
                <th class="datos">Parentesco</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($parientes as $pariente)
                <tr>
                    <td class="datos">{{ $pariente['nombre_pariente'] }}</td>
                    <td class="datos">{{ $pariente['parentesco'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Nombre completo</th>
                <th class="datos">Porcentaje de participación</th>
            </tr>
        </thead>
        <br>
        <tbody>
            @foreach ($socios as $socio)
                <tr>
                    <td class="datos">{{ $socio['nombre_socio'] }}</td>
                    <td class="datos">{{ $socio['porcentaje_participacion_socio'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div>III. Fuentes de ingresos.</div>
    <br>
    <table>
        <thead>
            <tr>
                <th class="datos">Fuentes de ingresos</th>
                <th class="datos">Monto aproximado de ingresos mensuales</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="datos" scope="col">{{ $fuente_ingreso }}</td>
                <td class="datos" scope="col">{{ $monto_mensual }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h6 class="subtitulo">IV. Declaración Jurada</h6>
    <p class="datos">Yo el Suscrito, declaro bajo juramento que la información proporcionada en el presente Formulario
        es veraz y fidedigna en mi condición de Persona Expuesta Políticamente de conformidad a lo establecido en el
        Art. 9-B de la Ley contra el Lavado de Dinero y Activos, por lo cual estoy dispuesto a suministrar la
        información requerida por las Políticas internas de la COMPAÑIA FARMACEUTICA S.A. de C.V.</p>
    <br>
    <h4>Firma/sellos Persona Natural o Representante Legal: ______________________</h4>
</body>


</html>
