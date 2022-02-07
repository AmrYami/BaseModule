<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
//use this class for every request using api extend it alternative FormRequest
class APIRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
//        $errors = [];
//        foreach ($validator->errors()->toArray() as $error) {
//            foreach ($error as $err) {
//                $errors[] = $err;
//            }
//        }
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
