<?php

namespace App\JsonApi\Users;

use App\Models\Team;
use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Search extends AbstractSearch
{
    /**
     * @param Builder $builder
     * @param Collection $filters
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        $user = Auth::user();

        if ($user && !$user->hasRole('admin')) {
            $memberships = Team::leftjoin('membership', 'teams.id', 'membership.team_id')
                ->where('membership.user_id', $user->id)
                ->get();

            $teamsIds = $memberships->map(function ($membership) {
                return $membership->team_id;
            });

            $builder
                ->leftJoin('membership', 'users.id', 'membership.user_id')
                ->whereIn('team_id', $teamsIds);
        }
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return false;
    }
}
