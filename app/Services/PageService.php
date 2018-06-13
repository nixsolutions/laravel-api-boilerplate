<?php

namespace App\Services;

use Auth;

class PageService
{
    /**
     * @return bool|array
     */
    public function checkAccess()
    {
        $pageIds = Auth::guard('api')->user()->pages()->pluck('id')->toArray();

        $requestPageId = request()->route('record')->getAttributes()['id'];

        if (!in_array($requestPageId, $pageIds)) {
            $errors['forbidden'] =  'You don\'t have permission to access this resource.';

            if (request()->method() == 'PUT') $errors['sources'][] =  ['pointer' => '/data/id'];

            return $errors;
        }

        return true;
    }
}
