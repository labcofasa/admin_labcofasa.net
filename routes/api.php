<?php

use App\Http\Controllers\Auth\AutenticacionController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;


Route::post('/cerrar-sesion', [AutenticacionController::class, 'cerrarSesionApi']);
Route::post('/autenticar', [AutenticacionController::class, 'autenticacionApi']);

Route::middleware('auth:sanctum')->get('/verificar-token', [AutenticacionController::class, 'verificarToken']);
