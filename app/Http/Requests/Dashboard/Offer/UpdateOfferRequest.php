<?php

namespace App\Http\Requests\Dashboard\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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

            'offer_title' => 'sometimes|required|string|min:3',

            'user_id' => 'sometimes|required|integer|exists:users,id',

            'offer_description' => 'sometimes|required|string',

            'offer_image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'offer_price' => 'sometimes|required|integer',

            'offer_start_at' => 'sometimes|required|date|after:yesterday|date_format:Y-m-d',

            'offer_end_at' => 'sometimes|required|date|after_or_equal:offer_start_at|date_format:Y-m-d',

            'offer_status' => 'sometimes|required|in:pending,accept,refused' ,

        ];
    }
}