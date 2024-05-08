<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function index()
    {
        $appSettings = AppSetting::all();
        return view('app-settings', compact('appSettings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'privacy' => 'required',
            'Instructions' => 'required',
            'about_us' => 'required',
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
        $InstructionsPath = $request->file('Instructions')->store('Instructions_pdfs');

        $appSetting = AppSetting::create([
            'privacy' => $privacyPath,
            'Instructions' => $InstructionsPath,
            'about_us' => $request->Instructions,
            'yt' => $request->yt,
            'fb' => $request->fb,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'telegram' => $request->telegram,
            'email' => $request->email,
            'phone' => $request->phone,
            'whats_app' => $request->whats_app,
        ]);

        return redirect()->back()->with('success', 'Settings added successfully.');
    }


    public function show(AppSetting $appSetting)
    {
        return view('app-settings.show', compact('appSetting'));
    }

    public function edit(AppSetting $appSetting)
    {
        return view('app-settings.edit', compact('appSetting'));
    }

    public function update(Request $request, AppSetting $appSetting)
    {
        $appSetting->update($request->all());
        return redirect()->route('app-settings.index');
    }

    public function destroy(AppSetting $appSetting)
    {
        $appSetting->delete();
        return redirect()->route('app-settings.index');
    }
}
