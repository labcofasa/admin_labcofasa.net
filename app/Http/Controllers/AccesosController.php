<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplicacion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccesosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('id')->toArray();
        $aplicaciones = Aplicacion::whereHas('roles', function ($query) use ($userRoles) {
            $query->whereIn('roles.id', $userRoles);
        })->get();

        $hora_actual = date('H');

        $saludo = "saludo";

        if ($hora_actual >= 1 && $hora_actual < 12) {
            $saludo = "Buenos días";
        } elseif ($hora_actual >= 12 && $hora_actual < 18) {
            $saludo = "Buenas tardes";
        } else {
            $saludo = "Buenas noches";
        }

        $usuario = User::with('perfil')->find(auth()->id());

        return view('accesos', compact('usuario', 'aplicaciones', 'saludo'));
    }
}
