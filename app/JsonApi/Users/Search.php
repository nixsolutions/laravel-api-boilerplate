<?php

namespace App\JsonApi\Users;

use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Search extends AbstractSearch
{
    /**
     * @var int
     */
    protected $maxPerPage = 25;

    /**
     * @param Builder $builder
     * @param Collection $filters
     */
    protected function filter(Builder $builder, Collection $filters)
    {

    }

    /**
     * @param Collection $filters
     *
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return false;
    }
}
