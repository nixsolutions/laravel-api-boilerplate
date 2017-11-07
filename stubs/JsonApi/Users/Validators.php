<?php

namespace App\JsonApi\Users;

use CloudCreativity\JsonApi\Contracts\Validators\RelationshipsValidatorInterface;
use CloudCreativity\LaravelJsonApi\Validators\AbstractValidatorProvider;

class Validators extends AbstractValidatorProvider
{
    /**
     * @var string
     */
    protected $resourceType = Schema::RESOURCE_TYPE;

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
        'name',
        'email',
        'activated',
        'created_at',
        'updated_at',
        'user'
    ];

    /**
     * @var array
     */
    protected $allowedSortParameters = [
        'id',
        'name',
        'email',
        'activated',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $allowedIncludePaths = [
        'activation',
        'roles',
    ];

    /**
     * Get the validation rules for the resource attributes.
     *
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     *
     * @return array
     */
    protected function attributeRules($record = null)
    {
        $email = 'required|email|max:255|unique:users';
        $password = 'required|min:8|max:16';

        if ($record) {
            $email = 'sometimes|' . $email;
            $password = 'sometimes|' . $password;
        }

        return [
            'name' => 'required|max:32',
            'email' => $email,
            'password' => $password,
        ];
    }

    /**
     * Define the validation rules for the resource relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     *
     * @return void
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $record = null)
    {
        //
    }
}
