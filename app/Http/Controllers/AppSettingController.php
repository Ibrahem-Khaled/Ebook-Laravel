<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function index()
    {
        $appSettings = AppSetting::all();
        return view('dashboard.app-settings', compact('appSettings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'privacy' => 'nullable',
            'about_us' => 'nullable',
            'yt' => 'nullable|string',
            'fb' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'telegram' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
            'whats_app' => 'nullable|string',
        ]);

        $privacyPath = $request->file('privacy')->store('privacy_pdfs');

        $appSetting = AppSetting::create([
            'privacy' => $privacyPath,
            'about_us' => $request->Instructions,
            'yt' => $request->yt,
            'fb' => $request->fb,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'telegram' => $request->telegram,
            'can_screen_shot' => $request->can_screen_shot,
            'email' => $request->email,
            'phone' => $request->phone,
            'whats_app' => $request->whats_app,
        ]);

        return redirect()->back()->with('success', 'Settings added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Retrieve the existing AppSetting instance by ID
        $appSetting = AppSetting::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'privacy' => 'nullable|file',
            'about_us' => 'nullable|string',
            'yt' => 'nullable|string',
            'fb' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'telegram' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
            'whats_app' => 'nullable|string',
        ]);

        // Check if a new privacy file has been uploaded and store it
        if ($request->hasFile('privacy')) {
            $privacyPath = $request->file('privacy')->store('privacy_pdfs');
            $appSetting->privacy = $privacyPath;
        }

        // Update other fields
        $appSetting->about_us = $request->about_us;
        $appSetting->yt = $request->yt;
        $appSetting->fb = $request->fb;
        $appSetting->instagram = $request->instagram;
        $appSetting->twitter = $request->twitter;
        $appSetting->telegram = $request->telegram;
        $appSetting->email = $request->email;
        $appSetting->can_screen_shot = $request->can_screen_shot;
        $appSetting->phone = $request->phone;
        $appSetting->whats_app = $request->whats_app;

        // Save the updated AppSetting instance
        $appSetting->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }


}
