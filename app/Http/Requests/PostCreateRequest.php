<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'title' => 'Title',
            'message' => 'Message',
            'category' => 'Category'
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
            'title' => 'required|string|min:3|max:20',
            'message' => 'required|string|min:10|max:1460',
            'category' => 'required',
        ];
    }
    
    public function messages()
    {
        $required = ':attribute field is required';
        $string = ':attribute field has to be a string';
        $min = ":attribute field can't be shorter than :min characters";
        $max = ":attribute field can't be longer than :max characters";
        
        return [
            'title.required' => $required,
            'title.string' => $string,
            'title.min' => $min,
            'title.max' => $max,
            
            'message.required' => $required,
            'message.string' => $string,
            'message.min' => $min,
            'message.max' => $max,
            
            'category.required' => $required
        ];
    }
}