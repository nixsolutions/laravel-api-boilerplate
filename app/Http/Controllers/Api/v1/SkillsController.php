<?php

namespace App\Http\Controllers\Api\v1;

use App\JsonApi\Skills\Hydrator;
use App\Models\Skill;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use CloudCreativity\LaravelJsonApi\Search\SearchAll;
use App\JsonApi\Skills\Request as SkillsRequest;

class SkillsController extends EloquentController
{
    /**
     * EloquentController constructor.
     *
     * @param Skill $model
     * @param Hydrator|null $hydrator
     * @param SearchAll|null $search
     */
    public function __construct(
        Skill $model,
        Hydrator $hydrator = null
    ) {
        parent::__construct($model, $hydrator);
    }

    protected function getRequestHandler()
    {
        return SkillsRequest::class;
    }
}

/**
 * @SWG\Get(path="/skills",
 *   tags={"Skill actions"},
 *   summary="Filter skills with limited per page quantity.",
 *   description="Filter skills",
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
 *   @SWG\Response(response="200", description="Return filtered skills list.")
 * )
 */

/**
 * @SWG\Get(
 *     path="/skills/{id}",
 *     summary="Get a skill",
 *     description="Get a skill",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Skill actions"},
 *     @SWG\Parameter(
 *         description="Skill id",
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
 *         description="Skill not found"
 *     ),
 * )
 */

/**
 * @SWG\Post(path="/skills",
 *   tags={"Skill actions"},
 *   summary="Post skills",
 *   description="Post skills",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Skill object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;skills&quot;, &quot;attributes&quot;: {&quot;name&quot;: &quot;new name&quot;}, &quot;relationships&quot;: {&quot;author&quot;: {&quot;data&quot;: {&quot;type&quot;: &quot;users&quot;, &quot;id&quot;: 1}}}}}",
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
 * @SWG\Patch(path="/skills/{id}",
 *   tags={"Skill actions"},
 *   summary="Update skill",
 *   description="Update skills",
 *   produces={"application/vnd.api+json"},
 *   consumes={"application/vnd.api+json"},
 *   @SWG\Parameter(
 *         description="Skill id to update",
 *         in="path",
 *         name="id",
 *         required=true,
 *         type="integer",
 *         format="int64"
 *     ),
 *     @SWG\Parameter(
 *     in="body",
 *     name="object",
 *     description="Skill object (format <br/>{&quot;data&quot;: {&quot;type&quot;: &quot;skills&quot;, &quot;id&quot;: 1, &quot;attributes&quot;: {&quot;name&quot;: &quot;new name&quot;}}}",
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
 *     path="/skills/{id}",
 *     summary="Delete a skill",
 *     description="Delete a skill",
 *     produces={"application/vnd.api+json", "application/vnd.api+json"},
 *     tags={"Skill actions"},
 *     @SWG\Parameter(
 *         description="Skill id to delete",
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
 *         description="Skill not found"
 *     ),
 * )
 */
