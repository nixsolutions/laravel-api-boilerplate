<?php

Route::group(['middleware' => 'auth:api'], function () {
    JsonApi::resource('teams', 'Api\v1\TeamsController');
    JsonApi::resource('skills', 'Api\v1\SkillsController');
    JsonApi::resource('likes', 'Api\v1\LikesController');
    JsonApi::resource('users', 'Api\v1\UsersController');
});