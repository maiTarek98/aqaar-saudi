<?php

namespace App\Http\Requests\Dashboard\Banner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'banner_name' => 'sometimes|required|string',
            'banner_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}