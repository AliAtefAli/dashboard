<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        $trashedUsersPhone = User::onlyTrashed()->pluck('phone')->toArray();
        $trashedUsersEmail = User::onlyTrashed()->pluck('email')->toArray();

        return [
            'phone'=> ['required', 'phone:SA,EG',
                Rule::unique('users', 'phone')->where(function ($query) use ($trashedUsersPhone) {
                    $query->whereNotIn('phone', $trashedUsersPhone);
                    return $query;
                })
                ],
            'name' => 'required|string|min:3|max:141',
            'email'=> ['required', 'email',
                Rule::unique('users', 'email')->where(function ($query) use ($trashedUsersEmail) {
                    $query->whereNotIn('email', $trashedUsersEmail);
                    return $query;
                })
            ],
            'type'=>'required',
            'status'=>'required',
            'password' => 'required|confirmed|min:8',
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
            'password.required' => (trans('validation.field_required_password')),
            'password.min' =>(trans('validation.field_min_8')),
            'password.confirmed' => (trans('validation.password_confirmed')),
            'image.image' => (trans('validation.field_image')),
            'address.required' => (trans('validation.field_required_address')),
        ];
    }
}
