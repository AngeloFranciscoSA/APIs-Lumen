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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// TODO Middleware o uso de autenticadores, neste caso o JWT encontrado no AuthServiceProvider
$router->group(['middleware' => 'autenticador'], function() use ($router){

    $router->group(['prefix' => 'series'], function () use ($router) {
        $router->get('', 'SeriesController@index');
        $router->post('', 'SeriesController@store');
        $router->get('{id}', 'SeriesController@show');
        $router->put('{id}', 'SeriesController@update');
        $router->delete('{id}', 'SeriesController@update');

        $router->get('{serie_id}/episodio', 'EpisodiosController@buscaPorSerie');

    });

    $router->group(['prefix' => 'episodios'], function () use ($router) {
        $router->get('', 'EpisodiosController@index');
        $router->post('', 'EpisodiosController@store');
        $router->get('{id}', 'EpisodiosController@show');
        $router->put('{id}', 'EpisodiosController@update');
        $router->delete('{id}', 'EpisodiosController@update');
    });
});

$router->post('login', 'TokenController@gerartoken');
