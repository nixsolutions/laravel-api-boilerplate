<?php

namespace App\JsonApi\Skills;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    protected $resourceType = 'skills';

    /**
     * @var array|null
     */
    protected $attributes = null;

}

