<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup as Api;

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

JsonApi::api('v1', [
    'namespace' => 'Api\v1',
    'prefix' => 'v1',
    'as' => 'api-v1::'
], function (Api $api, $router) {
    $api->resource('teams', ['has-one' => 'parent', 'has-many' => ['children', 'members']]);
    $api->resource('skills', ['has-one' => 'author']);
    $api->resource('likes', ['has-one' => ['liker', 'liked', 'skill']]);
    $api->resource('users');
});
