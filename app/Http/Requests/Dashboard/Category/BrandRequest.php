<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $brandId = $this->route('brand') ? $this->route('brand')->id : null; // Adjust as needed
        return [
            'added_by' => 'required|exists:users,id',
            'title_ar' => "required|string|min:3|max:255|unique:brands,title_ar,{$brandId}",
            'title_en' => "required|string|min:3|max:255|unique:brands,title_en,{$brandId}",
            'status' => 'required|in:show,hide',     
            'in_home' => 'required|in:yes,no',           
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'brands_image' => 'required|mimes:png,jpeg,jpg,webp|max:51200',
         ];
    }

    protected function update()
    {
         return [
            'brands_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp|max:51200',
         ];
    }
}