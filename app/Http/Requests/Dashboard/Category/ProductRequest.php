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
        if(request('form_type') == 'add_property'){
            $val_type = 'required|string|in:auction,shared,investment';
        }else{
            $val_type = 'sometimes|nullable|string|in:auction,shared,investment';
        }
        return [ 
            'added_by'              => 'sometimes|nullable|numeric|exists:users,id',
            'product_for'           => 'required|string|in:rent,sale',
            'owner_id '             => 'sometimes|nullable|numeric|exists:users,id',
            'area_id'               => 'sometimes|nullable|numeric|exists:locations,id',
            'type'                  => $val_type,
            'title'                 => ['required','min:2', 'max:255'],
            'price'                 => 'sometimes|nullable|numeric',
            'investment_min'        => 'sometimes|nullable|integer',
            'start_date' => 'sometimes|nullable|date|after_or_equal:today',
            'end_date'   => 'sometimes|nullable|date|after_or_equal:start_date',
            'is_private'            => 'sometimes|nullable|boolean',
            'in_home'               => 'sometimes|nullable|string|in:yes,no',
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
            'area'                  => 'sometimes|nullable|string',
            'area_after_development'=> 'sometimes|nullable|string',
            'valuation'             => 'sometimes|nullable|numeric',
            'valuation_date'        => 'sometimes|nullable|date',
            'additional_info'       => 'sometimes|nullable|string',
            'license_number'        => 'sometimes|nullable|numeric',
            'annual_rent'           => 'sometimes|nullable|numeric',
            'remaining_lease_years' => 'sometimes|nullable|string',
            'valuation_type'        => 'sometimes|nullable|boolean',
            'accepts_mortgage'      => 'sometimes|nullable|boolean',
            'usufruct_lease'        => 'sometimes|nullable|boolean',
            'is_rented'             => 'sometimes|nullable|boolean',
            'penalty_type'          => 'sometimes|nullable',
            'represented_by'        => 'sometimes|nullable|string|in:owner,agent,co-owner,other',
            'product_type'          => 'sometimes|nullable|string|in:residential,commercial,two',
            'owner_type'            => 'sometimes|nullable|string|in:other,company,individual',
            'link_video'            => 'sometimes|nullable|string',
            'document'              => 'sometimes|nullable|array',
            'agree'                 => 'required|accepted',
            'features'              => 'sometimes|nullable|array',

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