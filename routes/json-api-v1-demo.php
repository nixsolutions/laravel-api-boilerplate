<?php

JsonApi::api('demo', [
    'as' => 'api::',
    'namespace' => 'Api\v1\Demo',
    'middleware' => ['auth:api'],
], function ($api, $router) {
    $api->resource('teams');
    $api->resource('skills');
    $api->resource('likes');
    $api->resource('users');
});