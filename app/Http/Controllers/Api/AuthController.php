<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;

class AuthController extends Controller
{

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        // Busca o usuário pelo email
        $usuario = Usuarios::where('email', $request->email)->first();
        

        if($usuario && Hash::check($request->senha, $usuario->senha) ){
            // Gera o token JWT para o usuário
            $token = JWTAuth::fromUser($usuario);

            return response()->json([
                'success' => true,
                "token" => $token
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Credenciais inválidas.'
        ], 401);
    }

    public function validaToken(Request $request)
    {

        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader) {
            return response()->json(['valid' => false, 'message' => 'Token não fornecido.'], 401);
        }

        try {
            
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['valid' => false, 'message' => 'Token inválido ou usuário não encontrado.'], 401);
            }
            
            return response()->json(['valid' => true, 'user' => $user]);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['valid' => false, 'message' => 'Token expirado.'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['valid' => false, 'message' => 'Token inválido.'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['valid' => false, 'message' => 'Token ausente ou malformado.'], 401);
        }

    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logout successful']);
    }
}
