<?php

namespace App\Rules;

use Illuminate\Validation\Rule;
use App\Models\User;
class UserRules extends BaseRules
{
    public function insertUserRules()
    {
        return [
            'first_name'  => ['required', 'string' ,'max:30'],
            'last_name'   => ['required', 'string' ,'max:30'],
            'email'       => ['required','email','string', 'unique:t_users'],
            'password'    => ['required', 'string', 'min:8'],
            'user_type'   => ['required', 'string', Rule::in(['admin', 'blogger']),]
        ];
    }

    public function updateUserRules(string $userId)
    {
        return [
            'user_id'     => ['required', 'string',  'max:30', 'exists:t_users'],
            'first_name'  => ['sometimes', 'string',  'max:30'],
            'last_name'   => ['sometimes', 'string',  'max:30'],
            'email'       => ['sometimes','email' ,'string', Rule::unique('t_users')->ignore($userId, 'user_id')],
            'password'    => ['sometimes', 'string', 'min:3'],
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
