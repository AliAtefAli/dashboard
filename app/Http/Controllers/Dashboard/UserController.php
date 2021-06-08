<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Step;
use App\Models\User;
use App\Traits\Uploadable;
use http\Env\Request;
use http\Url;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use Uploadable;
    public function index()
    {
        $users = User::whereType('user')->orderBy('created_at', 'DESC')->get();

        return view('dashboard.users.index', compact('users'));
    }

    public function admins()
    {
        $users = User::whereType('admin')->orderBy('created_at', 'DESC')->get();

        return view('dashboard.users.admins', compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }

    public function createUser()
    {
        return view('dashboard.users.create-user');
    }


    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        // $request['phone'] = User::cleanPhone($request['phone']);
        // dd($request['phone'] );
        $filteredPhone = User::cleanPhone($data['phone']);
        $data['phone'] = $filteredPhone['phone'];
        $data['country_key'] = $filteredPhone['country_key'];
        $data['password'] = Hash::make($data['password']);

        // To Validate after filter phone
        $trashedUsersPhone = User::onlyTrashed()->pluck('phone')->toArray();
        $trashedUsersEmail = User::onlyTrashed()->pluck('email')->toArray();
        $request->validate([
            'phone' => ['required', 'string', 'phone:SA,EG',
                Rule::unique('users', 'phone')->where(function ($query) use ($trashedUsersPhone) {
                    $query->whereNotIn('phone', $trashedUsersPhone);
                    return $query;
                })
            ],
        ]);
        $request->validate([
            'email' => ['required', 'email',
                Rule::unique('users', 'email')->where(function ($query) use ($trashedUsersEmail) {
                    $query->whereNotIn('email', $trashedUsersEmail);
                    return $query;
                })
            ],
        ]);

        if ($request->has('image')) {
            $data['image'] = 'assets/uploads/users/' . $this->uploadOne($request->image, 'users', null, null);
        }

        $user = User::create($data);
        if ($request->status == 'pending') {
            // Send Verification code
            User::sendVerificationCode($user);
        }

        if ($request->type == 'user') {
            return redirect()->route('dashboard.users.index')->with("success", trans('dashboard.created_successfully'));
        }
        return redirect()->route('dashboard.users.admins')->with("success", trans('dashboard.created_successfully'));
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $previousRouteName = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

        return view('dashboard.users.edit', compact('user', 'previousRouteName'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        // $request['phone'] = User::cleanPhone($request['phone']);
        $filteredPhone = User::cleanPhone($data['phone']);
        $data['phone'] = $filteredPhone['phone'];
        $data['country_key'] = $filteredPhone['country_key'];

        // To Validate after filter phone
        $request->validate([
            'phone'=> ['required', 'phone:SA,EG', Rule::unique('users')->ignore($user->id, 'id')],
        ]);
        if ($request->has('image')) {
            if ( file_exists(public_path($user->image) ) && is_file( public_path( $user->image) ) && $user->image != 'assets/uploads/users/default.png' ) {
                unlink(public_path($user->image));
            }
            $data['image'] = 'assets/uploads/users/' . $this->uploadOne($request->image, 'users', null, null);
        }
        $user->update($data);

        if ($user->type == 'user') {
            return redirect()->route('dashboard.users.index')->with("success", trans('dashboard.Updated successfully!'));
        }
        return redirect()->route('dashboard.users.admins')->with("success", trans('dashboard.Updated successfully!'));
    }


    public function destroy(User $user)
    {
        if (file_exists(public_path('assets/uploads/users/' . $user->image)) && is_file(public_path('assets/uploads/users/' . $user->path))) {
            unlink(public_path('assets/uploads/users/' . $user->path));
        }
        $user->delete();
        if ($user->type == 'user') {
            return redirect()->route('dashboard.users.index')->with("success", trans('dashboard.deleted_successfully'));
        }
        return redirect()->route('dashboard.users.admins')->with("success", trans('dashboard.deleted_successfully'));

    }

    public function block(User $user)
    {
        $user->update(['status' => 'block']);

        if ($user->type == 'user') {
            return redirect()->route('dashboard.users.index')->with("success", trans('dashboard.deleted_successfully'));
        }
        return redirect()->route('dashboard.users.admins')->with("success", trans('dashboard.deleted_successfully'));
    }

    public function unBlock(User $user)
    {
        $user->update(['status' => 'active']);

        if ($user->type == 'user') {
            return redirect()->route('dashboard.users.index')->with("success", trans('dashboard.deleted_successfully'));
        }
        return redirect()->route('dashboard.users.admins')->with("success", trans('dashboard.deleted_successfully'));
    }

}
