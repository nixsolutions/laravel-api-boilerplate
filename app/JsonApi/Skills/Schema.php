<?php

namespace App\JsonApi\Skills;

use App\Models\Skill;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'skills';

    /**
     * @var array
     */
    protected $attributes = [
        'name',
    ];

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
     *
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Skill) {
            throw new RuntimeException('Expecting a Skill model.');
        }

        return [
            'author' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::DATA         => $resource->author,
            ],
        ];
    }
}
