<?php
/**
 * Created by PhpStorm.
 * User: kvasenko
 * Date: 30.06.17
 * Time: 15:35
 */

namespace App\JsonApi\Users;

use App\Models\User;
use CloudCreativity\LaravelJsonApi\Store\EloquentAdapter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class Adapter extends EloquentAdapter
{
    /**
     * Adapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new User());
    }
    /**
     * @inheritDoc
     */
    protected function filter(Builder $query, Collection $filters)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin')) {
            $teamsIds = $user->teams->pluck('id')->toArray();

            $query
                ->leftJoin('membership', 'users.id', 'membership.user_id')
                ->whereIn('team_id', $teamsIds);

            if ($filters->has('name')) {
                $query->where('name', 'like', '%' . $filters->get('name') . '%');
            }
        }
    }
    /**
     * @inheritDoc
     */
    protected function isSearchOne(Collection $filters)
    {
        return false;
    }

}
