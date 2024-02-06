<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Aviso;
use App\Models\User;

class RestablecerController extends Controller
{
    public function formularioRestablecer(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('inicio');
        } else {
            $avisos = Aviso::all();

            $response = response()->view('auth.restablecer', compact('avisos'));

            $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');

            return $response;
        }
    }

    public function crearToken(User $user)
    {
        $existingToken = PasswordResetToken::where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->first();

        if ($existingToken) {
            return null;
        }

        PasswordResetToken::where('user_id', $user->id)->delete();

        $token = Str::random(60);
        $expiresAt = Carbon::now()->addHours(1);

        $passwordResetToken = PasswordResetToken::create([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => Carbon::now(),
            'expires_at' => $expiresAt,
        ]);

        $user->sendPasswordResetNotification($token);

        return $passwordResetToken;
    }


    public function enviarCorreo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $createdToken = $this->crearToken($user);
            if ($createdToken) {
                return redirect()->route('autenticarme')->with('success', 'Un enlace ha sido enviado a su dirección de correo electrónico.');
            } else {
                return back()->withErrors(['email' => 'Su enlace ya está activo. Por favor, compruebe su bandeja de entrada para acceder a él.'])->withInput();
            }
        } else {
            return back()->withErrors(['email' => 'No se encontró ningún usuario registrado con el correo electrónico proporcionado.'])->withInput();
        }
    }


    public function formularioNuevaClave($token, Request $request)
    {
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();
        if (!$passwordResetToken || $passwordResetToken->expires_at < now()) {
            return redirect()->route('form.restablecer')->withErrors(['email' => 'El enlace ha expirado o es inválido. Solicite un nuevo enlace de restablecimiento de contraseña.'])->withInput();
        } else {
            $avisos = Aviso::all();
            return view('auth.reseteo', ['token' => $token], compact('avisos'));
        }
    }

    protected function validarDatos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => ['required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[_@#$%^*()<>+-]).{8,}$/'],
            'password_confirmation' => 'required|same:password',
        ]);

        if (strlen($request->password) < 8) {
            $validator->errors()->add('password', 'La contraseña debe tener al menos 8 caracteres.');
        }

        $validator->after(function ($validator) use ($request) {
            if (!$this->caracteresEspeciales($request->password)) {
                $validator->errors()->add('password', 'La contraseña debe contener una letra mayúscula y un carácter especial.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    private function caracteresEspeciales($password)
    {
        return preg_match('/[A-Z]/', $password) && preg_match('/[!@#$%^&*]/', $password);
    }


    public function restablecerNuevaClave(Request $request)
    {
        $this->validarDatos($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No se encontró ningún usuario registrado con el correo electrónico proporcionado.'])->withInput();
        }

        if (strlen($request->password) < 6) {
            return redirect()->back()->withErrors(['password' => 'La contraseña debe tener más de 5 caracteres, una letra mayúscula y un carácter especial.'])->withInput();
        }

        if (!$this->caracteresEspeciales($request->password)) {
            return redirect()->back()->withErrors(['password' => 'La contraseña debe contener una letra mayúscula y un carácter especial.'])->withInput();
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withErrors(['password_confirmation' => 'Las contraseñas no coinciden.'])->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        return redirect()->route('inicio')->with('success', 'Su contraseña ha sido restablecida exitosamente.');
    }
}
