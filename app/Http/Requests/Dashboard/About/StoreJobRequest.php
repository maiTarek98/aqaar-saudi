<?php

namespace App\Http\Requests\Dashboard\About;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'job_title' => 'required|string|min:3|max:255',
            'job_description' => 'sometimes|nullable|string|min:2|max:7255',
            'job_type' => 'required|string|in:full_time,part_time,by_hour',
            'job_experience' => 'required|string|min:2|max:200',
            'location' => 'required|string|min:3|max:2255',
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