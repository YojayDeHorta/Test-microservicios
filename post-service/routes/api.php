<?php
// routes/api.php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Definición de rutas de la API para Posts con el método clásico
Route::get('/posts', [PostController::class, 'index']); // Obtener todos los posts
Route::post('/posts', [PostController::class, 'store']); // Crear un nuevo post
Route::get('/posts/{post}', [PostController::class, 'show']); // Obtener un post específico
Route::put('/posts/{post}', [PostController::class, 'update']); // Actualizar un post
Route::delete('/posts/{post}', [PostController::class, 'destroy']); // Eliminar un post
