<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $response = $this->post('/register',
            [
                'email' => $userData['email'],
                'password' => $userData['password'],
                'password_confirmation' => $userData['password_confirmation'],
                'name' => $userData['name']
            ]
        );

        $response->assertRedirect('/home');
    }

    /**
     * @dataProvider registerUserProvider
     *
     * @param $userData
     *
     */
    public function testRegisterError($userData)
    {
        $response = $this->post('/register',
            [
                'email' => $userData['email'],
                'password' => $userData['password'],
                'password_confirmation' => 'wrong-password',
                'name' => $userData['name']
            ]
        );

        $response->assertRedirect('/');
    }
}
