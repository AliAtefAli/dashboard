<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\Uploadable;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers, Uploadable;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $categories = Category::all();
        $countries = Country::all();
        $cities = City::all();

        return view('auth.register', compact('countries', 'cities', 'categories'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'phone' => ['required', 'string', 'min:8', 'phone:SA,EG', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'category_id' => ['required'],
            'city_id' => ['required'],
            'address' => ['required', 'max:191'],
        ], [
            'phone.phone' => (trans('validation.Please Enter Correct saudi arabia phone')),
        ]);
    }

    protected function create(array $data)
    {
        $filteredPhone = User::cleanPhone($data['phone']);
        $data['phone'] = $filteredPhone['phone'];
        $data['country_key'] = $filteredPhone['country_key'];
        $data['avatar'] = $this->uploadOne($data['avatar'], 'users');
        $data['password'] = Hash::make($data['password']);

        $user =  User::create($data);
        User::sendVerificationCode($user);

        return $user;
    }
}
