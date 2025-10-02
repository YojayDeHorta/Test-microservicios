<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Rutas públicas que no necesitan token
$router->post('/auth/register', 'AuthController@register');
$router->post('/auth/login', 'AuthController@login');

// Rutas protegidas que sí necesitan token
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/posts', 'PostController@index');
    $router->post('/posts', 'PostController@store'); // Crear un post
    $router->get('/posts/{id}', 'PostController@show'); // Ver un post
    $router->put('/posts/{id}', 'PostController@update'); // Actualizar un post
    $router->delete('/posts/{id}', 'PostController@destroy'); // Eliminar un post
});
