<?php

namespace App\JsonApi\Users;

use App\Models\User;
use App\Services\UserService;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use CloudCreativity\JsonApi\Document\Error;
use CloudCreativity\JsonApi\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Auth;

class Adapter extends EloquentAdapter
{
    private $service;

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(UserService $service, StandardStrategy $paging)
    {
        $this->service = $service;

        parent::__construct(new User(), $paging);
    }

    /**
     * @param Builder $builder
     * @param Collection $filters
     *
     * @return Builder|ValidationException|EloquentCollection
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        $user = Auth::guard('api')->user();

        if ($filters->has('user') && $filters->get('user') == 'me') {
            return $builder->where('users.id', '=', $user->id);
        }

        if ($this->service->isAdmin()) {
            return $builder->findMany(User::all()->pluck('id')->toArray());
        }

        $err = new Error(null, null, 403, 'Forbidden', 'You don\'t have permission to access to this resource.');

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
