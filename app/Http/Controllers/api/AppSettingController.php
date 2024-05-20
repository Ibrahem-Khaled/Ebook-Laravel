<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{

    public function index()
    {
        $appSetting = AppSetting::find(1);

        if ($appSetting) {
            return response()->json([
                'success' => true,
                'data' => $appSetting
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Settings not found'
            ], 404);
        }
    }
}
