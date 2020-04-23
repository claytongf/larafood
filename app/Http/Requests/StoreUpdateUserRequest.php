<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
        $id = $this->segment(3);
        $rules = [
            'name' => "required|min:3|max:255|string",
            'email' => "required|email|min:3|max:255|unique:users,email,{$id},id",
            'password' => 'required|string|min:6|max:20'
        ];
        if($this->method() == "PUT"){
            $rules['password'] = 'nullable|string|min:6|max:20';
        }
        return $rules;
    }
}
