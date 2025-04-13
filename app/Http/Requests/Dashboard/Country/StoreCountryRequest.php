<?php

namespace App\Http\Requests\Dashboard\Country;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCountryRequest extends FormRequest
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
            'admin_id' => 'required|exists:admins,id',
            'country_name_ar' => ['required','string','min:3' , Rule::unique('countries')->ignore($this->country)],
            'country_name_en' => ['required','string','min:3', Rule::unique('countries')->ignore($this->country) ],
            'country_code' => 'required|numeric',
            'country_iso' => 'required|string',
            'country_flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country_status' => 'required|string|in:enable,disable',
        ];
    }
}
