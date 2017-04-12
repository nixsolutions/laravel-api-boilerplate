<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use DB;

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

        $this->post('/password/email',
            [
                'email' => $userData['email']
            ]
        );

        $token = DB::table('password_resets')->where('email', $userData['email'])->value('token');

        $isTokenExist = ($token) ? true : false;

        $this->assertTrue($isTokenExist);
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param $userData
     */
    public function testForgotPasswordError($userData)
    {
        factory(User::class)->create($userData);

        $this->post('/password/email',
            [
                'email' => 'wrong-user@email.com'
            ]
        );

        $token = DB::table('password_resets')->where('email', 'wrong-user@email.com')->value('token');

        $isTokenExist = ($token) ? true : false;

        $this->assertFalse($isTokenExist);
    }
}