<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'project_id' => 'required',
            'step_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
