<?php

use App\Http\Controllers\Auth\AutenticacionController;
use Illuminate\Support\Facades\Route;

Route::post("/autenticar", [AutenticacionController::class, "autenticacionApi"]);
