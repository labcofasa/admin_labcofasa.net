@extends('layouts.publico')

@section('titulo', 'Mantenimiento')

@section('contenido')
    <div class="px-4 py-5 my-5 text-center">
        <div class="card p-4">
            <img class="d-block mx-auto mb-2" src="{{ asset('images/cofasa.svg') }}" alt="" width="300"
                height="300">
            <h1 class="display-5 fw-bold text-body-emphasis">Estamos en mantenimiento del sitio</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Lamentamos informar que nuestro sitio se encuentra temporalmente fuera de servicio
                    debido a
                    labores de mantenimiento. Estamos trabajando para resolver la situación lo más pronto posible y
                    agradecemos
                    su comprensión.</p>
            </div>
        </div>
    </div>
@endsection
