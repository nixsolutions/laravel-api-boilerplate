<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{
    /**
     * @var array
     */
    protected $attributes = [
        'name',
        'email',
        'password',
        'activated',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'roles',
    ];
}
