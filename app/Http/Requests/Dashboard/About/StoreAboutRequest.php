<?php

namespace App\Http\Requests\Dashboard\About;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutRequest extends FormRequest
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
            'title_ar' => 'required|string|min:3|max:255',
            'subtitle_ar' => 'sometimes|nullable|string|min:3|max:7255',
            'feature_title_ar' => 'required|string|min:3|max:255',
            'title_en' => 'required|string|min:3|max:255',
            'subtitle_en' => 'sometimes|nullable|string|min:3|max:7255',
            'feature_title_en' => 'required|string|min:3|max:255',
            'feature_ar' => 'required|string|min:3|max:2255',
            'feature_en' => 'required|string|min:3|max:2255',
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