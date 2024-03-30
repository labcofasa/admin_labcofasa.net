<div class="container-fluid px-0">
    <div class="container-cards">
        @foreach ($aplicaciones as $key => $aplicacion)
            <a href="{{ $aplicacion->enlace_aplicacion }}" target="_blank">
                <div class="cards">
                    @if ($aplicacion->imagen_aplicacion)
                        <img src="{{ asset('images/aplicaciones/imagen/' . $aplicacion->id . '/' . $aplicacion->imagen_aplicacion) }}"
                            alt="Icono aplicación">
                    @else
                        <img src="{{ asset('images/logo.svg') }}" alt="Imagen por defecto">
                    @endif
                    <p class="name">{{ $aplicacion->nombre_aplicacion }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
