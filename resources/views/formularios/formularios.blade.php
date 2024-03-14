@extends('layouts.autenticado')

@section('titulo', 'Formularios')

@section('contenido')

    <div class="container-fluid content">
        <!-- Titulo-->
        <h1 class="pb-3">@yield('titulo')</h1>

        <div class="card-form">
            <h6 class="link_name">📜 Conozca a su cliente</h6>
            <div>
                <small class="mb-1">Vigencia dic 23, Version 1</small>
            </div>
            <span>Descripcion del formulario.</span>
            <div class="mt-3 options">
                <a href="{{ route('pag.formulario') }}" class="btn btn-success">
                    Ver respuestas
                </a>
                <a href="{{ route('formulario') }}" target="_blank" class="btn btn-secondary">
                    Ver formulario
                </a>
                <button id="botonCopiar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copiar enlace"
                    class="btn btn-secondary">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 -960 960 960"
                        width="18">
                        <path
                            d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("botonCopiar").addEventListener("click", function() {
            var enlace = "http://app.labcofasa.net/formulario-conozca-cliente";
            var inputTemp = document.createElement("input");
            inputTemp.setAttribute("value", enlace);
            document.body.appendChild(inputTemp);
            inputTemp.select();
            document.execCommand("copy");
            document.body.removeChild(inputTemp);
            alert("¡Enlace copiado al portapapeles!");
        });
    </script>

@endsection
