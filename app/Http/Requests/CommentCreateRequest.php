<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
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
            'message' => 'Message'
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
            'message' => 'required|string|min:1|max:1460'
        ];
    }
    
    public function messages()
    {
        return [
            'message.required' => ':attribute is required',
            'message.string' => ':attribute has to be a string',
            'message.min' => ":attribute can't be shorter than :min characters",
            'message.max' => ":attribute can't be longer than :max characters"
        ];
    }
}