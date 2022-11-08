<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends UserCreateRequest
{
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'] = 'required|string|min:3|max:15|unique:user,name,'. $this->user->id;
        $rules['email'] = 'required|email|min:3|max:100|unique:user,email,'. $this->user->id;
        return $rules;
    }
}
