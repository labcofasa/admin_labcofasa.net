<?php

use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Empleos\VacantesController;
use Illuminate\Support\Facades\Route;

Route::post('/autenticar', [AutenticacionController::class, 'autenticacionApi']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'verClientes']);
    Route::get('/clientes/{idCliente}', [ClienteController::class, 'buscarClientePorId']);

    Route::post('/cerrar-sesion', [AutenticacionController::class, 'cerrarSesionApi']);

    Route::get('/verificar-token', [AutenticacionController::class, 'verificarToken']);
});

Route::get('/vacantes', [VacantesController::class, 'obtenerVacantes']);
Route::get('/vacantes/{id}', [VacantesController::class, 'obtenerVacantesPorCandidato']);