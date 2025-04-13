<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class LoginRequest extends FormRequest
{
    use ApiResponses;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile'   => 'required|numeric|digits:10',  
            'password' => 'required|string|min:6|max:20',
		] ;
    }

    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            throw new HttpResponseException($this->errorResponse($validator->errors()->first()));
        } else {
            throw new HttpResponseException(
                redirect()->back()->withErrors($validator)->withInput()
            );
        }
    }

}
