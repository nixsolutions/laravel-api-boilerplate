<?php

namespace App\JsonApi\Likes;

use App\Models\Like;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'likes';

    /**
     * @var array
     */
    protected $attributes = [
        'comment',
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
    public function getRelationships($resource, bool $isPrimary, array $includeRelationships)
    {
        if (!$resource instanceof Like) {
            throw new RuntimeException('Expecting a Like model.');
        }

        return [
            'liker' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::DATA         => $resource->liker,
            ],
            'liked' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::DATA         => $resource->liked,
            ],
            'skill' => [
                self::SHOW_SELF    => true,
                self::SHOW_RELATED => true,
                self::DATA         => $resource->skill,
            ],
        ];
    }
}
