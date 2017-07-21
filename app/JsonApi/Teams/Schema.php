<?php

namespace App\JsonApi\Teams;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'teams';

    /**
     * @var array|null
     */
    protected $attributes = null;

}

