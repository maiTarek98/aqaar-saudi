<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ApiResponses;

class StoreUserRequest extends FormRequest
{
    use ApiResponses;
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
            'name' => ['required','min:2', 'max:130'],
            'photo_profile' => 'sometimes|nullable|image',      
            'pending_vendor_id' => 'sometimes|nullable|integer',      
            'parent_id' => 'sometimes|nullable|integer',      
		]  
        +
         ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        $rules= [
            'mobile'   => 'required|numeric|digits:10|unique:users,mobile',  
            'password' => 'required|string|min:6|max:20',
        ];
        if ($this->expectsJson()) {
            $rules['email'] = 'nullable|email|unique:users,email';
        }else{
            if(request('account_type') == 'users'){
                $rules['email'] = 'nullable|email|unique:users,email';
                // $rules['id_number'] = 'required|numeric';
                // $rules['agency_number'] = 'required_if:user_type,agent|numeric';

            }else{
                $rules['email'] = 'required|email|unique:users,email';
            }
        }

        return $rules;
    }

    protected function update()
    {
        $id = (int)$this->user_id;
        $rules= [
            'mobile'   => 'required|numeric|digits:10|unique:users,mobile,'.$id,  
            'password' => 'sometimes|nullable|string|min:6|max:20',
        ];
        if ($this->expectsJson()) {
            $rules['email'] = 'sometimes|email|unique:users,email,'.$id;
        }else{
            if(request('account_type') == 'users'){
                $rules['email'] = 'nullable|email|unique:users,email,'.$id;
                // $rules['id_number'] = 'required|numeric';
                // $rules['agency_number'] = 'required_if:user_type,agent|numeric';
            }else{
                $rules['email'] = 'required|email|unique:users,email,'.$id;
            }
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        if (request()->expectsJson()) {
            throw new HttpResponseException($this->errorResponse($validator->errors()->first()));
        } else {
            throw new HttpResponseException(
                redirect()->back()->withErrors($validator)->withInput()
            );
        }
    }

}
