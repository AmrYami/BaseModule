<?php

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$this->route('user'),
            'mobile' => 'regex:/[0-9]{6,20}/|nullable|required_unless:role,2',
        ];
    }
}
