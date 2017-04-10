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
        $response = $this->post('/register',
            [
                'email' => $this->userData['email'],
                'password' => $this->userData['password'],
                'password_confirmation' => $this->userData['password_confirmation'],
                'name' => $this->userData['name']
            ]
        );

        $response->assertRedirect('/home');
    }

    /**
     *
     */
    public function testRegisterError()
    {
        $response = $this->post('/register',
            [
                'email' => $this->userData['email'],
                'password' => $this->userData['password'],
                'password_confirmation' => 'wrong-password',
                'name' => $this->userData['name']
            ]
        );

        $response->assertRedirect('/');
    }
}
