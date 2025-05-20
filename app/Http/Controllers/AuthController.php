<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     *      Registro de usuario
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'estado' => true,
                'mensaje' => 'Usuario registrado exitosamente',
                'usuario' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al registrar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     *      Inicio de sesión
     */
    public function login(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado' => false,
                'errores' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'estado' => false,
                    'mensaje' => 'Credenciales inválidas'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'No se pudo generar el token'
            ], 500);
        }

        return $this->respondWithToken($token);
    }

    /**
     *      Obtener perfil de usuario
     */
    public function perfil(): JsonResponse
    {
        try {
            $user = JWTAuth::user();

            if (!$user) {
                return response()->json([
                    'estado' => false,
                    'mensaje' => 'Usuario no autenticado'
                ], 401);
            }

            return response()->json([
                'estado' => true,
                'usuario' => $user
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al obtener el usuario'
            ], 500);
        }
    }

    /**
     *      Cerrar sesión
     */
    public function logout(): JsonResponse
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json([
                    'estado' => false,
                    'mensaje' => 'Token no proporcionado'
                ], 401);
            }

            JWTAuth::invalidate($token);

            return response()->json([
                'estado' => true,
                'mensaje' => 'Sesión cerrada exitosamente'
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error al cerrar sesión'
            ], 500);
        }
    }

    /**
     *      Actualizar token JWT
     */
    public function actualizar_token(): JsonResponse
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json([
                    'estado' => false,
                    'mensaje' => 'Token no proporcionado'
                ], 401);
            }

            $newToken = JWTAuth::refresh($token);

            return $this->respondWithToken($newToken);
        } catch (JWTException $e) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'No se pudo refrescar el token'
            ], 500);
        }
    }

    /**
     *      Estructura de respuesta con token
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'estado' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expira_en' => JWTAuth::factory()->getTTL()
        ]);
    }
}
