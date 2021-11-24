<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        return view('admin.pages.setting', compact('setting'));
    }

    public function settingStore(SettingRequest $request)
    {
        $setting = Setting::first();
        if ($setting == null) {
            $setting = new Setting();
            $setting->site_title = $request->site_title;
            $setting->site_description = $request->site_description;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->address = $request->address;
            $setting->copy_right = $request->copy_right;
            $setting->whatsapp = $request->whatsapp;
            $setting->youTube = $request->youTube;
            $setting->telegram = $request->telegram;
            $setting->tweeter = $request->tweeter;
            $setting->instagram = $request->instagram;
            $setting->save();
            return redirect()->back()->with('success', 'changes Saved Successfully!');
        } else {
            $setting->update([
                'site_title' => $request->site_title,
                'site_description' => $request->site_description,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'copy_right' => $request->copy_right,
                'whatsapp' => $request->whatsapp,
                'youTube' => $request->youTube,
                'telegram' => $request->telegram,
                'tweeter' => $request->tweeter,
                'instagram' => $request->instagram,
            ]);
            return redirect()->back()->with('success', 'changes Saved  Successfully!');
        }
    }
}