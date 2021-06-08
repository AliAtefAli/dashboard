<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStepRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ar.name' => ['required', 'min:3', 'max:255'],
            'en.name' => ['required', 'min:3', 'max:255'],
            'ar.description' => ['required', 'string'],
            'en.description' => ['required', 'string'],
            'ordered' => ['required', 'unique:steps'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'ordered.unique' => trans('validation.field_unique_ordered'),
        ];
    }
}
