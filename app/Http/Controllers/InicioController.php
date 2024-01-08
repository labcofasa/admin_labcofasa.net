<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InicioController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('inicio', compact('usuario'));
    }
}
