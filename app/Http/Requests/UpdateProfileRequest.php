<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'image|mimes:jpg,jpeg,png',
            'address' => 'sometimes|required|max:255',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
