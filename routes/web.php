<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', 'WebAuth\LoginController@login');
Route::get('login', 'WebAuth\LoginController@index');

Route::post('register', 'WebAuth\RegisterController@register');
Route::get('register', 'WebAuth\RegisterController@index');

Route::get('home', 'HomeController@index');
Route::get('logout', 'WebAuth\LoginController@logout');

// Password Reset Routes...
$this->get('password/reset', 'WebAuth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'WebAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'WebAuth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'WebAuth\ResetPasswordController@reset');