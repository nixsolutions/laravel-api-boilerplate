<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Auth;

class UserService
{
    /**
     * @return bool|array
     */
    public function checkAccess()
    {
        if (Auth::guard('api')->user()->id != request()->route('record')->getAttributes()['id']) {
            $errors['forbidden'] =  'You don\'t have permission to access this resource.';
            $errors['sources'][] =  ['pointer' => '/data/id'];

            return $errors;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $roles = Auth::guard('api')->user()->roles()->get()->pluck('name', 'id')->toArray();

        return array_has($roles, Role::ROLE_ADMIN);
    }

    /**
     * @param User $user
     *
     * @return User $user
     */
    public function attachUserRole(User $user)
    {
        $user->roles()->sync([Role::ROLE_USER]);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function saveModel(User $user)
    {
        $this->setEncodedPassword($user);

        $user->save();

        return $user;
    }

    /**
     * @param User $user
     *
     * @return void
     */
    private function setEncodedPassword(User $user)
    {
        $attributes = $this->getRequestAttributes();

        $password = !empty($attributes['password']) ? bcrypt($attributes['password']) : $user->password;

        $user->password = $password;
    }

    /**
     * @return array
     */
    private function getRequestAttributes()
    {
        return request('data')['attributes'];
    }
}