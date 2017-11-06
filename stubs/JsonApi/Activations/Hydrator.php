<?php

namespace App\JsonApi\Activations;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{
    /**
     * @var array|null
     */
    protected $attributes = [
        'token',
        'expired',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'user'
    ];

}
