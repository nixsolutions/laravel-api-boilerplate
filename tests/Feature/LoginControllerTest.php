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
    use DatabaseTransactions;

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
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testLoginError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/login',
            [
                'email' => $userData['email'],
                'password' => 'password-wrong'
            ]
        );

        $response->assertStatus(401);
    }
}