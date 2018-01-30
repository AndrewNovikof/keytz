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

$router->get('/user', function (Request $request) {
    return fractal($request->user(), new \App\Transformers\UserTransformer(), new \League\Fractal\Serializer\ArraySerializer());
})->middleware('auth:api');

$router->apiResource('books', 'BookController')->middleware('auth:api');
$router->apiResource('catalogs', 'CatalogController')->middleware('auth:api');
