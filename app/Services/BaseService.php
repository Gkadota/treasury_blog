<?php

namespace App\Services;

use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseService {

    use ValidatesRequests;

    protected function validateRequest(array $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validate = true;
        $messageReturn = [];
        $validator = $this->getValidationFactory()->make($request, $rules, $messages, $customAttributes);
        if ($validator->fails() === true) {
            $messageReturn = $validator->errors()->getMessages();
            $validate = false;
        }

        return ['success' => $validate, 'data' => $messageReturn];
    }


    protected function formatResponse(bool $validate, array $content = [])
    {
       return response()->json(['success' => $validate, 'data' => $content]);
    }
}
