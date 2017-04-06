<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginControllerTest extends TestCase
{
    /**
     *
     */
    public function testLogin()
    {
        $userVerifiedData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $user = User::where('email', '=' , $userVerifiedData['email'])->firstOrFail();
        if ($user) {
            $user->delete();
        }

        factory(User::class)->create($userVerifiedData);

        $response = $this->json('POST', '/api/v1/login',
            [
                'email' => $userVerifiedData['email'],
                'password' => 'password'
            ]
        );

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function testLogout()
    {
        $userVerifiedData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $user = User::where('email', '=' , $userVerifiedData['email'])->firstOrFail();
        $user->delete();

        $user = factory(User::class)->create($userVerifiedData);

        $response = $this->json('GET', '/api/v1/logout', [], $this->headers($user));

        $response->assertStatus(200);
    }

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
}