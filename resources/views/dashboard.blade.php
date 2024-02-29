@extends('layouts.autenticado')

@section('titulo', 'Dashboard')

@section('contenido')
    <div class="container-fluid content">
        <!-- Titulo-->
        <h1 class="pb-3">@yield('titulo')</h1>

        <div class="row">
            <div class="col-sm-6">
                <div class="card-chart">
                    <header class="card-chart-header">
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <h2>Ventas</h2>
                                <span>Seleccionar por año</h3>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" onclick="selectYear(this, 2023)">
                                <span>2023</span>
                                </button>
                                <button type="button" class="active" onclick="selectYear(this, 2024)">
                                    <span>2024</span>
                                </button>
                            </div>
                        </div>
                    </header>
                    <canvas id="areaTableChart" width="400" height="220"></canvas>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card-chart">
                    <header class="card-chart-header">
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <h2>Pedidos</h2>
                                <span>Seleccionar por año</h3>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" onclick="selectMonth(this, 2023)">
                                <span>2023</span>
                                </button>
                                <button type="button" class="active" onclick="selectMonth(this, 2024)">
                                    <span>2024</span>
                                </button>
                            </div>
                        </div>
                    </header>
                    <canvas id="areaTableChartOrders" width="400" height="220"></canvas>
                </div>
            </div>
            <div class="col-sm-6"></div>
        </div>


    </div>

    <!-- Scripts -->
    <script async src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@endsection
