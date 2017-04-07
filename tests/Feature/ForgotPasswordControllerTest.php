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
    use DatabaseTransactions;

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testForgotPassword($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/password/forgot',
            [
                'email' => $userData['email']
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testForgotPasswordError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/password/forgot',
            [
                'email' => 'wrong.email@mail.com'
            ]
        );

        $response->assertStatus(404);
    }
}
