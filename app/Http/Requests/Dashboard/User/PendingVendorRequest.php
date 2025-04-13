<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendingVendorRequest extends FormRequest
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
            'full_name' => 'required|string|min:3|max:255',
            'shipping_address' => 'required|string|min:3|max:700',
            'brand_name' => 'required|string|min:3|max:255',
            'commercial_registration_no' => 'nullable|string|min:6|max:15',
            'connected_mobile' => 'nullable|numeric|digits:10',
            'tax_no' => 'nullable|string|max:50',
            'mobile' => 'required|numeric|digits:10',
            'another_mobile' => 'nullable|numeric|digits:10',
            // 'bank_account_no' => 'nullable|string|min:10|max:20|required_without:vodafone_cash_mobile',
            // 'vodafone_cash_mobile' => 'nullable|numeric|digits:10|required_without:bank_account_no',
            'email' => 'required|email',
            'tax_image' => 'sometimes|nullable|array',
            'tax_image.*' => 'mimes:png,jpeg,jpg,webp|max:51200',
            'commercial_registration_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp|max:51200',
		]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
         ];
    }

    protected function update()
    {
         return [
         ];
    }
}
