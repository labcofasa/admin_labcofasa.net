<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ArticuloController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil')->find(auth()->id());

        return view('articulos', compact('usuario'));
    }
}
