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
        Hydrator $hydrator = null,
        SearchAll $search = null
    ) {
        parent::__construct($model, $hydrator, $search);
    }

    protected function getRequestHandler()
    {
        return SkillsRequest::class;
    }
}
