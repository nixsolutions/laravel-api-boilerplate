<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Likes\Hydrator;
use App\Models\Like;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;
use App\JsonApi\Likes\Request as LikesRequest;

class LikesController extends EloquentController
{
    /**
     * EloquentController constructor.
     *
     * @param Like $model
     * @param Hydrator|null $hydrator
     * @param SearchAll|null $search
     */
    public function __construct(
        Like $model,
        Hydrator $hydrator = null,
        SearchAll $search = null
    ) {
        parent::__construct($model, $hydrator, $search);
    }

    protected function getRequestHandler()
    {
        return LikesRequest::class;
    }
}
