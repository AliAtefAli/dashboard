<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if (auth()->user() && auth()->user()->type == 'admin') {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function username()
    {
        // dd(request()->input('email'));
        $login = request()->input('email');
        if (filter_var($login, FILTER_VALIDATE_EMAIL))
            $field = 'email';
        else
            $field = 'phone';

        request()->merge([$field => $login, true]);

        return $field;
    }

    protected function attemptLogin(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
        else
            $credentials = [
                'phone' => $credentials = User::cleanPhone($request->email)['phone'],
                'password' => $request->password,
            ];

        return $this->guard()->attempt($credentials, true) ;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
