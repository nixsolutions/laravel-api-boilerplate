<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Interfaces\ResponseCodesInterface;
use App\Helpers\JsonApiResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Validator;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Api\v1\Auth
 */
class ResetPasswordController extends Controller implements ResponseCodesInterface
{
    use ResetsPasswords, JsonApiResponseHelper;

    /**
     * ResetPasswordController constructor.
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
     *         @SWG\Property(property="email", type="string", example="user@mail.com"),
     *         @SWG\Property(property="password", type="string", example="87654321"),
     *         @SWG\Property(property="password_confirmation", type="string", example="87654321"),
     *         @SWG\Property(property="token", type="string", example="87654321")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     */

    public function reset(Request $request)
    {
        $errors = $this->validateRequest($request->all())->errors();

        if (!empty($errors->all())) {
            return $this->sendFailedResponse($errors->toArray(), self::HTTP_CODE_UNPROCESSABLE_ENTITY);
        }

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return
            $response == Password::PASSWORD_RESET
            ? $this->sendSuccessResponse()
            : $this->sendFailedResponse(
                ['token' => 'Your reset link has expired. Please try to resend it again.'],
                self::HTTP_CODE_BAD_REQUEST
            );
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validateRequest(array $data)
    {
        $messages = [
            'required' => ':Attribute can\'t be blank',
            'password_confirmation.same' => 'Your passwords don\'t match'
        ];

        return Validator::make($data, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ], $messages);
    }
}
