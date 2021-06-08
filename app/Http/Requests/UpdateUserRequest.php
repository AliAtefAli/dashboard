<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $trashedUsersPhone = User::onlyTrashed()->pluck('phone')->toArray();
        $trashedUsersEmail = User::onlyTrashed()->pluck('email')->toArray();

        return [
            'phone'=> ['required', 'phone:SA,EG', Rule::unique('users', 'phone')->where(function ($query) use ($trashedUsersPhone) {
                $query->whereNotIn('phone', $trashedUsersPhone);
                $query->where('id', '!', $this->id);
                return $query;
            }), Rule::unique('users')->ignore($this->id, 'id')
            ],
            'name' => 'required|string|min:3|max:141',
            'email'=> ['required', 'email', Rule::unique('users', 'email')->where(function ($query) use ($trashedUsersEmail) {
                $query->whereNotIn('email', $trashedUsersEmail);
                $query->where('id', '!', $this->id);
                return $query;
            }), Rule::unique('users')->ignore($this->id, 'id')
            ],
            // 'type'=>'required',
            // 'status'=>'required',
            'image' => 'image|mimes:jpg,jpeg,svg,png',
        ];
    }

    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'phone.required' => (trans('validation.field_required_phone')),
            'phone.unique' => (trans('validation.field_exists_phone')),
            'phone.phone' => (trans('validation.Please Enter Correct saudi arabia phone')),
            'name.required' => (trans('validation.field_required_name')),
            'name.min' => (trans('validation.field_min_3')),
            'email.required' => (trans('validation.field_required_email')),
            'email.email' => (trans('validation.field_email')),
            'email.unique' => (trans('validation.field_exists_email')),
            'type.required' => (trans('validation.field_required_type')),
            'status.required' => (trans('validation.field_required_status')),
            'image.image' => (trans('validation.field_image')),
            'address.required' => (trans('validation.field_required_address')),
        ];
    }
}
