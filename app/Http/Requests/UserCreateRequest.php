<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'Username',
            'email' => 'email',
            'birthDate' => 'Birth date'
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
            'name' => 'required|string|min:3|max:15|unique:user,name',
            'email' => 'required|string|min:3|max:100',
            'birthDate' => 'required|date'
        ];
    }
    
    public function messages()
    {
        $required = ':attribute field is required';
        $string = ':attribute field has to be a string';
        $min = ":attribute field can't be shorter than :min characters";
        $max = ":attribute field can't be longer than :max characters";
        
        return [
            'name.required' => $required,
            'name.string' => $string,
            'name.min' => $min,
            'name.max' => $max,
            'name.unique' => ':attribute already exists...',
            
            'email.required' => $required,
            'email.string' => $string,
            'name.min' => $min,
            'email.max' => $max,
            
            'birthDate.required' => $required,
            'birthDate.date' => ':attribute field must be date'
        ];
    }
}