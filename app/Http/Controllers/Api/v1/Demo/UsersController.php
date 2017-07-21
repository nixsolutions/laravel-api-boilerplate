<?php

namespace App\Http\Controllers\Api\v1\Demo;

use App\Models\User;
use App\JsonApi\Users\Hydrator;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class UsersController extends EloquentController
{
    /**
     * UsersController constructor.
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        parent::__construct(new User(), $hydrator);
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
