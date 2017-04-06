<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChangePasswordControllerTest extends TestCase
{
    /**
     *
     */
    public function testChangePassword()
    {
        $userData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $this->deleteUser($userData);

        $user = factory(User::class)->create($userData);

        $headers = ['Accept' => 'application/json'];
        $headers['Content-Type'] = 'application/vnd.api+json';

        if ($user) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        $response = $this->json('POST', '/api/v1/password/change',
            [
                'current_password' => 'password',
                'password' => 'password-new',
                'password_confirmation' => 'password-new'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/vnd.api+json'
            ]);

        $response->assertStatus(200);
    }
}
