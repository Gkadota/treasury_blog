<?php

namespace App\Rules;

use Illuminate\Validation\Rule;

class UserRules extends BaseRules
{
    public function insertUserRules()
    {
        return [
            'first_name'   => ['required', 'string',  'max:30'],
            'last_name'   => ['required', 'string',  'max:30'],
            'email'      => ['required', 'string', 'unique:t_users'],
            'password'   => ['required', 'string', 'min:8'],
            'user_type'  => ['required', 'string', Rule::in(['admin', 'blogger']),]
        ];
    }


    public function loginRules()
    {
        return [
            'email'      => ['required', 'string', 'exists:t_users'],
            'password'   => ['required', 'string'],
        ];
    }


    public function deleteUserRules()
    {
        return [
            'user_id'      => ['required', 'integer', 'exists:t_users'],
        ];
    }
}
