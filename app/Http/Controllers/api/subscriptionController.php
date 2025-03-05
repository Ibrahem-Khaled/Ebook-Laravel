<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Subscription;
use Illuminate\Http\Request;

class subscriptionController extends Controller
{
    public function index()
    {
        $subscription = Subscription::where('is_active', 1)->get();

        return response()->json($subscription);
    }

    public function addCouponSubscription(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();
        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found'], 404);
        }

        if ($coupon->is_used == 1) {
            return response()->json(['message' => 'This coupon is used'], 404);
        }
        if ($coupon->type != 'subscription') {
            return response()->json(['message' => 'This coupon is not for subscription'], 404);
        }

        $coupon->is_used = 1;
        $coupon->user_id = auth()->guard('api')->id();
        $coupon->save();

        $subscription = Subscription::find($coupon->subscription_id);
        $expiryDate = now()->addMonths($subscription->duration);

        $subscription->users()->attach(auth()->guard('api')->id(), ['expiry_date' => $expiryDate]);

        return response()->json(['message' => 'Coupon added to subscription successfully'], 200);
    }

    public function addUserIsSubscribedPageReader(Request $request)
    {
        $user = auth()->guard('api')->user();
        if ($user->is_subscribed == 0) {
            return response()->json(['message' => 'User is not subscribed'], 404);
        }
        
        $book = $request->book_id;
        $page = $request->page_number;

        $user->bookReadHistory()->attach($book, ['page' => $page]);

        return response()->json(['message' => 'Page read successfully'], 200);
    }
}
