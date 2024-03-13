<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FormulariosController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        return view('formularios.formularios', compact('usuario'));
    }

    public function show()
    {
        $usuario = User::with('perfil')->find(auth()->id());
        return view('formularios.formularios_tabla', compact('usuario'));
    }
}
