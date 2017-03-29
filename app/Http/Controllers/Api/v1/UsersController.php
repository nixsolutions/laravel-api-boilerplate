<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Users\Hydrator;
use App\JsonApi\Users\Search;
use App\Models\User;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\JsonApi\Users\Request as UsersRequest;

class UsersController extends EloquentController
{
    /**
     * EloquentController constructor.
     *
     * @param User $model
     * @param Hydrator|null $hydrator
     * @param Search|null $search
     */
    public function __construct(
        User $model,
        Hydrator $hydrator = null,
        Search $search = null
    ) {
        parent::__construct($model, $hydrator, $search);
    }

    protected function getRequestHandler()
    {
        return UsersRequest::class;
    }
}
