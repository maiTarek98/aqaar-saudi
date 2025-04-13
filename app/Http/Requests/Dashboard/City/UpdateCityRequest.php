<?php

namespace App\Http\Requests\Dashboard\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCityRequest extends FormRequest
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
            'city_name_ar' => ['sometimes' , 'required','string','min:3' , Rule::unique('cities')->ignore($this->city)],
            'city_name_en' => ['sometimes' , 'required','string','min:3' , Rule::unique('cities')->ignore($this->city)],
            'country_id' => 'sometimes|required|exists:countries,id',
            'city_status' => 'sometimes|required|string|in:enable,disable',
        ];
    }
}
