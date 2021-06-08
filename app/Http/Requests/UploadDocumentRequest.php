<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file.*' => 'required|mimes:png,jpg,jpeg,pdf'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
