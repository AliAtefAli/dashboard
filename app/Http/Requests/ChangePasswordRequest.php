<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
