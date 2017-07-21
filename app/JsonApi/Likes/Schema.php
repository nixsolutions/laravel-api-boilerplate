<?php

namespace App\JsonApi\Likes;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'likes';

    /**
     * @var array|null
     */
    protected $attributes = null;

}

