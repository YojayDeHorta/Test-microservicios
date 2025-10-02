<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Obtener el token de la cabecera
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'Authorization token not found.'], 401);
        }

        // 2. Enviar el token al auth-service para su validación
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Accept' => 'application/json',
        ])->get('http://auth-service/api/user');

        // 3. Verificar la respuesta del auth-service
        if ($response->failed()) {
            // Si el auth-service dice que el token es inválido, devolvemos un error.
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // 4. Si el token es válido, adjuntamos los datos del usuario a la petición
        // para que los controladores posteriores puedan usarlos.
        $request->attributes->add(['auth_user' => $response->json()]);

        // 5. Permitir que la petición continúe hacia su destino final.
        return $next($request);
    }
}