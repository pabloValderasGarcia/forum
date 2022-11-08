<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends PostCreateRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['title'] = 'required|string|min:3|max:20,' . $this->post->id;
        $rules['message'] = 'required|string|min:10|max:1460,' . $this->post->id;
        $rules['category'] = 'required,' . $this->post->id;
        return $rules;
    }
}
