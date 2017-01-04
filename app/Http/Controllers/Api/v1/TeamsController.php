<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Teams\Hydrator;
use App\Models\Team;
use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface as JsonApiRequest;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;
use Illuminate\Http\Request;

class TeamsController extends EloquentController
{
    /**
     * EloquentController constructor.
     * @param Team $model
     * @param Hydrator|null $hydrator
     * @param SearchAll|null $search
     */
    public function __construct(
        Team $model,
        Hydrator $hydrator = null,
        SearchAll $search = null
    ) {
        parent::__construct($model, $hydrator, $search);
    }

    protected function getRequestHandler()
    {
        return \App\JsonApi\Teams\Request::class;
    }
}
