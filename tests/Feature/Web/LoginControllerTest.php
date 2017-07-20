<?php

namespace Tests\Feature\Web;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @dataProvider  addDataProvider
     *
     * @param $userData
     *
     */
    public function testLogin($userData)
    {
        $userData['password'] = Hash::make('password');

        factory(User::class)->create($userData);

        $response = $this
            ->post('/login',
            [
                'email' => $userData['email'],
                'password' => 'password'
            ]
        );

        $response->assertRedirect('home');
    }

    /**
     * @dataProvider  addDataProvider
     *
     * @param $userData
     *
     */
    public function testLoginError($userData)
    {
        factory(User::class)->create($userData);

        $response = $this
            ->post('/login',
                [
                    'email' => $userData['email'],
                    'password' => 'password-wrong'
                ]
            );

        $response->assertRedirect('/');
    }
}
