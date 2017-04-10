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

    use DatabaseTransactions;

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testResetPassword($userData)
    {
        $user = factory(User::class)->create($userData);

        $token = app('auth.password.broker')->createToken($user);

        $response = $this->json('POST', '/api/v1/password/reset',
            [
                'email' => $userData['email'],
                'password' => 'password-new',
                'password_confirmation'=> 'password-new',
                'token' => $token
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testResetPasswordError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/password/reset',
            [
                'email' => $userData['email'],
                'password' => 'password-new',
                'password_confirmation'=> 'password-new',
                'token' => 'wrong-token'
            ]
        );

        $response->assertStatus(400);
    }
}
