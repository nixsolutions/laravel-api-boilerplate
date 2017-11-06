<?php

namespace App\Http\Controllers\Api\v1;

use CloudCreativity\JsonApi\Contracts\Http\Requests\RequestInterface as JsonApiRequest;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use App\Models\User;
use App\JsonApi\Users\Hydrator;

class UsersController extends EloquentController
{
    /**
     * @param User $user
     * @param Hydrator $hydrator
     */
    public function __construct(User $user, Hydrator $hydrator)
    {
        parent::__construct($user, $hydrator);
    }

    /**
     * Display a listing of the resource.
     *
     * @SWG\Get(
     *   path="/users?filter[user]=me",
     *   tags={"Users"},
     *   summary="get me",
     *   description="get me",
     *   produces={"application/vnd.api+json"},
     *   consumes={"application/vnd.api+json"},
     *   @SWG\Response(response="200", description="Return user")
     * )
     *
     * @param JsonApiRequest $request
     * @return mixed
     */

    /**
     * @SWG\Get(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="get user by id",
     *     description="get user by id",
     *     produces={"application/vnd.api+json"},
     *     consumes={"application/vnd.api+json"},
     *     @SWG\Parameter(
     *         in="path",
     *         name="id",
     *         description="",
     *         required=true,
     *         default="1",
     *         type="integer"
     *     ),
     *     @SWG\Response(response="200", description="Return user"),
     *     @SWG\Response(response="404", description="error, user not found"),
     * )
     *
     * @param JsonApiRequest $request
     * @return mixed
     */

    /**
     * @SWG\Post(path="/users",
     *   tags={"Users"},
     *   summary="register user",
     *   description="register user",
     *   produces={"application/vnd.api+json"},
     *   consumes={"application/vnd.api+json"},
     *   @SWG\Parameter(
     *     name="Register user",
     *     in="body",
     *     description="JSON Object which create cat",
     *     required=true,
     *     @SWG\Schema(
     *       @SWG\Property(
     *         property="data",
     *         type="object",
     *         @SWG\Property(property="type", type="string", default="users", example="users"),
     *         @SWG\Property(
     *           property="attributes",
     *           type="object",
     *           @SWG\Property(property="email", type="string", example="user@mail.com", description="required"),
     *           @SWG\Property(property="password", type="string", example="password", description="required"),
     *           @SWG\Property(property="name", type="string", example="Steven", description="required"),
     *         )
     *       )
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param JsonApiRequest $request
     * @return mixed
     */

    /**
     * @SWG\Patch(path="/users/{id}",
     *   tags={"Users"},
     *   summary="update user",
     *   description="update user",
     *   produces={"application/vnd.api+json"},
     *   consumes={"application/vnd.api+json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     description="",
     *     required=true,
     *     default="1",
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Update user by id",
     *     in="body",
     *     description="JSON Object which update user by id",
     *     required=true,
     *     @SWG\Schema(
     *       @SWG\Property(
     *         property="data",
     *         type="object",
     *         @SWG\Property(property="type", type="string", default="users", example="users"),
     *         @SWG\Property(property="id", type="string", default="1", example="1"),
     *         @SWG\Property(
     *           property="attributes",
     *           type="object",
     *           @SWG\Property(property="email", type="string", example="user@mail.com", description="required"),
     *           @SWG\Property(property="password", type="string", example="Password1", description="required"),
     *           @SWG\Property(property="name", type="string", example="Steven", description="required"),
     *           @SWG\Property(
     *             property="activated",
     *             type="string",
     *             description="0 - deactivated, 1 - activated",
     *             default="1",
     *             example="1"
     *           ),
     *         )
     *       )
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param JsonApiRequest $request
     * @return mixed
     */

    /**
     * @SWG\Delete(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="delete user by id",
     *     description="delete user by id",
     *     produces={"application/vnd.api+json"},
     *     consumes={"application/vnd.api+json"},
     *     @SWG\Parameter(
     *         in="path",
     *         name="id",
     *         description="",
     *         required=true,
     *         default="1",
     *         type="integer"
     *     ),
     *     @SWG\Response(response="200", description="success"),
     *     @SWG\Response(response="404", description="error, user not found"),
     * )
     *
     * @param JsonApiRequest $request
     * @return mixed
     */
}
