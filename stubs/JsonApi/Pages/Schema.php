<?php

namespace App\JsonApi\Pages;

use App\Models\Page;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{
    /**
     * @var string
     */
    const RESOURCE_TYPE = 'pages';

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
        if (!$resource instanceof Page) {
            throw new RuntimeException('Expecting a page model.');
        }

        return [
            'user' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->user,
            ],
        ];
    }
}
