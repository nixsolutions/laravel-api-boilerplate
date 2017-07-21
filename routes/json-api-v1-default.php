<?php

JsonApi::api('default', [
    'prefix' => 'api',
    'as' => 'api::',
    'namespace' => 'Api\v1',
    'middleware' => [],
], function ($api, $router) {

});
