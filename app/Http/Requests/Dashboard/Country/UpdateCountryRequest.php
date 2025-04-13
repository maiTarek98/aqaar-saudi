<?php

namespace App\Http\Requests\Dashboard\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCountryRequest extends FormRequest
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
            'admin_id' => 'sometimes|required|exists:admins,id',
            'country_name_ar' => ['sometimes' , 'required','string','min:3' , Rule::unique('countries')->ignore($this->country)],
            'country_name_en' => ['sometimes' , 'required','string','min:3', Rule::unique('countries')->ignore($this->country) ],
            'country_code' => 'sometimes|required|numeric',
            'country_iso' => 'sometimes|required|string',
            'country_flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country_status' => 'sometimes|required|string|in:enable,disable',
        ];
    }
}