<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * La URL base del servicio de posts.
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        // Usamos el nombre del servicio definido en docker-compose
        $this->baseUri = 'http://post-service/api';
    }

    /**
     * Reenvía la petición para obtener todos los posts.
     */
    public function index()
    {
        $response = Http::get($this->baseUri . '/posts');
        return response($response->body(), $response->status());
    }

    /**
     * Reenvía la petición para crear un nuevo post.
     */
    public function store(Request $request)
    {
        // Obtenemos el usuario autenticado que el AuthMiddleware adjuntó
        $authUser = $request->attributes->get('auth_user');
        
        // Añadimos el user_id al cuerpo de la petición que se enviará al post-service
        $data = array_merge($request->all(), ['user_id' => $authUser['id']]);

        $response = Http::post($this->baseUri . '/posts', $data);
        return response($response->body(), $response->status());
    }

    /**
     * Reenvía la petición para obtener un post específico.
     */
    public function show($id)
    {
        $response = Http::get($this->baseUri . '/posts/' . $id);
        return response($response->body(), $response->status());
    }

    /**
     * Reenvía la petición para actualizar un post.
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->baseUri . '/posts/' . $id, $request->all());
        return response($response->body(), $response->status());
    }

    /**
     * Reenvía la petición para eliminar un post.
     */
    public function destroy($id)
    {
        $response = Http::delete($this->baseUri . '/posts/' . $id);
        return response($response->body(), $response->status());
    }
}