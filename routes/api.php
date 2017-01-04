<?php

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

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'Auth\LoginController@login');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {

        // Authentication Routes...
        Route::get('logout', 'Auth\LoginController@logout');

        Route::get('/test', function () {
            return response()->json(['message' => 'authenticated']);
        });
    });



});
