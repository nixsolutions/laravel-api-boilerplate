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
        Hydrator $hydrator = null
    ) {
        parent::__construct($model, $hydrator);
    }

    protected function getRequestHandler()
    {
        return LikesRequest::class;
    }
}


/**
 * @SWG\Get(path="/likes",
 *   tags={"Like actions"},
 *   summary="Filter likes with limited per page quantity.",
 *   description="Filter likes",
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
 *   @SWG\Response(response="200", description="Return filtered likes list.")
 * )
 */

/**
 * @SWG\Get(
 *     path="/likes/{id}",
 *     summary="Get a like",
 *     description="Get a like",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Like actions"},
 *     @SWG\Parameter(
 *         description="Like id",
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
 *         description="Like not found"
 *     ),
 * )
 */

/**
 * @SWG\Post(path="/likes",
 *   tags={"Like actions"},
 *   summary="Post like",
 *   description="Post like",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Like object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;likes&quot;, &quot;attributes&quot;: {<br />
  &quot;comment&quot;: &quot;new comment&quot;}, &quot;relationships&quot;: <br />{&quot;liked&quot;: {&quot;data&quot;: {&quot;type&quot;: &quot;users&quot;, &quot;id&quot;: 1}}, <br />
  &quot;liker&quot;: {&quot;data&quot;: {&quot;type&quot;: &quot;users&quot;, &quot;id&quot;: 1}}, &quot;skill&quot;: {&quot;data&quot;: {&quot;type&quot;: &quot;skills&quot;, &quot;id&quot;: 1}}}}}",
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
 * @SWG\Patch(path="/likes/{id}",
 *   tags={"Like actions"},
 *   summary="Update like",
 *   description="Update like",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *   @SWG\Parameter(
 *         description="Like id to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         type="integer",
 *         format="int64"
 *     ),
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Like object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;likes&quot;, &quot;id&quot;: 1, &quot;attributes&quot;: {&quot;comment&quot;: &quot;new comment&quot;}}}",
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
 *     path="/likes/{id}",
 *     summary="Delete a like",
 *     description="Delete a like",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Like actions"},
 *     @SWG\Parameter(
 *         description="Like id to delete",
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
 *         description="Like not found"
 *     ),
 * )
 */
