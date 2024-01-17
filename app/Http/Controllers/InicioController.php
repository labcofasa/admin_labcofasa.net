<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InicioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();
        $aplicaciones = Aplicacion::whereHas('roles', function($query) use ($userRoles) {
            $query->whereIn('roles.id', $userRoles);
        })->get();

        $usuario = User::with('perfil')->find(auth()->id());

        return view('inicio', compact('usuario', 'aplicaciones'));
    }
}
