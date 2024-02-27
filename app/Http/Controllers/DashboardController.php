<?php

namespace App\Http\Controllers;

use App\Models\Aplicacion;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $usuario = User::with('perfil')->find(auth()->id());

        return view('dashboard', compact('usuario'));
    }
}
