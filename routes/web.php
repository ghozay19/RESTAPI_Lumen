<?php

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

$app->get('/todo', 'todoController@index');
$app->get('/todo/{id}', 'todoController@show');
$app->post('/todo', 'todoController@store');
$app->put('/todo/{id}', 'todoController@update');
$app->delete('/todo/{id}', 'todoController@destroy');

$app->get('/', function () use ($app) {
    return $app->version();
});

