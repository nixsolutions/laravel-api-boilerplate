<?php

namespace App\Helpers\Interfaces;

/**
 * Interface JsonApiResponseHelperInterface
 * @package App\Helpers
 */
interface ResponseCodesInterface
{
    const HTTP_CODE_OK = 200;
    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_UNAUTHORIZED = 401;
    const HTTP_CODE_FORBIDDEN = 403;
    const HTTP_CODE_NOT_FOUND = 404;
    const HTTP_CODE_UNPROCESSABLE_ENTITY = 422;
}
