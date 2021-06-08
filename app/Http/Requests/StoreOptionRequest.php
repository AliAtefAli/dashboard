<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'project_steps_id' => 'required',
            'image_1' => 'required|image|mimes:jpg,jpeg,svg,png',
            'image_2' => 'sometimes|nullable|image|mimes:jpg,jpeg,svg,png',
            'image_3' => 'sometimes|nullable|image|mimes:jpg,jpeg,svg,png',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
