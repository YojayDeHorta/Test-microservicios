<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas para registro e inicio de sesión
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas que requieren un token válido
Route::middleware('auth:sanctum')->group(function () {
    // Devuelve la información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Cierra la sesión del usuario (revoca el token actual)
    Route::post('/logout', [AuthController::class, 'logout']);
});