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
        if (isset($errors['email'])) {
            $emailError = [
                'status' => $statusCode,
                'title'  => 'Email error',
                'detail' => $errors['email'][0]
            ];
            array_push($errorsJson, $emailError);
        }

        if (isset($errors['password'])) {
            $passwordError = [
                'status' => $statusCode,
                'title'  => 'Password error',
                'detail' => $errors['password'][0]
            ];
            array_push($errorsJson, $passwordError);
        }

        if (isset($errors['name'])) {
            $nameError = [
                'status' => $statusCode,
                'title'  => 'Name error',
                'detail' => $errors['name'][0]
            ];
            array_push($errorsJson, $nameError);
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
