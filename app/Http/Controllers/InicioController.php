<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use Illuminate\Http\Request;
use App\Models\User;

class InicioController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        $aplicaciones = Aplicacion::all();

        return view('inicio', compact('usuario', 'aplicaciones'));
    }
}
