<?php

namespace App\Http\Requests\Dashboard\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $blogId = $this->route('blog') ? $this->route('blog')->id : null; // Adjust as needed
        return [
            'added_by' => 'required|exists:users,id',
            'name_ar' => "required|string|min:3|max:255|unique:blogs,name_ar,{$blogId}",
            'content_ar' => 'sometimes|nullable|string|min:3|max:109255',
            'description_ar' => 'required|string|min:3|max:2255',
            'name_en' => "required|string|min:3|max:255|unique:blogs,name_en,{$blogId}",
            'content_en' => 'sometimes|nullable|string|min:3|max:109255',
            'description_en' => 'required|string|min:3|max:2255',
            'status' => 'required|in:show,hide',


            'meta_description'      => 'sometimes|nullable|string|min:2|max:2500',
            'meta_tag'              => 'sometimes|nullable|string|min:2|max:2500',
        
     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'blogs_image' => 'required|mimes:jpeg,png,jpg,webp|max:15240',
         ];
    }

    protected function update()
    {
         return [
            'blogs_image' => 'sometimes|nullable|mimes:jpeg,png,jpg,webp|max:15240',
         ];
    }
}