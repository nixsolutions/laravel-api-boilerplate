<?php

namespace App\JsonApi\Activations;

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
        'expired',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $allowedIncludePaths = [
        'user'
    ];

    /**
     * Get the validation rules for the resource attributes.
     *
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return array
     */
    protected function attributeRules($record = null)
    {
        return [
            //
        ];
    }

    /**
     * Define the validation rules for the resource relationships.
     *
     * @param RelationshipsValidatorInterface $relationships
     * @param object|null $record
     *      the record being updated, or null if it is a create request.
     * @return void
     */
    protected function relationshipRules(RelationshipsValidatorInterface $relationships, $record = null)
    {
        //
    }
}

