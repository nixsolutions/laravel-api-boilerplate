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
     * @var array
     */
    protected $userData = [
        'email' => 'test@mail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'name' => 'TestUser'
    ];

    /**
     *
     */
    public function testRegister()
    {
        $response = $this->json('POST', '/api/v1/register',
            [
                'email' => $this->userData['email'],
                'password' => $this->userData['password'],
                'password_confirmation' => $this->userData['password_confirmation'],
                'name' => $this->userData['name']
            ]
        );

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function testRegisterError()
    {
        $response = $this->json('POST', '/api/v1/register',
            [
                'email' => $this->userData['email'],
                'password' => $this->userData['password'],
                'password_confirmation' => 'password-wrong',
                'name' => $this->userData['name']
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
