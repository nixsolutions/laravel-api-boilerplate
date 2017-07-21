<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'users';

    /**
     * @var array|null
     */
    protected $attributes = null;

}

