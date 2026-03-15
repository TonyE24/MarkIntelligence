<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // registramos el nuevo usuario que vamos a crear
    public function register(RegisterRequest $request)
    {
        // los datos ya vienen validados por el FormRequest
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'El usuario se ha registrado correctamente',
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'token' => $token,
        ], 201);
    }

    // con esta función hacemos validamos el inicio de sesión y se crea el token para el usuario autenticado
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales incorrectas, vuelve a intentarlo',
            ], 401);
        }

        $user  = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Ha iniciado sesión correctamente',
            'user'    => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'role'  => $user->role,
            ],
            'token' => $token,
        ], 200);
    }

    // cierre de sesión elimina solo el token actual
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente',
        ], 200);
    }

    // paso 1 del reset manda el link al email para verificar que es el usuario autentico
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        //Si el correo es el correcto entonces le caera un link para restablecer su contraseña
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Te enviamos un link para que puedas restablecer la contraseña'
            ], 200);
        }
        //Si el correo no es el correcto entonces le caerá un error
        return response()->json([
            'message' => 'No se encontró una cuenta con ese email'
        ], 404);
    }

    // paso 2 del reset cambia la contraseña con el token del email y se genera uno nuevo
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                // borramos todos los tokens viejos por seguridad y que nadie pueda tener acceso a la cuenta
                $user->tokens()->delete();
            }
        );
        //Si el token es correcto entonces se restablece la contraseña
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Contraseña ha sido reestablecida'
            ], 200);
        }
        //Si el token es incorrecto entonces le caerá un error
        return response()->json([
            'message' => 'El token es invalido o ya termino su tiempo maximo de espera'
        ], 400);
    }
}
