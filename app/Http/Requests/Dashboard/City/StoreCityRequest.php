<?php

namespace App\Http\Requests\Dashboard\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCityRequest extends FormRequest
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
            'city_name_ar' => ['required','string','min:3' , Rule::unique('cities')->ignore($this->city)],
            'city_name_en' => ['required','string','min:3' , Rule::unique('cities')->ignore($this->city)],
            'country_id' => 'required|exists:countries,id',
            'city_status' => 'required|string|in:enable,disable',
        ];
    }
}
