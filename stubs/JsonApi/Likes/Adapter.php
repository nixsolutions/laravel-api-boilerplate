<?php
/**
 * Created by PhpStorm.
 * User: kvasenko
 * Date: 30.06.17
 * Time: 15:35
 */

namespace App\JsonApi\Likes;

use App\Models\Like;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class Adapter extends EloquentAdapter
{
    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new Like());
    }
    /**
     * @inheritDoc
     */
    protected function filter(Builder $query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }
    /**
     * @inheritDoc
     */
    protected function isSearchOne(Collection $filters)
    {
        // TODO: Implement isSearchOne() method.
    }

}
