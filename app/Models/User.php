<?php

namespace App\Models;

use App\Notifications\UpdateInYourProject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'image', 'type', 'status', 'code', 'address', 'country_key'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function cleanPhone($phone)
    {
        $phone = ArbDigitsToEng($phone);
        $filteredPhone = [];
        if (substr($phone, 0, 4) == '+966') {

            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '00966',
                'phone' => substr($string, 4),
            ];
            return $filteredPhone;
        } elseif (substr($phone, 0, 5) == '00966') {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '00966',
                'phone' => substr($string, 5),
            ];
            return $filteredPhone;
        } elseif (substr($phone, 0, 3) == '966') {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '00966',
                'phone' => substr($string, 3),
            ];
            return $filteredPhone;
            // Egypt Phone
        } elseif (substr($phone, 0, 2) == '+2') {

            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
            'country_key' => '002',
            'phone' => substr($string, 3)
            ];
            return $filteredPhone;
        } elseif (substr($phone, 0, 3) == '002') {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            // return substr($string, 3);
            $filteredPhone = [
                'country_key' => '002',
                'phone' => substr($string, 4)
            ];
            return $filteredPhone;
        } elseif (substr($phone, 0, 1) == '2') {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '002',
                'phone' => substr($string, 2),
            ];
            return $filteredPhone;
        } elseif (substr($phone, 0, 2) == '01') {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '002',
                'phone' => substr($string, 1),
            ];
            return $filteredPhone;
        } else {
            $string = str_replace(' ', '', $phone);
            $string = str_replace('-', '', $string);

            $filteredPhone = [
                'country_key' => '00966',
                'phone' => $string,
            ];
            return $filteredPhone;
        }
    }

    public function loginByEmail($email, $password, $remember = true)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // The user is being remembered...
        }
    }

    public function loginByPhone($email, $password, $remember = true)
    {
        if (Auth::attempt(['phone' => $email, 'password' => $password], $remember)) {
            // The user is being remembered...
        }
    }

    public static function notifyAdmin($project, $arMsg, $enMsg, $routeName, $routeId, $routeHasId )
    {
        $admins = User::where('type', 'admin')->get();
        foreach ($admins as $admin) {
            $admin
                ->notify(new UpdateInYourProject($enMsg, $arMsg, $project->name, $routeName, $routeId, $routeHasId));
        }
    }

    public function messages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function conversationMessages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'user1');
    }

    public static function sendVerificationCode($user)
    {
        // $code = mt_rand(1111, 9999);
        $code = 1234;
        $data['code'] = $code;

        // Mail::to($user->email)->send(new PassCode($code));

        $user->update(['code' => $code]);
    }

}
