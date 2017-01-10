<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Users\Hydrator;
use App\JsonApi\Users\Search;
use App\Models\User;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

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
        return \App\JsonApi\Users\Request::class;
    }

    /**
     * @SWG\Get(path="/users",
     *   tags={"User actions"},
     *   summary="Filter users with limited per page quantity.",
     *   description="Filter users",
     *   produces={"application/vnd.api+json"},
     *   consumes={"application/vnd.api+json"},
     *     @SWG\Parameter(
     *     in="query",
     *     name="sort",
     *     type="string",
     *     description="-name",
     *     required=false,
     *     @SWG\Schema(
     *         type="object", example=""
     *     )
     *   ),
     *     @SWG\Parameter(
     *     in="query",
     *     name="filter[name]",
     *     type="string",
     *     description="User",
     *     required=false,
     *     @SWG\Schema(
     *         type="object", example=""
     *     )
     *   ),
     *     @SWG\Parameter(
     *     in="query",
     *     name="page[size]",
     *     type="number",
     *     description="2",
     *     required=false,
     *     @SWG\Schema(
     *         type="object", example=""
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return filtered users list.")
     * )
     */
}
