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

Route::group(['prefix' => 'api/v1'], function () {
    Route::group(['namespace' => 'Api\v1\Auth'], function () {
        Route::post('login', [
            'as' => 'login', 'uses' => 'LoginController@login'
        ]);
        Route::post('login-via-facebook', 'LoginController@loginViaFacebook');

        Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
            Route::post('', 'RegisterController@register')->name('index');
            Route::post('verify', 'RegisterController@verify')->name('verify');
            Route::post('resend-activation-email', 'RegisterController@resendActivationEmail');
        });

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', 'LoginController@logout');
            Route::post('password/change', [
                'as' => 'change-password', 'uses' => 'ChangePasswordController@change'
            ]);
        });

        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::post('forgot', 'ForgotPasswordController@sendResetLinkEmail')->name('forgot');
            Route::post('reset', 'ResetPasswordController@reset')->name('reset');
        });
    });
});
