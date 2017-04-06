<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\ActivationService;

class ResetPasswordControllerTest extends TestCase
{
    /**
     *
     */
    public function testResetPassword()
    {
        $userData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        $user = User::where('email', '=' , $userData['email'])->firstOrFail();
        $user->delete();

        factory(User::class)->create($userData);

        $token = app('auth.password.broker')->createToken($user);

        $response = $this->json('POST', '/api/v1/password/forgot',
            [
                'email' => $userData['email'],
                'password' => 'password-new',
                'password_confirmation'=> 'password-new',
                'token' => $token
            ]
        );

        $response->assertStatus(200);
    }
}
