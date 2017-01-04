<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Users\Hydrator;
use App\Models\User;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface as JsonApiRequest;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;
use Illuminate\Http\Request;

class UsersController extends EloquentController
{
    /**
     * EloquentController constructor.
     * @param User $model
     * @param Hydrator|null $hydrator
     * @param SearchAll|null $search
     */
    public function __construct(
        User $model,
        Hydrator $hydrator = null,
        SearchAll $search = null
    ) {
        parent::__construct($model, $hydrator, $search);
    }

    protected function getRequestHandler()
    {
        return \App\JsonApi\Users\Request::class;
    }
}
