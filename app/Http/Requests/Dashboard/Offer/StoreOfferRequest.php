<?php

namespace App\Http\Requests\Dashboard\Offer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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

            'offer_title' => 'required|string|min:3',

            'user_id' => 'required|integer|exists:users,id',

            'offer_description' => 'required|string',

            'offer_image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'offer_price' => 'required|integer',

            'offer_start_at' => 'required|date|after:yesterday|date_format:Y-m-d',

            'offer_end_at' => 'required|date|after_or_equal:offer_start_at|date_format:Y-m-d',

            'offer_status' => 'required|in:pending,accept,refused' ,

        ];
    }
}