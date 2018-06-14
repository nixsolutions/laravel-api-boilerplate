<?php

namespace App\JsonApi\Pages;

use App\Models\Page;
use App\Models\User;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use CloudCreativity\JsonApi\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Auth;

class Adapter extends EloquentAdapter
{
    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new Page(), $paging);
    }

    /**
     * @param Builder $builder
     * @param Collection $filters
     *
     * @return Builder|ValidationException|EloquentCollection
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        //
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        //
    }

    /**
     * @param Builder $builder
     * @return EloquentCollection
     */
    protected function all(Builder $builder)
    {
        /** @var User $user */
        $user = Auth::guard('api')->user();
        $models = $user->pages()->get()->all();

        if (count($models) > 0) {
            $models = $builder->eagerLoadRelations($models);
        }

        return $builder->getModel()->newCollection($models);
    }
}
