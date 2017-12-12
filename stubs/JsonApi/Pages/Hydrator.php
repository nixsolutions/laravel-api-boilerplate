<?php

namespace App\JsonApi\Pages;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{
    /**
     * @var array
     */
    protected $attributes = [
        'title',
        'alias',
        'keywords',
        'description',
        'content',
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'user',
    ];
}
