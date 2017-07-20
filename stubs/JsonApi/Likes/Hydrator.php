<?php

namespace App\JsonApi\Likes;

use CloudCreativity\LaravelJsonApi\Hydrator\EloquentHydrator;

class Hydrator extends EloquentHydrator
{
    /**
     * @var array
     */
    protected $attributes = [
        'comment'
    ];

    /**
     * @var array
     */
    protected $relationships = [
        'liker',
        'liked',
        'skill'
    ];
}
