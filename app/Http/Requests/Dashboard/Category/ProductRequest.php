<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
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
            'added_by'              => 'required|numeric|exists:users,id',
            'product_for'           => 'required|string|in:rent,sale',
            'owner_id '             => 'sometimes|nullable|numeric|exists:users,id',
            'area_id'               => 'sometimes|nullable|numeric|exists:locations,id',
            'type'                  => 'required|string|in:auction,shared,investment',
            'title'                 => ['required','min:2', 'max:255'],
            'price'                 => 'sometimes|nullable|numeric',
            'start_date'            => 'sometimes|nullable|date',
            'end_date'              => 'sometimes|nullable|date',
            'is_private'            => 'sometimes|nullable|boolean',
            'in_home'            => 'sometimes|nullable|string|in:yes,no',
            'status'                => 'required|string|in:pending,shared_onsite,approved,rejected,closed',
            'map_location'          => 'sometimes|nullable|string',
            'qr_code'               => 'sometimes|nullable|string',
            'description'           => 'sometimes|nullable|string|min:2|max:2500',
            
            //product features
            'has_planning_diagram'  => 'sometimes|nullable|boolean',
            'has_electronic_deed'   => 'sometimes|nullable|boolean',
            'has_real_estate_market'=> 'sometimes|nullable|boolean',
            'has_survey_decision'   => 'sometimes|nullable|boolean',
            'has_mortgage'          => 'sometimes|nullable|boolean',
            'has_penalties'         => 'sometimes|nullable|boolean',
            'plan_number'           => 'sometimes|nullable|string',
            'plot_number'           => 'sometimes|nullable|string',
            'area'                  => 'sometimes|nullable|numeric',
            'area_after_development'=> 'sometimes|nullable|numeric',
            'valuation'             => 'sometimes|nullable|numeric',
            'valuation_date'        => 'sometimes|nullable|date',
            'additional_info'       => 'sometimes|nullable|string',
            'license_number'        => 'sometimes|nullable|numeric',
            'annual_rent'           => 'sometimes|nullable|numeric',
            'remaining_lease_years' => 'sometimes|nullable|integer',
            'valuation_type'        => 'sometimes|nullable|boolean',
            'accepts_mortgage'      => 'sometimes|nullable|boolean',
            'usufruct_lease'        => 'sometimes|nullable|boolean',
            'is_rented'             => 'sometimes|nullable|boolean',
            'penalty_type'          => 'sometimes|nullable|string|in:cash,installment',
            'represented_by'        => 'sometimes|nullable|string|in:owner,agent,co-owner,other',
            'product_type'          => 'sometimes|nullable|string|in:residential,commercial',
            'owner_type'            => 'sometimes|nullable|string|in:other,company,individual',
            'link_video'            => 'sometimes|nullable|string',
            'document'              => 'sometimes|nullable|array',
         ]
         +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'products_image'        => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16048',
         ];
    }

    protected function update()
    {
         return [
            'products_image'        => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:16048',
         ];
    }
}