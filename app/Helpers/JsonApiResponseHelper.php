<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

/**
 * Class jsonApiResponseHelper
 * @package Helpers
 */
trait JsonApiResponseHelper
{
    /**
     * @param array $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendFailedResponse(array $errors, int $statusCode)
    {
        $errorsJson = [];
        if (!empty($errors['email'])) {
            $emailError = [
                'status' => $statusCode,
                'title'  => 'Email error',
                'detail' => $errors['email'][0]
            ];
            array_push($errorsJson, $emailError);
        }

        if (!empty($errors['password'])) {
            $passwordError = [
                'status' => $statusCode,
                'title'  => 'Password error',
                'detail' => $errors['password'][0]
            ];
            array_push($errorsJson, $passwordError);
        }

        if (!empty($errors['password_confirmation'])) {
            $passwordConfirmationError = [
                'status' => $statusCode,
                'title'  => 'Password error',
                'detail' => $errors['password_confirmation'][0]
            ];
            array_push($errorsJson, $passwordConfirmationError);
        }

        if (!empty($errors['name'])) {
            $nameError = [
                'status' => $statusCode,
                'title'  => 'Name error',
                'detail' => $errors['name'][0]
            ];
            array_push($errorsJson, $nameError);
        }

        if (!empty($errors['token'])) {
            $tokenError = [
                'status' => $statusCode,
                'title'  => 'Token error',
                'detail' => $errors['token']
            ];
            array_push($errorsJson, $tokenError);
        }

        if (!empty($errors['token'])) {
            $tokenError = [
                'status' => $statusCode,
                'title'  => 'Token error',
                'detail' => $errors['token']
            ];
            array_push($errorsJson, $tokenError);
        }

        if (!empty($errors['activation_hash'])) {
            $activationHashError = [
                'status' => $statusCode,
                'title'  => 'Activation hash error',
                'detail' => $errors['activation_hash'][0]
            ];
            array_push($errorsJson, $activationHashError);
        }

        $errorsJson = ($errorsJson) ? $errorsJson : $errors;

        $responseJson = response()->json([
            'errors' =>
                $errorsJson
        ], $statusCode);

        return $responseJson;
    }

    /**
     * @return JsonResponse
     */
    public function sendSuccessResponse()
    {
        return response()->json([], self::HTTP_CODE_OK);
    }
}
