<?php

namespace Users\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules['name'] = 'required|max:255';
        $rules['email'] = 'required|max:255|unique:users,email,'.$this->id.',id';
        $rules['mobile'] = 'required|max:255|unique:users,mobile,'.$this->id.',id';
        return $rules;
    }
}
