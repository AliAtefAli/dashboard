<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveOptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'required',
            'project_steps_id' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
