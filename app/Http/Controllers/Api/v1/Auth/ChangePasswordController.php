<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\Interfaces\ResponseCodesInterface;
use App\Http\Controllers\Controller;
use App\Services\PasswordService;
use App\Helpers\JsonApiResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ChangePasswordController
 * @package App\Http\Controllers\Api\v1\Auth
 */
class ChangePasswordController extends Controller implements ResponseCodesInterface
{
    use JsonApiResponseHelper;

    /**
     * @SWG\Post(path="/password/change",
     *   tags={"User actions"},
     *   summary="Change user password",
     *   description="Change user password",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *     @SWG\Parameter(
     *     in="body",
     *     name="change password",
     *     description="JSON Object which change user password",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="current_password", type="string", example="87654321"),
     *         @SWG\Property(property="password", type="string", example="87654321"),
     *         @SWG\Property(property="password_confirmation", type="string", example="87654321")
     *     )
     *   ),
     *   @SWG\Response(response="200", description="Return message")
     * )
     */

    public function change(PasswordService $passwordService, Request $request)
    {
        $errors = $this->validator($request->all())->errors();

        if (!empty($errors->all())) {
            return $this->sendFailedResponse($errors->toArray(), self::HTTP_CODE_BAD_REQUEST);
        }

        $changed = $passwordService->changePassword($request);

        if ($changed) {
            return $this->sendSuccessResponse();
        }

        $errors = ['password' => ['Wrong credentials']];

        return $this->sendFailedResponse($errors, self::HTTP_CODE_BAD_REQUEST);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|confirmed|min:6'
        ]);
    }
}
