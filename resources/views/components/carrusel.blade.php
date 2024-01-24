<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @if (count($publicidades) > 0)
            @foreach ($publicidades as $index => $publicidad)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" datba-bs-interval="3000">
                    <div class="image-container">
                        <img src="{{ asset('images/publicidades/imagen/' . $publicidad->id . '/' . $publicidad->imagen_publicidad) }}" alt="Icono publicidad">
                    </div>
                </div>
            @endforeach
        @else
            <div class="carousel-item active" datba-bs-interval="3000">
                <div class="image-container">
                    <img src="{{ asset('images/carousel-defecto.png') }}" alt="Imagen por defecto">
                </div>
            </div>
        @endif
    </div>
    <div class="carousel-indicators">
        @for ($i = 0; $i < count($publicidades); $i++) <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $i + 1 }}"></button>
            @endfor
    </div>
    <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>