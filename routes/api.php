<?php

use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::post('/autenticar', [AutenticacionController::class, 'autenticacionApi']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'verClientes']);
    Route::get('/clientes/{idCliente}', [ClienteController::class, 'buscarClientePorId']);
    
    Route::post('/cerrar-sesion', [AutenticacionController::class, 'cerrarSesionApi']);
    
    Route::get('/verificar-token', [AutenticacionController::class, 'verificarToken']);
});