<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStepStatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'project_steps_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
