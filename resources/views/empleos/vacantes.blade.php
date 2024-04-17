@extends('layouts.autenticado')

@section('titulo', 'Vacantes')

@section('contenido')
    <div class="container-fluid content">
        <div class="encabezado">
            <h1 class="pb-3">@yield('titulo')</h1>
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
                    <div class="acciones">
                        <div class="btn-group">
                            <button class="btn-edit dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22"
                                    color="#000000" fill="none">
                                    <path
                                        d="M16.2141 4.98239L17.6158 3.58063C18.39 2.80646 19.6452 2.80646 20.4194 3.58063C21.1935 4.3548 21.1935 5.60998 20.4194 6.38415L19.0176 7.78591M16.2141 4.98239L10.9802 10.2163C9.93493 11.2616 9.41226 11.7842 9.05637 12.4211C8.70047 13.058 8.3424 14.5619 8 16C9.43809 15.6576 10.942 15.2995 11.5789 14.9436C12.2158 14.5877 12.7384 14.0651 13.7837 13.0198L19.0176 7.78591M16.2141 4.98239L19.0176 7.78591"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M21 12C21 16.2426 21 18.364 19.682 19.682C18.364 21 16.2426 21 12 21C7.75736 21 5.63604 21 4.31802 19.682C3 18.364 3 16.2426 3 12C3 7.75736 3 5.63604 4.31802 4.31802C5.63604 3 7.75736 3 12 3"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <a href="{{ route('editar.vacante', ['id' => $vacante->id ]) }}"
                                        class="dropdown-item nav-link" type="button">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            width="24" height="24" color="#000000" fill="none">
                                            <path d="M7.01428 16.0029H11.0143M7.01428 11.0053H15.0143" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M10.0143 21.9999H11.0143" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path
                                                d="M7.51083 21.9999C6.33921 21.9749 5.53921 21.9 4.76421 21.6751C3.71491 21.4002 2.94905 20.4757 2.72421 19.1763C2.43921 17.9519 2.53921 14.9284 2.51416 11.3302C2.51623 8.53874 2.3892 5.85787 2.8392 4.33362C3.1142 3.83386 3.3392 2.00976 7.06421 2.03475C7.68921 2.00976 14.3142 1.95978 15.3642 2.05973C18.8642 2.1347 19.2142 3.93381 19.4142 5.63298C19.541 6.88236 19.5142 8.88138 19.5142 11.0053M7.01421 2.00976C7.31421 3.63396 7.28921 4.68344 8.38921 4.93332C8.86421 5.00828 9.9495 5.00628 11.1142 5.00828C12.1538 5.01007 13.2142 5.01945 13.6892 4.90833C14.8642 4.63347 14.7392 3.18418 15.0392 2.00976"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M18.2786 14.3787C16.9045 15.778 14.2563 18.2768 14.2563 18.4517C14.0427 18.7483 13.8565 19.3512 13.7316 20.2008C13.5747 20.9884 13.3868 21.6751 13.6067 21.875C13.8266 22.0749 14.6545 21.9064 15.5304 21.7251C16.2299 21.6501 16.8795 21.4002 17.2043 21.1504C17.679 20.7304 20.9018 17.4772 21.2766 17.0524C21.5514 16.6776 21.5764 15.9779 21.3365 15.5531C21.2016 15.2533 20.3522 14.4536 20.0774 14.2288C19.5777 13.9289 18.8782 13.8789 18.2786 14.3787Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
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
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M3 5.5H21M16.0557 5.5L15.3731 4.09173C14.9196 3.15626 14.6928 2.68852 14.3017 2.39681C14.215 2.3321 14.1231 2.27454 14.027 2.2247C13.5939 2 13.0741 2 12.0345 2C10.9688 2 10.436 2 9.99568 2.23412C9.8981 2.28601 9.80498 2.3459 9.71729 2.41317C9.32164 2.7167 9.10063 3.20155 8.65861 4.17126L8.05292 5.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M9.5 16.5L9.5 10.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M14.5 16.5L14.5 10.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span class="link">Eliminar</span>
                                    </button>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="imagen">
                        <img src="{{ asset('images/empleos/imagenes/' . $vacante->id . '/' . $vacante->imagen) }}">
                    </div>
                    <div class="titulo">
                        <h6>{{ $vacante->nombre }}</h6>
                    </div>
                    <div class="info">
                        <small>Solicitudes</small>
                        <small>30</small>
                    </div>
                    <div class="aviso mb-1">
                        <small>Fecha de vencimiento</small>
                        <small>{{ $vacante->fecha_vencimiento }}</small>
                    </div>
                    <div class="botones">
                        <button class="btn btn-warning">Más información</button>
                        <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Compartir">
                            <svg class="icon-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="24" height="24" color="#000000" fill="none">
                                <path
                                    d="M20.3927 8.03168L18.6457 6.51461C17.3871 5.42153 16.8937 4.83352 16.2121 5.04139C15.3622 5.30059 15.642 6.93609 15.642 7.48824C14.3206 7.48824 12.9468 7.38661 11.6443 7.59836C7.34453 8.29742 6 11.3566 6 14.6525C7.21697 13.9065 8.43274 13.0746 9.8954 12.7289C11.7212 12.2973 13.7603 12.5032 15.642 12.5032C15.642 13.0554 15.3622 14.6909 16.2121 14.9501C16.9844 15.1856 17.3871 14.5699 18.6457 13.4769L20.3927 11.9598C21.4642 11.0293 22 10.564 22 9.99574C22 9.4275 21.4642 8.96223 20.3927 8.03168Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M10.5676 3C6.70735 3.00694 4.68594 3.10152 3.39411 4.39073C2 5.78202 2 8.02125 2 12.4997C2 16.9782 2 19.2174 3.3941 20.6087C4.78821 22 7.03198 22 11.5195 22C16.0071 22 18.2509 22 19.645 20.6087C20.6156 19.64 20.9104 18.2603 21 16"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <x-empleos.eliminar :vacante="$vacante" />
            @endforeach
        </div>
    </div>
@endsection
