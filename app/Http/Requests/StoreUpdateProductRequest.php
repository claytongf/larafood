<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenantRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
            'name' => ['required', new UniqueTenantRule('products', $id), 'min:3', 'max:255'],
            'description' => ['required', 'min:3,max:500'],
            'image' => ['required', 'image'],
            'price' => ['required', "regex:/^\d+(\.\d{1,2})?$/"]
        ];
        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }
        return $rules;
    }
}
