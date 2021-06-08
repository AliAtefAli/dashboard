<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
