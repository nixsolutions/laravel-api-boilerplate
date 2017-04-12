<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param null $user
     * @return array
     */
    protected function headers($user = null)
    {
        $headers = ['Accept' => 'application/json'];
        $headers['Content-Type'] = 'application/vnd.api+json';

        if ($user) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }

    /**
     * @name userDataProvider
     * @return array
     */
    public function addDataProvider()
    {
        return [
            [
            'userData' => [
                'email' => 'test@mail.com',
                'password' => 'password',
                'activated' => true
                ]
            ]
        ];
    }

    public function registerUserProvider()
    {
        return [
            [
            'userData' => [
                'email' => 'test@mail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'name' => 'TestUser'
                ]
            ]
        ];
    }
}
