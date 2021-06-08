<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ar.title' => 'required|max:255',
            'en.title' => 'required|max:255',
            'path' => 'required',
            'project_steps_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
