<?php

namespace App\JsonApi\Teams;

use CloudCreativity\JsonApi\Http\Requests\RequestHandler;

class Request extends RequestHandler
{

    /**
     * @var array
     */
    protected $hasOne = [
        'parent'
    ];

    /**
     * @var array
     */
    protected $hasMany = [
        'children',
        'members'
    ];

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];
}

