<?php

namespace Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Users\Models\User;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$this->route('user'),
            'mobile' => 'regex:/(01)[0-9]{9}/|nullable|required_unless:role,2',
//            'type' => 'max:255',
        ];
    }
}
