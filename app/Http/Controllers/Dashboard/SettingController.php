<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Phone;
use App\Models\Setting;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Uploadable;

    public function show()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('dashboard.settings.general', compact('settings'));
    }

    public function general()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('dashboard.settings.general', compact('settings'));
    }

    public function phones()
    {
        $phones = Phone::all();

        return view('dashboard.settings.vacation', compact('settings'));
    }

    public function social()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('dashboard.settings.social', compact('settings'));
    }

    public function api()
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('dashboard.settings.api', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $settings = $request->all('settings');

        if ($request->has('settings.phone')) {
            $settings['settings']['phone'] = $this->clean($request->input('settings.phone'));
        }

        if ($request->has('settings.logo')) {
            $logo = Setting::where('key', 'logo')->first();
            if ( file_exists(public_path('assets/uploads/settings/' . $logo->value )) && is_file(public_path('assets/uploads/settings/' . $logo->value )) ) {
                unlink(public_path('assets/uploads/settings/' . $logo->value ) );
            }
            $settings['settings']['logo'] = $this->uploadOne($request->settings['logo'], 'settings', null, null);
        }
        if ($request->has('settings.favicon')) {
            $favicon = Setting::where('key', 'favicon')->first();
            if ( file_exists(public_path('assets/uploads/settings/' . $favicon->value )) && is_file(public_path('assets/uploads/settings/' . $favicon->value )) ) {
                unlink(public_path('assets/uploads/settings/' . $favicon->value ) );
            }
            $settings['settings']['favicon'] = $this->uploadOne($request->settings['favicon'], 'settings', 50, 50);
        }
        foreach ($settings['settings'] as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            ($setting) ? $setting->update(['value' => $value]) : Setting::create(['key' => $key, 'value' => $value]);
        }
        return back()->with('success', trans('dashboard.Updated successfully!'));
    }

    private function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    public function smtpPage()
    {
        $smtp = SmsSmtp::where('type','smtp')->first();

        return view('dashboard.settings.smtp', compact('smtp'));
    }

    public function SMTP(Request $request)
    {
        $this->validate($request,[
            'smtp_username'    =>'nullable|min:1|max:190',
            'smtp_sender_email'=>'nullable|min:1|max:190',
            'smtp_sender_name' =>'nullable|min:1|max:190',
            'smtp_password'    =>'nullable|min:1|max:190',
            'smtp_port'        =>'nullable|min:1|max:190',
            'smtp_host'        =>'nullable|min:1|max:190',
            'smtp_encryption'  =>'nullable|min:1|max:190',
            'delivery_email'  =>'nullable|min:1|max:190',
            'admin_email'  =>'nullable|min:1|max:190',
        ]);
        if($smtp = SmsSmtp::where('type','=','smtp')->first()){
            $smtp->type         = "smtp";
            $smtp->username     = $request->smtp_username;
            $smtp->sender_email = $request->smtp_sender_email;
            $smtp->sender_name  = $request->smtp_sender_name;
            $smtp->password     = $request->smtp_password;
            $smtp->port         = $request->smtp_port;
            $smtp->host         = $request->smtp_host;
            $smtp->encryption   = $request->smtp_encryption;
            $smtp->delivery_email   = $request->delivery_email;
            $smtp->admin_email   = $request->admin_email;
            $smtp->save();
        }else{
            $smtp = new SmsSmtp();
            $smtp->type         = "smtp";
            $smtp->username     = $request->smtp_username;
            $smtp->sender_email = $request->smtp_sender_email;
            $smtp->sender_name  = $request->smtp_sender_name;
            $smtp->password     = $request->smtp_password;
            $smtp->port         = $request->smtp_port;
            $smtp->host         = $request->smtp_host;
            $smtp->encryption   = $request->smtp_encryption;
            $smtp->delivery_email   = $request->delivery_email;
            $smtp->admin_email   = $request->admin_email;
            $smtp->save();
        }
        return back()->with('success', trans('dashboard.It was done successfully!'));
    }
}
