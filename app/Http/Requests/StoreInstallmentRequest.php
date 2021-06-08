<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstallmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ar.title' => 'required|max:255',
            'en.title' => 'required|max:255',
            'project_steps_id' => 'required',
            'price' => 'required',
            'note' => 'sometimes|required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
