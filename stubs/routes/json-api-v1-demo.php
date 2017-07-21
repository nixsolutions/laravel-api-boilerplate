<?php
JsonApi::api('default', [
    'prefix' => 'api',
    'as' => 'api::',
    'namespace' => 'Api',
    'middleware' => ['auth:api'],
], function ($api, $router) {
    $api->resource('teams');
    $api->resource('skills');
    $api->resource('likes');
    $api->resource('users');
});