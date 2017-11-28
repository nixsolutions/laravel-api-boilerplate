<?php

namespace App\JsonApi\Activations;

use Auth;
use App\Models\User;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Adapter extends EloquentAdapter
{
    /**
     * @param Builder $builder
     * @param Collection $filters
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
     * When requested on get all activations this method is overridden to clear all unavailable user activations
     *
     * @param Builder $builder
     * @return EloquentCollection
     */
    protected function all(Builder $builder)
    {
        /** @var User $user */
        $user = Auth::guard('api')->user();
        $models = $user->activation()->getResults();

        if (count($models) > 0) {
            $models = $builder->eagerLoadRelations($models);
        }

        return $builder->getModel()->newCollection($models);
    }
}
