<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => 'required|string|min:8|confirmed',
            'code' => 'required',
            'user_id' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
