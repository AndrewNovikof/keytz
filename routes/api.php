<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['middleware' => ['auth:api'], 'prefix' => 'users'], function (Router $router) {
    $router->get('me', 'UserController@me');
    $router->get('can', 'UserController@can');
    $router->get('role', 'UserController@role');
});

$router->get('books', 'BookController@index');


$router->group(['middleware' => ['auth:api'], 'prefix' => 'catalogs'], function (Router $router) {
    $router->get('{catalog}/can', 'CatalogController@can');
});
$router->apiResource('catalogs', 'CatalogController')->middleware('auth:api');

$router->group(['middleware' => ['auth:api'], 'prefix' => 'books'], function (Router $router) {
    $router->get('{book}/can', 'BookController@can');
});
$router->apiResource('books', 'BookController')->middleware('auth:api');
