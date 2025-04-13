<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;
class ActivateAccountRequest extends FormRequest
{
    use ApiResponses;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile'            => 'required|exists:users,mobile',
            'verification_code' => 'required|numeric|digits:4',
        ];
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
