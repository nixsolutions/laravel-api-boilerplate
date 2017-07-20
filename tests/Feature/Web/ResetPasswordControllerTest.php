<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

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

        $response = $this->post('/password/reset',
            [
                'email' => $userData['email'],
                'password' => 'password-new',
                'password_confirmation'=> 'password-new',
                'token' => $token
            ]
        );

        $response->assertRedirect('/home');
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testResetPasswordError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this->post('/password/reset',
            [
                'email' => $userData['email'],
                'password' => 'password-new',
                'password_confirmation'=> 'password-new',
                'token' => 'wrong-token'
            ]
        );

        $response->assertRedirect('/');
    }
}
