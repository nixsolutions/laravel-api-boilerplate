<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup as Api;
use Illuminate\Routing\Router;

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

JsonApi::register('v1', ['namespace' => 'Api\v1'], function (Api $api, Router $router) {
    $api->resource('users', [
        'controller' => 'UserController',
        'has-many' => ['roles', 'pages'],
        'has-one' => ['activation']
    ]);

    $api->resource('pages', [
        'controller' => 'PageController',
        'has-one' => ['user']
    ]);
});
