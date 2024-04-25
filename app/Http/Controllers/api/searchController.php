<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function getCouponBook($code)
    {
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found'], 404);
        }
        if ($coupon->is_used == 1) {
            return response()->json(['message' => 'this coupon is used'], 404);
        }
        $book = $coupon->book;
        if (!$book) {
            return response()->json(['message' => 'Book not found for this coupon'], 404);
        }
        return response()->json($book);
    }
}
