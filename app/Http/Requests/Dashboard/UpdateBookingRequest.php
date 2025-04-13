<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'feature_icon_one' => 'sometimes|nullable|image',
            'feature_icon_two' => 'sometimes|nullable|image',
            'feature_icon_three' => 'sometimes|nullable|image',
            'feature_icon_four' => 'sometimes|nullable|image',

            'feature_title_one_ar' => 'sometimes|nullable|string',
            'feature_title_two_ar' => 'sometimes|nullable|string',
            'feature_title_three_ar' => 'sometimes|nullable|string',
            'feature_title_four_ar' => 'sometimes|nullable|string',

            'feature_body_one_ar' => 'sometimes|nullable|string',
            'feature_body_two_ar' => 'sometimes|nullable|string',
            'feature_body_three_ar' => 'sometimes|nullable|string',
            'feature_body_four_ar' => 'sometimes|nullable|string',

            'feature_title_one_en' => 'sometimes|nullable|string',
            'feature_title_two_en' => 'sometimes|nullable|string',
            'feature_title_three_en' => 'sometimes|nullable|string',
            'feature_title_four_en' => 'sometimes|nullable|string',

            'feature_body_one_en' => 'sometimes|nullable|string',
            'feature_body_two_en' => 'sometimes|nullable|string',
            'feature_body_three_en' => 'sometimes|nullable|string',
            'feature_body_four_en' => 'sometimes|nullable|string',
            'up_about_ar' => 'sometimes|nullable|string',
            'up_about_en' => 'sometimes|nullable|string',

        ];
    }
}