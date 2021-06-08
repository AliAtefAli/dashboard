<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title" => "required",
            "body" => "required",
            "receiver_id" => "required",
            "type" => "required"
        ];
    }

    public function authorize()
    {
        return true;
    }
}
