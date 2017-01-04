<?php

namespace App\JsonApi\Skills;

use CloudCreativity\JsonApi\Http\Requests\RequestHandler;

class Request extends RequestHandler
{

    /**
     * @var array
     */
    protected $hasOne = [
        'author'
    ];

    /**
     * @var array
     */
    protected $hasMany = [
        //
    ];

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];
}

