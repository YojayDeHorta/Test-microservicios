<?php
// app/Http/Controllers/Api/PostController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Almacena un nuevo recurso.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->all());

               return response()->json($post, 201);
    }
    
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Actualiza el recurso especificado en la base de datos.
     */
    public function update(Request $request, Post $post)
    {
        // 'sometimes' significa que el campo solo se valida si está presente en la petición
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * Elimina el recurso especificado de la base de datos.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // 204 No Content es una respuesta estándar para eliminaciones exitosas
        return response()->json(null, 204);
    }
}

