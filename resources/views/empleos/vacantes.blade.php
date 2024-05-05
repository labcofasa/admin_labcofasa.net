@extends('layouts.autenticado')

@section('titulo', 'Vacantes')

@section('contenido')
    <div class="container-fluid content">
        <div class="encabezado">
            <h1>@yield('titulo')</h1>
            <a class="btn btn-lg btn-primary d-none d-xl-block" href="{{ route('crear.vacante') }}">
                <div class="accion">
                    <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24" color="#000000" fill="none">
                        <path
                            d="M14.9263 2.91103L8.27352 6.10452C7.76151 6.35029 7.21443 6.41187 6.65675 6.28693C6.29177 6.20517 6.10926 6.16429 5.9623 6.14751C4.13743 5.93912 3 7.38342 3 9.04427V9.95573C3 11.6166 4.13743 13.0609 5.9623 12.8525C6.10926 12.8357 6.29178 12.7948 6.65675 12.7131C7.21443 12.5881 7.76151 12.6497 8.27352 12.8955L14.9263 16.089C16.4534 16.8221 17.217 17.1886 18.0684 16.9029C18.9197 16.6172 19.2119 16.0041 19.7964 14.778C21.4012 11.4112 21.4012 7.58885 19.7964 4.22196C19.2119 2.99586 18.9197 2.38281 18.0684 2.0971C17.217 1.8114 16.4534 2.17794 14.9263 2.91103Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M11.4581 20.7709L9.96674 22C6.60515 19.3339 7.01583 18.0625 7.01583 13H8.14966C8.60978 15.8609 9.69512 17.216 11.1927 18.197C12.1152 18.8012 12.3054 20.0725 11.4581 20.7709Z"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 12.5V6.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Crear vacante</span>
                </div>
            </a>
        </div>
        <div class="container-empleos">
            @foreach ($vacantes as $vacante)
                <div class="cards">
                    <div class="imagen">
                        @if ($vacante->imagen)
                            <img src="{{ asset('images/empleos/imagenes/' . $vacante->id . '/' . $vacante->imagen) }}">
                        @else
                            <img src="{{ asset('images/empleo-defecto.png') }}">
                        @endif
                    </div>
                    <div class="titulo">
                        <h6>{{ $vacante->nombre }}</h6>
                    </div>
                    <div class="info">
                        <small class="texto-secundario">Solicitudes</small>
                        <small class="texto-secundario">{{ $vacante->candidatos->count() }}</small>
                    </div>
                    <div class="aviso mb-1">
                        <small class="texto-secundario">Fecha límite de solicitud</small>
                        <small class="texto-secundario" id="fecha_vencimiento">{{ $vacante->fecha_vencimiento }}</small>
                    </div>
                    <div class="botones">
                        <button data-bs-toggle="offcanvas" data-bs-target="#verVacanteOffCanvas{{ $vacante->id }}"
                            aria-controls="verVacanteOffCanvas" class="btn btn-warning">Más información</button>
                        <x-empleos.ver :vacante="$vacante" />
                        <div class="btn-group">
                            <button class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">
                                <svg class="icon-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="24" height="24" color="#000000" fill="none">
                                    <path d="M6.51331 16H10.5133M6.51331 11H14.5133" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M10.0133 22H11.0133" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path
                                        d="M7.50993 22C6.36069 21.975 5.58621 22 4.58688 21.775C3.53758 21.5 2.88801 20.85 2.66317 19.55C2.43831 18.7 2.5106 14.9238 2.51327 11.325C2.51533 8.53219 2.53385 5.99934 2.7631 5.475C3.08789 4.35 3.83739 3.55 6.16084 3.525M16.0292 3.525C16.8287 3.6 18.9184 3.525 19.327 5.825C19.5491 7.075 19.5019 8.85 19.5019 10.975M8.18449 5.5C9.23379 5.525 12.6065 5.5 13.7558 5.5C14.905 5.5 15.5123 4.55409 15.5046 3.675C15.4967 2.77925 14.7051 2.08017 13.9307 2C12.9813 2 8.95897 2 8.1595 2C7.23512 2.05 6.61054 2.8 6.5106 3.55C6.41067 4.575 7.16017 5.45 8.18449 5.5Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    <path
                                        d="M18.2776 14.375C16.9035 15.775 14.2553 18.275 14.2553 18.45C14.0417 18.7468 13.8555 19.35 13.7306 20.2C13.5737 20.9879 13.3858 21.675 13.6057 21.875C13.8256 22.075 14.6535 21.9064 15.5294 21.725C16.229 21.65 16.8785 21.4 17.2033 21.15C17.678 20.7298 20.9009 17.475 21.2756 17.05C21.5504 16.675 21.5754 15.975 21.3356 15.55C21.2007 15.25 20.3512 14.45 20.0764 14.225C19.5767 13.925 18.8772 13.875 18.2776 14.375Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a href="{{ route('pag.candidatos', ['id' => $vacante->id]) }}"
                                        class="dropdown-item nav-link" type="button">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            width="24" height="24" color="#000000" fill="none">
                                            <path d="M13 15C10.7083 21 4.29167 15 2 21" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M15.5 15H17.0013C19.3583 15 20.5368 15 21.2691 14.2678C22.0013 13.5355 22.0013 12.357 22.0013 10V8C22.0013 5.64298 22.0013 4.46447 21.2691 3.73223C20.5368 3 19.3583 3 17.0013 3H13.0013C10.6443 3 9.46576 3 8.73353 3.73223C8.11312 4.35264 8.01838 5.29344 8.00391 7"
                                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <circle cx="7.5" cy="12.5" r="2.5" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 7H18M18 11H15" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="link">Candidatos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('editar.vacante', ['id' => $vacante->id]) }}"
                                        class="dropdown-item nav-link" type="button">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            width="24" height="24" color="#000000" fill="none">
                                            <path
                                                d="M15.2141 5.98239L16.6158 4.58063C17.39 3.80646 18.6452 3.80646 19.4194 4.58063C20.1935 5.3548 20.1935 6.60998 19.4194 7.38415L18.0176 8.78591M15.2141 5.98239L6.98023 14.2163C5.93493 15.2616 5.41226 15.7842 5.05637 16.4211C4.70047 17.058 4.3424 18.5619 4 20C5.43809 19.6576 6.94199 19.2995 7.57889 18.9436C8.21579 18.5877 8.73844 18.0651 9.78375 17.0198L18.0176 8.78591M15.2141 5.98239L18.0176 8.78591"
                                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M11 20H17" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span class="link">Editar</span>
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item nav-link" type="button" data-bs-toggle="modal"
                                        data-bs-target="#eliminarVacante{{ $vacante->id }}">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            width="24" height="24" color="#000000" fill="none">
                                            <path
                                                d="M19.5 5.5L18.8803 15.5251C18.7219 18.0864 18.6428 19.3671 18.0008 20.2879C17.6833 20.7431 17.2747 21.1273 16.8007 21.416C15.8421 22 14.559 22 11.9927 22C9.42312 22 8.1383 22 7.17905 21.4149C6.7048 21.1257 6.296 20.7408 5.97868 20.2848C5.33688 19.3626 5.25945 18.0801 5.10461 15.5152L4.5 5.5"
                                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path
                                                d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5"
                                                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" />
                                            <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span class="link">Eliminar</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <x-empleos.eliminar :vacante="$vacante" />
            @endforeach
        </div>

        <x-notificaciones.notificaciones-ia :usuario="$usuario" />

    </div>

    <script src="{{ asset('js/empleos/vacante.js') }}"></script>
@endsection
