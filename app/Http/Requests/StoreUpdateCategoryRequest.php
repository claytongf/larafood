<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenantRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoryRequest extends FormRequest
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
        return [
            // 'name' => ["required","unique:categories,name,{$id},id","min:3,max:255"],
            'name' => ['required', new UniqueTenantRule('categories', $id), 'min:3,max:255'],
            'description' => ['required', 'min:3,max:10000'],
        ];
    }
}
