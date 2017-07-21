<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Teams\Hydrator;
use App\Models\Team;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;
use App\JsonApi\Teams\Request as TeamsRequest;

class TeamsController extends EloquentController
{
    /**
     * EloquentController constructor.
     *
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
        return TeamsRequest::class;
    }
}

/**
 * @SWG\Get(path="/teams",
 *   tags={"Team actions"},
 *   summary="Filter teams with limited per page quantity.",
 *   description="Filter teams",
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
 *   @SWG\Response(response="200", description="Return filtered teams list.")
 * )
 */

/**
 * @SWG\Get(
 *     path="/teams/{id}",
 *     summary="Get a team",
 *     description="Get a team",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Team actions"},
 *     @SWG\Parameter(
 *         description="Team id",
 *         in="path",
 *         name="id",
 *         required=true,
 *         type="integer",
 *         format="int64"
 *     ),
 *     @SWG\Response(
 *         response=400,
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Team not found"
 *     ),
 * )
 */

/**
 * @SWG\Post(path="/teams",
 *   tags={"Team actions"},
 *   summary="Create team",
 *   description="Create team",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Team object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;teams&quot;, &quot;attributes&quot;: {&quot;name&quot;: &quot;new name&quot;}}}",
 *     required=true,
 *     @SWG\Schema(
 *         type="object",
 *         @SWG\Property(property="data", type="string", example={}),
 *     )
 *   ),
 *   @SWG\Response(response="200", description="Return message")
 * )
 */

/**
 * @SWG\Patch(path="/teams/{id}",
 *   tags={"Team actions"},
 *   summary="Update team",
 *   description="Update teams",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *   @SWG\Parameter(
 *         description="Team id to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         type="integer",
 *         format="int64"
 *     ),
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Team object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;teams&quot;, &quot;id&quot;: 1, &quot;attributes&quot;: {&quot;name&quot;: &quot;new name&quot;}}}",
 *     required=true,
 *     @SWG\Schema(
 *         type="object",
 *         @SWG\Property(property="data", type="string", example={}),
 *     )
 *   ),
 *   @SWG\Response(response="200", description="Return message")
 * )
 */

/**
 * @SWG\Delete(
 *     path="/teams/{id}",
 *     summary="Delete a team",
 *     description="Delete a team",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Team actions"},
 *     @SWG\Parameter(
 *         description="Team id to delete",
 *         in="path",
 *         name="id",
 *         required=true,
 *         type="integer",
 *         format="int64"
 *     ),
 *     @SWG\Response(
 *         response=400,
 *         description="Invalid ID supplied"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Team not found"
 *     ),
 * )
 */
