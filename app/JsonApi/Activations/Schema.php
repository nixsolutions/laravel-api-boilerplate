<?php

namespace App\JsonApi\Activations;

use App\Models\Activation;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'activations';

    // hyphens by default
    protected $hyphenated = false;

    /**
     * @var array|null
     */
    protected $attributes = [
        'token',
        'expired',
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
        if (!$resource instanceof Activation) {
            throw new RuntimeException('Expecting a activation model.');
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

