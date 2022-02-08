<?php

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|max:255|min:8|confirmed',
            'password_confirmation' => 'same:password',
        ];
    }
}
