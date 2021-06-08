<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ConfirmCodeRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getCode(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {

            $request->validate([
                'email' => 'required|exists:users,email',
            ], [
                'email.exists' => (trans('validation.These credentials do not match our data.')),
            ]);

            $user = User::where('email', $request->get('email'))->first();

        } else {
            $request['email'] = User::cleanPhone($request->email)['phone'];
            $request->validate([
                'email' => 'required|exists:users,phone',
            ], [
                'email.exists' => (trans('validation.These credentials do not match our data.')),
            ]);

            $user = User::where('phone', $request->get('email'))->first();
        }

        User::sendVerificationCode($user);

        return view('auth.passwords.reset', compact('user'));
    }

    public function codeConfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
            'code' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return failReturn($validator->errors()->first());
        }
        $user = User::find($request->user_id);
        $request->flash();

        if ($user->code == $request->code && $user->code != null) {
            $password = Hash::make($request->password);
            $user->update([
                'password' => $password,
                'code' => null
            ]);
        } else {
            // return back()->with('error', trans('validation.field_wrong_code'));
            return failReturn(trans('validation.field_wrong_code'));
        }
        Auth::loginUsingId($user->id, true);
        // return redirect()->route('home')->with('success', trans('site.Password Changed Successfully'));
        return successReturnMsg(trans('site.alerts.password_changed_successfully'));
    }

    public function checkCode(VerifyCodeRequest $request)
    {
        $user = User::find($request->user_id);

        if ($user->code == $request->code && $user->code != null) {
            return successReturnMsg(trans('site.alerts.correct_code'));
        } else {
            return failReturn(trans('validation.field_wrong_code'));
        }
    }
    public function verify()
    {
        return view('auth.verify');
    }

    public function verifyUser(VerifyCodeRequest $request)
    {
        $user = auth()->user();

        if ($user->code == $request->code && $user->code != null) {
            $user->update([
                'code' => null,
                'email_verified_at' => now(),
                'status' => 'active'
            ]);
            return successReturnMsg(trans('site.alerts.confirmed_successfully'));
        } else {
            return failReturn(trans('validation.field_wrong_code'));
        }
    }

    public function userLogin(Request $request)
    {
        // dd('jhv');
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $request->validate([
                'email' => 'required|exists:users,email',
                'password' => 'required'
            ],
                [
                    'email.required' => (trans('validation.field_required')),
                    'email.email' => (trans('validation.field_email')),
                    'email.exists' => (trans('validation.These credentials do not match our data.')),
                    'password.required' => (trans('validation.field_required_password')),
                ]);

            // $remember_me = $request->has('remember') ? true : false;

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password)) {
                return back()->with('passwordCheck', trans('auth.failed'));
            }

            if ($user) {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], true)) {
                    if (auth()->user() && auth()->user()->type == 'admin') {
                        return redirect('/dashboard');
                    } else {
                        return redirect('/');
                    }
                }
            }
        }

        $request->validate([
            'email' => 'required|exists:users,phone',
            'password' => 'required'
        ],
            [
                'email.required' => (trans('validation.field_required')),
                'email.email' => (trans('validation.field_email')),
                'email.exists' => (trans('validation.These credentials do not match our data.')),
                'password.required' => (trans('validation.field_required_password')),
            ]);


        // $remember_me = $request->has('remember') ? true : false;

        $user = User::where('phone', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('passwordCheck', trans('auth.failed'));
        }

        if ($user) {
            if (Auth::guard('web')->attempt(['phone' => $request->email, 'password' => $request->password], true)) {
                if (auth()->user() && auth()->user()->type == 'admin') {
                    return redirect('/dashboard');
                } else {
                    return redirect('/');
                }
            }
        }

        return redirect()->route('login');
    }

    public function getCities(Request $request)
    {
        // dd($request->all() );
        $cities = City::where('country_id', $request->country_id)->get();

        return successReturn($cities);
        // dd($request->all());
    }
}
