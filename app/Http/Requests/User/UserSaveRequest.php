<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required|string|max:64',
            'email'     => 'required|email',
            'password'  => 'nullable|min:4|max:50',
            'roles'     => 'required|array',
        ];
    }
}
