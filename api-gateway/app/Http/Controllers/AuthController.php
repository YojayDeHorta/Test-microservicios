<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * La URL base del servicio de autenticación.
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        // Usamos el nombre del servicio definido en docker-compose
        $this->baseUri = 'http://auth-service/api';
    }

    /**
     * Reenvía la petición de registro al auth-service.
     */
    public function register(Request $request)
    {
        $response = Http::post($this->baseUri . '/register', $request->all());
        return response($response->body(), $response->status());
    }

    /**
     * Reenvía la petición de login al auth-service.
     */
    public function login(Request $request)
    {
        $response = Http::post($this->baseUri . '/login', $request->all());
        return response($response->body(), $response->status());
    }
}