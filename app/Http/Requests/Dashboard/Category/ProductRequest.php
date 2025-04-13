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
            'category_id'           => 'required|numeric|exists:categories,id',
            'subcategory_id'        => 'sometimes|nullable|numeric|exists:categories,id',
            'name_ar'               => ['required','min:2', 'max:255'],
            'name_en'               => ['required','min:2', 'max:255'],
            'price'                 => 'required|numeric',
            'discount'              => 'sometimes|nullable|numeric',
            'discount_type'         => 'required_with:discount|string|in:percent,pound',
            'sku'                   => 'sometimes|nullable|string|min:2|max:255',
            'barcode'               => 'sometimes|nullable|string|min:2|max:255',
            'description_ar'        => 'sometimes|nullable|string|min:2|max:2500',
            'description_en'        => 'sometimes|nullable|string|min:2|max:2500',
            // 'slug'                  => ['required','min:2', 'max:1255', Rule::unique('products')->ignore($this->product)],
            'meta_description'      => 'sometimes|nullable|string|min:2|max:2500',
            'meta_tag'              => 'sometimes|nullable|string|min:2|max:2500',
            'status'                => 'sometimes|nullable|string|in:show,hide',
            'category_year_id'      => 'sometimes|nullable',
            'tags'                  => 'sometimes|nullable',
            'new_arrival'           => 'sometimes|nullable|string|in:yes,no',
            'link_video'            => 'sometimes|nullable|string',
            'is_in_home'            => 'sometimes|nullable|string|in:yes,no',

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