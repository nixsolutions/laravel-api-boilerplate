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
        return response()->json([
            'errors' => $errors
        ], $statusCode);
    }

    /**
     * @return JsonResponse
     */
    public function sendSuccessResponse()
    {
        return response()->json([], self::HTTP_CODE_OK);
    }
}
