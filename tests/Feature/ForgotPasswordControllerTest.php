<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ForgotPasswordControllerTest extends TestCase
{
    /**
     *
     */
    public function testForgotPassword()
    {
        $userData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $user = User::where('email', '=' , $userData['email'])->firstOrFail();
        $user->delete();

        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/password/forgot',
            [
                'email' => $userData['email']
            ]
        );

        $response->assertStatus(200);
    }
}
