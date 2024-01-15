<div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
    @foreach ($aplicaciones as $aplicacion)
        <div class="col pb-3">
            <div class="btn-app">
                <a href="{{ $aplicacion->enlace_aplicacion }}" target="_blank">
                    <div class="card">
                        <div class="app-image">
                            @if ($aplicacion->imagen_aplicacion)
                                <img src="{{ asset('images/aplicaciones/imagen/' . $aplicacion->id . '/' . $aplicacion->imagen_aplicacion) }}"
                                    alt="Icono aplicación">
                            @else
                                <img class="icono-perfil rounded-circle" src="{{ asset('images/defecto.png') }}"
                                    alt="Imagen por defecto">
                            @endif
                        </div>
                        <div class="app-name">
                            <p class="name">{{ $aplicacion->nombre_aplicacion }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
