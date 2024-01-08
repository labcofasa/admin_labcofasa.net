<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


class CuentaController extends Controller
{
    public function index()
    {
        $usuario = User::with('perfil', 'pais', 'departamento', 'municipio')->find(auth()->id());

        return view('auth.cuenta', compact('usuario'));
    }

    public function obtenerUsuario()
    {
        $user = Auth::user();
        $perfil = $user->perfil;
        $pais = $perfil->pais;
        $departamento = $perfil->departamento;
        $municipio = $perfil->municipio;

        $imagenUrl = $perfil->imagen ? asset('images/usuarios/' . $perfil->imagen) : asset('images/defecto.png');

        return response()->json([
            'user' => $user,
            'perfil' => $perfil,
            'pais' => $pais,
            'departamento' => $departamento,
            'municipio' => $municipio,
            'imagenUrl' => $imagenUrl,
        ]);
    }

    public function obtenerPerfil()
    {
        $user = Auth::user();
        $perfil = $user->perfil;

        $imagenUrl = $perfil->imagen ? asset('images/usuarios/' . $perfil->imagen) : asset('images/defecto.png');

        return response()->json([
            'user' => $user,
            'perfil' => $perfil,
            'imagenUrl' => $imagenUrl,
        ]);
    }

    public function actualizarClave(Request $request)
    {
        $request->validate([
            'current' => 'required',
            'newPassword' => 'required|min:8|regex:/[A-Z]/|regex:/[@$!%*#?&]/',
            'confirm_password' => 'required|same:newPassword',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current, $user->password)) {
            return response()->json(['success' => false, 'error' => 'La contraseña actual es incorrecta.']);
        }

        $user->update(['password' => bcrypt($request->newPassword)]);

        return response()->json(['success' => true, 'message' => 'Contraseña actualizada con éxito.']);
    }
}
