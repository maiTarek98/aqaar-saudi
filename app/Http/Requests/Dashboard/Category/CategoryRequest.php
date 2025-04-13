<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('category') ? $this->route('category')->id : null; // Adjust as needed
        return [
            'added_by' => 'required|exists:users,id',
            'title_ar' => "required|string|min:3|max:255|unique:categories,title_ar,{$categoryId}",
            'title_en' => "required|string|min:3|max:255|unique:categories,title_en,{$categoryId}",
            'status' => 'required|in:show,hide',  
            'in_home' => 'required|in:yes,no',                 
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'categorys_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,avif|max:51200',
         ];
    }

    protected function update()
    {
         return [
            'categorys_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp,avif|max:51200',
         ];
    }
}