<?php

namespace App\Http\Controllers\Auth;

use App\Models\Aplicacion;
use App\Models\User;
use App\Models\Aviso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AutenticacionController extends Controller
{
    public function mostrarFormulario(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        } else {
            $avisos = Aviso::all();

            $response = response()->view('auth.autenticacion', compact('avisos'));

            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

            return $response;
        }
    }

    public function autenticacionUsuario(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $username = $request->input('username');
        $password = $request->input('password');

        if ($username && $password) {
            try {
                $user = User::where('email', $username)->orWhere('name', $username)->firstOrFail();

                if ($user->estado) {
                    if (Hash::check($password, $user->password)) {
                        Auth::login($user);

                        return redirect()->route('dashboard');
                    } else {
                        $errors = ['username' => 'Credenciales incorrectas.'];
                    }
                } else {
                    $errors = ['username' => 'Tu cuenta está desactivada.'];
                }
            } catch (\Exception $e) {
                $errors = ['username' => 'Credenciales incorrectas.'];
            }

            return redirect()->route('autenticarme')->withErrors($errors)->withInput();
        }
    }

    public function autenticacionApi(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            $user = User::where('email', $credentials['email'])->firstOrFail();

            if ($user->estado) {
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();

                    $token = $user->createToken('laboratorios-cofasa');

                    $rol = $user->getRoleNames()->first();

                    $aplicaciones = Aplicacion::whereHas('roles', function ($query) use ($rol) {
                        $query->where('name', $rol);
                    })->get();

                    return response()->json([
                        'token' => $token->plainTextToken,
                        'user' => $user,
                        'rol' => $rol,
                        'aplicaciones' => $aplicaciones,
                    ], 200);
                } else {
                    return response()->json(['message' => 'Credenciales incorrectas.'], 404);
                }
            } else {
                return response()->json(['message' => 'Tu cuenta está desactivada.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Credenciales incorrectas.'], 404);
        }
    }

    public function verificarToken(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                return response()->json(['message' => 'Token válido.', 'user' => $user], 200);
            } else {
                return response()->json(['message' => 'Token inválido.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al verificar el token. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function cerrarSesionApi()
    {
        Auth::logout();

        return response()->json(['message' => 'Se cerro la sesión exitosamente'], 200);
    }

    public function cerrarSesion(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $response = redirect('/');

        return $response;
    }
}
