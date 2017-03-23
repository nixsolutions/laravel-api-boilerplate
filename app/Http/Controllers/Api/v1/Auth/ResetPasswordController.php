<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @SWG\Post(path="/password/reset",
     *   tags={"User actions"},
     *   summary="Perform user password reset",
     *   description="reset user password",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="reset password",
     *     description="JSON Object which reset user password",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="email", type="string", example="user@user.com"),
     *         @SWG\Property(property="password", type="string", example="87654321"),
     *         @SWG\Property(property="password_confirmation", type="string", example="87654321")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     */
}
