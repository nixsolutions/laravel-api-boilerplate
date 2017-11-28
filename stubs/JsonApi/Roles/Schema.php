<?php

namespace App\JsonApi\Roles;

use App\Models\Role;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'roles';

    /**
     * @var array|null
     */
    protected $attributes = null;

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }

    /**
     * @param object $resource
     * @param bool $isPrimary
     * @param array $includeRelationships
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Role) {
            throw new RuntimeException('Expecting a Role model.');
        }

        return [
            'users' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->users,
            ]
        ];
    }
}

