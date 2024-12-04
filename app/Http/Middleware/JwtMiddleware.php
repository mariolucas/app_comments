<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $usuario = JWTAuth::parseToken()->authenticate();

            if (!$usuario) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'Token inválido'], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'Token expirado'], 401);
            } else {
                return response()->json(['error' => 'Token não encontrado'], 401);
            }
        }

        return $next($request);
    }
}
