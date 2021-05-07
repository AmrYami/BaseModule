<?php

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Users\Models\User;

class UpdateUserProfileRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::$rules;
        $rules['email'] = 'required|max:255|unique:users,email,'.$this->id.',id';
        $rules['password'] = 'nullable|max:255|confirmed';
        $rules['role'] = '';
        return $rules;
    }
}
