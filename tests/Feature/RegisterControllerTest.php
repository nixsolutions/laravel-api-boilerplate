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
use Illuminate\Auth\Events\Registered;

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @dataProvider registerUserProvider
     *
     * @param $userData
     *
     */
    public function testRegister($userData)
    {
        $response = $this->json('POST', '/api/v1/register',
            [
                'email' => $userData['email'],
                'password' => $userData['password'],
                'password_confirmation' => $userData['password_confirmation'],
                'name' => $userData['name']
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @dataProvider registerUserProvider
     *
     * @param $userData
     *
     */
    public function testRegisterError($userData)
    {
        $response = $this->json('POST', '/api/v1/register',
            [
                'email' => $userData['email'],
                'password' => $userData['password'],
                'password_confirmation' => 'password-wrong',
                'name' => $userData['name']
            ]
        );

        $response->assertStatus(400);
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testVerify($userData)    {

        $user = factory(User::class)->create($userData);

        $activationService = new ActivationService();
        $hash = $activationService->createActivation($user);

        $response = $this->json('POST', '/api/v1/register/verify',
            [
                'hash' => $hash
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testVerifyError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->json('POST', '/api/v1/register/verify',
            [
                'hash' => 'hash-wrong'
            ]
        );

        $response->assertStatus(400);
    }
}
