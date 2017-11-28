<?php

namespace App\JsonApi\Users;

use App\Models\User;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use CloudCreativity\JsonApi\Document\Error;
use CloudCreativity\JsonApi\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
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
        parent::__construct(new User(), $paging);
    }

    /**
     * @param Builder $builder
     * @param Collection $filters
     *
     * @return Builder|ValidationException
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        if ($filters->has('user') && $filters->get('user') == 'me') {
            $userId = Auth::guard('api')->user()->id;
            return $builder->where('users.id', '=', $userId);
        }

        $err = new Error(null, null, 405, null, 'Method Not Allowed');

        throw new ValidationException($err);
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return $filters->has('user');
    }
}
