<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentEditRequest extends CommentCreateRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['message'] = 'required|string|min:1|max:1460,'. $this->comment->id;
        return $rules;
    }
}
