<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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

    function attributes()
    {
        return [
            'name' => 'Category name'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:20|unique:category,name'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'name.string' => ':attribute has to be a string',
            'name.min' => ":attribute can't be shorter than :min characters",
            'name.max' => ":attribute can't be longer than :max characters",
            'name.unique' => ':attribute already exists...'
        ];
    }
}