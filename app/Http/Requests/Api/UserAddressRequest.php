<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;
class UserAddressRequest extends FormRequest
{
    use ApiResponses;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'type' => 'required|string|in:apartment,house,office',
            'mark' => 'required|string|min:3|max:1255',
            'label_name' => 'sometimes|nullable|string|min:3|max:1255',
            'street_name' => 'required|string|min:3|max:255',
            'apartment_no' => 'nullable|string|min:3|max:255',
            'floor_no' => 'required|string|min:3|max:255',
            'district_id' => 'required|integer|exists:locations,id',
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
