<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ar.name' => ['required', 'min:3', 'max:255'],
            'en.name' => ['required', 'min:3', 'max:255'],
            'ar.description' => ['required', 'string'],
            'en.description' => ['required', 'string'],
            'total_pay' => 'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png',
            'user_id' => 'required',
            'steps' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }


}
