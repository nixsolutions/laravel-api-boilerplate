<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Interfaces\ResponseCodesInterface;
use App\Helpers\JsonApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\PasswordService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

/**
 * Class ForgotPasswordController
 * @package App\Http\Controllers\Api\v1\Auth
 */
class ForgotPasswordController extends Controller implements ResponseCodesInterface
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails, JsonApiResponseHelper;

    /**
     * ForgotPasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @SWG\Post(path="/password/forgot",
     *   tags={"User actions"},
     *   summary="Perform user password forgot",
     *   description="forgot user password",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="forgot password object",
     *     description="JSON Object which forgot user password",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="email", type="string", example="user@mail.com")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     *
     * @param PasswordService $passwordService
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function sendResetLinkEmail(PasswordService $passwordService, Request $request)
    {
        $errors = $this->validateRequest($request->all())->errors();

        if (!empty($errors->all())) {
            return $this->sendFailedResponse($errors->toArray(), self::HTTP_CODE_UNPROCESSABLE_ENTITY);
        }

        $reset = $passwordService->sendResetPasswordEmail($request->get('email'));

        if ($reset) {
            return $this->sendSuccessResponse();
        }

        $errors = [
            [
                'status' => 404,
                'title' => 'Email error',
                'detail' => 'Entered email is not found. Please make sure you are using existing email address and try again.'
            ]

        ];

        return $this->sendFailedResponse($errors, self::HTTP_CODE_NOT_FOUND);
    }

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validateRequest(array $data)
    {
        $messages = [
            'email.required' => 'Email field can\'t be blank'
        ];

        return Validator::make($data, [
            'email' => 'required|email'
        ], $messages);
    }
}
