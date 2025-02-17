<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class subscriptionController extends Controller
{
    public function index()
    {
        $subscription = Subscription::get();

        return response()->json($subscription);
    }
}
