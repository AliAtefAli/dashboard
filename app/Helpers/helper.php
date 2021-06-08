<?php

use App\Models\Message;
use App\Models\Setting;
use App\Models\SmsSmtp;
use App\Models\SubscriptionUser;
use App\Models\User;
use App\Notifications\FinishedSubscriptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

if (!function_exists('lang')) {
    function lang()
    {
        return app()->getLocale() ? app()->getLocale() : app()->setLocale('ar');
    }
}

if (!function_exists('appDirection')) {
    function appDirection()
    {
        return ( app()->getLocale()  == 'ar' ) ? '-rtl' : '';
    }
}

if (!function_exists('langs_trans')) {
    function langs_str()
    {
        return implode(',', Config::get('languages'));
    }
}
if (!function_exists('lang_trans')) {
    function lang_str()
    {
        return lang() == 'ar' ? 'English' : 'العربية';
    }
}
if (!function_exists('activeSidebar')) {
    function activeSidebar($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }
        return $active;
    }
}

if (!function_exists('getSetting')) {
    function getSetting()
    {
        $setting = Setting::all()->pluck('value', 'key');

        return $setting;
    }
}

if (!function_exists('longText')) {
    function longText($text, $limit = 95)
    {
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . '...';
        } else {
            return $text;
        }
    }
}

if (!function_exists('getTimes')) {
    function getTimes($default = '19:00', $interval = '+30 minutes')
    {

        $output = '';

        $current = strtotime('00:00');
        $end = strtotime('23:59');

        while ($current <= $end) {
            $time = date('H:i', $current);
            $sel = ($time == $default) ? ' selected' : '';

            $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) . '</option>';
            $current = strtotime($interval, $current);
        }

        return $output;
    }
}

if (!function_exists('getDaysOfWeek')) {
    function getDaysOfWeek($default = 'mon')
    {
        $output = '';
        $days = array(
            "sun" => trans('dashboard.Days.sun'),
            "mon" => trans('dashboard.Days.mon'),
            "tue" => trans('dashboard.Days.tue'),
            "wed" => trans('dashboard.Days.wed'),
            "thu" => trans('dashboard.Days.thu'),
            "fri" => trans('dashboard.Days.fri'),
            "sat" => trans('dashboard.Days.sat'),
        );


        foreach ($days as $key => $value) {
            $sel = ($key == $default) ? ' selected' : '';
            $output .= "<option value=\"{$key}\"{$sel}>" . $value . '</option>';
        }

        return $output;
    }
}

function successReturn($data = array(),$msg =''){
    $user_status = (Auth::user())? Auth::user()->active : 'active';
    return ['value' => '1' , 'key' => 'success' , 'data' => $data, 'msg' => $msg , 'code' => 200 , 'user_status' => $user_status];
}

function successReturnMsg($msg = '' ){
    $user_status = (Auth::user())? Auth::user()->active : 'active';
    return ['value' => '1' , 'key' => 'success' , 'msg' => $msg,'code' => 200 , 'user_status' => $user_status];
}

function failReturn($msg = ''){
    $user_status = (Auth::user())? Auth::user()->active : 'active';
    return ['value' => '0' , 'key' => 'fail' , 'msg' => $msg , 'code' => 401 , 'user_status' => $user_status];
}

function failReturnData($data = []){
    $user_status = (Auth::user())? Auth::user()->active : 'active';
    return ['value' => '0' , 'key' => 'fail' , 'data' => $data , 'code' => 401 , 'user_status' => $user_status];
}

if (!function_exists('handleNotificationRoute')) {
    function handleNotificationRoute($notification)
    {
        if ($notification->data['has_id']) {
            return route($notification->data['route_name'], $notification->data['route_id']);
        } else {
            return route($notification->data['route_name']);
        }
    }
}

if (!function_exists('handleNotificationMessage')) {
    function handleNotificationMessage($notification)
    {

    }
}

if (!function_exists('getUnReadNotifications')) {
    function getUnReadNotifications()
    {
        $notifications = auth()->user()->unReadNotifications;
        return $notifications;
    }
}

if (!function_exists('getUnReadNotificationsCount')) {
    function getUnReadNotificationsCount()
    {
        $count = auth()->user()->unReadNotifications->count();
        return $count;
    }
}

if (!function_exists('handleMessageAlert')) {
    function handleMessageAlert($count){
        if($count == 1) {
            return 'رسالة جديدة';
        } elseif ($count == 2) {
            return 'رسالتان جديداتان';
        } elseif ($count > 2 && $count < 11) {
            return $count . ' رسائل جديدة ';
        } else {
            return $count . ' رسالة جديدة ' ;
        }
    }
}

if (!function_exists('handleNotificationAlert')) {
    function handleNotificationAlert($count){
        if($count == 1) {
            return 'اشعار جديد';
        } elseif ($count == 2) {
            return ' اشعارين ';
        } elseif ($count > 2 && $count < 11) {
            return $count . ' اشعارات جديدة ';
        } else {
            return $count . ' اشعار جديدة ' ;
        }
    }
}

if (!function_exists('getUnreadMessages')) {
    function getUnreadMessages($user){
        $count = 0;
        foreach ($user->messages as $message) {
            if($message->seen_at == null)
                $count++;
        }
        return $count;
    }
}

if (!function_exists('getUnreadConversationMessages')) {
    function getUnreadConversationMessages($user, $sender_id = 0){
        if($user->conversation)
            return $user->conversation->messages->where('seen', 'false')->where('user_id', $sender_id)->count();
        else
            return 0;
    }
}

if (!function_exists('getAllUnreadConversationMessages')) {
    function getAllUnreadConversationMessages(){
        $count = 0;
        $users = User::whereType('user')->get();
        foreach ($users as $user ) {
            if($user->conversation) {
                $count += $user->conversation->messages->where('seen', 'false')->where('user_id', 0)->count();
            }
        }
        return $count ;
    }
}

if (!function_exists('getLastMessage')) {
    function getLastMessage($user){
        if( $user->conversation ) {
            if ( $user->conversation->messages->last() )
                if ($user->conversation->messages->last()->type == 'text')
                    if ($user->conversation->messages->last()->user_id == $user->id)
                        return $user->conversation->messages->last()->content;
                    else
                        return 'انت : ' . $user->conversation->messages->last()->content;
                else
                    return 'صورة';
            else
                return '';
        }
        else
            return '';
    }
}

if (!function_exists('getLatestMessageOwner')) {
    function getLatestMessageOwner(){
        if(Message::where('user_id', '!=', 0)->latest()->first())
            return Message::where('user_id', '!=', 0)->latest()->first()->user;
        else
            return 0;
    }
}

if (!function_exists('ArbDigitsToEng')) {
    function ArbDigitsToEng($string) {
        return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }
}

