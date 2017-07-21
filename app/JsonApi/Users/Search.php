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
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            $teamsIds = $user->teams->pluck('id')->toArray();

            $builder
                ->leftJoin('membership', 'users.id', 'membership.user_id')
                ->whereIn('team_id', $teamsIds);

            if ($filters->has('name')) {
                $builder->where('name', 'like', '%' . $filters->get('name') . '%');
            }
        }
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
