<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $storeId = $this->route('store') ? $this->route('store')->id : null; // Adjust as needed
        return [
            'added_by' => 'required|exists:users,id',
            'user_id' => 'sometimes|nullable|exists:users,id',
            'orders_return_period' => 'sometimes|nullable|integer',
            'name' => "required|string|min:3|max:255|unique:stores,name,{$storeId}",
            'status' => 'required|in:show,hide',  
            
            'reminder_hours_pending' => 'sometimes|nullable|integer',
            'reminder_hours_accepted' => 'sometimes|nullable|integer',
            'reminder_hours_shipped' => 'sometimes|nullable|integer',

     ]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
         return [
            'stores_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp|max:51200',
         ];
    }

    protected function update()
    {
         return [
            'stores_image' => 'sometimes|nullable|mimes:png,jpeg,jpg,webp|max:51200',
         ];
    }
}