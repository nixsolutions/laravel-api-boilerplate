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
    Route::post('register', 'Auth\RegisterController@register');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {

        // Authentication Routes...
        Route::get('logout', 'Auth\LoginController@logout');
        Route::group(['prefix' => 'password'], function () {
            Route::post('reset', 'Auth\ResetPasswordController@reset');
            Route::post('forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        });

        Route::get('/test', function () {
            return response()->json(['message' => 'authenticated']);
        });
    });
});
