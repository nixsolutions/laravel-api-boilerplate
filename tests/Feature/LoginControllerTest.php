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

        $this->deleteUser($userVerifiedData);

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
    public function testLoginError()
    {
        $userVerifiedData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $this->deleteUser($userVerifiedData);

        factory(User::class)->create($userVerifiedData);

        $response = $this->json('POST', '/api/v1/login',
            [
                'email' => $userVerifiedData['email'],
                'password' => 'password-wrong'
            ]
        );

        $response->assertStatus(401);
    }
}