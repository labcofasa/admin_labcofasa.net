<div class="row">
    <x-formularios.encabezado />

    <h1 class="titulo">Formulario de Identificación de Personas Expuestas Políticamente</h1>

    <p class="mb-4">Nota: El presente formulario deberá ser completado por los clientes y/o contrapartes que marcaron
        "SI"
        en las preguntas del apartado "D" en el formulario "Conozca a su cliente".</p>
    <span class="mb-3">I. Identificación general del titular</span>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="nombre_politico" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_politico" name="nombre_politico"
                aria-describedby="ayuda">
            <div id="ayuda" class="form-text">
                Nombre del/a Titular del cargo público
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="nombre_cargo_politico" class="form-label">Nombre del cargo</label>
            <input type="text" class="form-control" id="nombre_cargo_politico" name="nombre_cargo_politico"
                aria-describedby="ayuda">
            <div id="ayuda" class="form-text">
                Último cargo público que desempeña/desempeñó el Titular
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="fecha_desde_politico" class="form-label">Fecha de nombramiento</label>
            <input type="date" class="form-control" id="fecha_desde_politico" name="fecha_desde_politico">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="fecha_hasta_politico" class="form-label">Período de nombramiento</label>
            <input type="date" class="form-control" id="fecha_hasta_politico" name="fecha_hasta_politico">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="pais_politico" class="form-label">País donde ejerce/ejerció el cargo</label>
            <select class="form-select" id="pais_politico">
                <option value="">Seleccione el país</option>
            </select>
            <input type="hidden" id="id_pais_politico" name="pais_politico_id" value="">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="departamento_politico" class="form-label">Departamento</label>
            <select class="form-select" id="departamento_politico">
                <option value="">Seleccione el departamento</option>
            </select>
            <input type="hidden" id="id_departamento_politico" name="departamento_politico_id" value="">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="municipio_politico" class="form-label">Municipio</label>
            <select class="form-select" id="municipio_politico">
                <option value="">Seleccione el municipio</option>
            </select>
            <input type="hidden" id="id_municipio_politico" name="municipio_politico_id" value="">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="nombre_cliente_politico" class="form-label">Nombre del cliente</label>
            <input type="text" class="form-control" id="nombre_cliente_politico" name="nombre_cliente_politico"
                aria-describedby="ayuda">
            <div id="ayuda" class="form-text">
                Nombre del cliente/proveedor Directo
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="porcentaje_participacion_politico" class="form-label">Porcentaje de participación</label>
            <input type="text" class="form-control" placeholder="Ejemplo: 10%" id="porcentaje_participacion_politico"
                name="porcentaje_participacion_politico" aria-describedby="ayuda">
            <div id="ayuda" class="form-text">
                ¿Cuál es su porcentaje de participación en el patrimonio del cliente y/o proveedor directo?.
            </div>
        </div>
    </div>
    <span class="mb-2">II. Información de Parientes y Asociados Comerciales o de Negocios</span>
    <p class="mb-3">Detalle sus Parientes en Primer y Segundo grado de consanguinidad.</p>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="nombre_pariente" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre_pariente" name="nombre_pariente[]"
                aria-describedby="ayuda">
            <div id="ayuda" class="form-text">
                Nombres según documento de identidad.
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="parentesco" class="form-label">Parentesco</label>
            <input type="text" class="form-control" id="parentesco" name="parentesco[]">
        </div>
    </div>

    <div id="campos_parientes"></div>

    <div class="col-md-6 mb-3">
        <button type="button" id="agregar_campos_parientes" class="btn btn-secondary">
            Añadir más campos
        </button>
    </div>
    <p class="mb-3">Detalle sus Asociados comerciales o de negocios (sociedades en las que posee 25% o más del
        Patrimonio)</p>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="nombre_socio" class="form-label">Nombre de la entidad</label>
            <input type="text" class="form-control" id="nombre_socio" name="nombre_socio[]">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="porcentaje_participacion_socio" class="form-label">Porcentaje de participación</label>
            <input type="text" class="form-control" placeholder="Ejemplo: 50%"
                id="porcentaje_participacion_socio" name="porcentaje_participacion_socio[]">
        </div>
    </div>
    <div id="campos_socios"></div>

    <div class="col-md-6 mb-3">
        <button type="button" id="agregar_campos_socios" class="btn btn-secondary">
            Añadir más campos
        </button>
    </div>
    <span class="mb-2">III. Fuentes de ingresos.</span>
    <div class="col-sm-12">
        <div class="mb-3">
            <label for="fuente_ingreso" class="form-label">Indique sus principales fuentes de ingresos</label>
            <textarea class="form-control" id="fuente_ingreso" name="fuente_ingreso" style="height: 100px"></textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="mb-3">
            <label for="monto_mensual" class="form-label">Monto aproximado de ingresos mensuales</label>
            <input type="text" placeholder="Ejemplo: 1000" class="form-control" id="monto_mensual"
                name="monto_mensual">
        </div>
    </div>
    <span class="mb-2">IV. Declaración Jurada</span>
    <p class="mb-3">Yo el Suscrito, declaro bajo juramento que la información proporcionada en el presente Formulario
        es veraz y fidedigna en mi condición de Persona Expuesta Políticamente de conformidad a lo establecido en el
        Art. 9-B de la Ley contra el Lavado de Dinero y Activos, por lo cual estoy dispuesto a suministrar la
        información requerida por las Políticas internas de la COMPAÑIA FARMACEUTICA S.A. de C.V.</p>
</div>
