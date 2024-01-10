<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AplicacionesController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('aplicaciones', compact('usuario'));
    }
}
