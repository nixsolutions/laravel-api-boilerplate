<?php

namespace App\JsonApi\Users;

use App\Models\User;
use CloudCreativity\JsonApi\Exceptions\RuntimeException;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        'activated',
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
        if (!$resource instanceof User) {
            throw new RuntimeException('Expecting a user model.');
        }

        // for a POST request generate a new token
        $token = (JWTAuth::getToken()) ? JWTAuth::getToken() : JWTAuth::fromUser($resource);

        return [
            'token' => [
                self::SHOW_SELF => false,
                self::SHOW_RELATED => false,
                self::META => function () use ($resource, $token) {
                    return [
                        'token_type' => 'Bearer',
                        'access_token' => "$token",
                        'token' => 'Bearer ' . $token
                    ];
                },
            ],
            'activation' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->activation,
            ],
            'roles' => [
                self::SHOW_SELF => true,
                self::SHOW_RELATED => true,
                self::DATA => $resource->roles,
            ],
        ];
    }
}
