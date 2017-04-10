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
     *
     */
    public function testLogin()
    {
        $userVerifiedData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        factory(User::class)->create($userVerifiedData);

        $response = $this
            ->post('/login',
            [
                'email' => $userVerifiedData['email'],
                'password' => 'password'
            ]
        );

        $response->assertRedirect('home');
    }

    /**
     *
     */
    public function testLoginError()
    {
        $userVerifiedData = [
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
            'activated' => true
        ];

        factory(User::class)->create($userVerifiedData);

        $response = $this
            ->post('/login',
                [
                    'email' => $userVerifiedData['email'],
                    'password' => 'password-wrong'
                ]
            );

        $response->assertRedirect('/');
    }
}
