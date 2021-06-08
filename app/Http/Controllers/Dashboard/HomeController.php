<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'user')->get()->count();
        $admins = User::where('type', 'admin')->get()->count();
        // $projects = Project::count();

        return view('dashboard.index', compact('users','admins'));
    }

    public function change_language() {
        $lang = app()->getLocale();
        ($lang == 'ar') ? $lang = 'en' : $lang = 'ar';
        app()->setLocale($lang);
        session()->put('lang', $lang);
        return back();
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications;
        $notifications->markAsRead();

        return view('dashboard.notifications.index', compact('notifications'));
    }
}
