<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'users';

    /**
     * @var array
     */
    protected $attributes = [
        'name',
        'email',
        'role'

    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }
}

