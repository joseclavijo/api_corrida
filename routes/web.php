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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});

$router->group(['prefix'=>'api/v1'], function() use($router){
    $router->get('/corredor', 'CorredorController@index');
    $router->post('/corredor', 'CorredorController@create');
    $router->get('/prova', 'ProvaController@index');
    $router->post('/prova', 'ProvaController@create');
    $router->post('/evento', 'EventoController@create');
    $router->get('/evento/idade', 'EventoController@idade');
    $router->get('/evento/geral', 'EventoController@geral');

});
