<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Coupon;
use App\Models\UserCarts;
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

    public function searchBooks($term)
    {
        $books = Book::search($term)->get();
        if (!$books->isEmpty()) {
            return response()->json($books, 200);
        } else {
            return response()->json(['message' => 'No books found.'], 404);
        }
    }
    public function useCoupon(Request $request)
    {
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();
        $user = auth()->guard('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

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

        $coupon->update([
            'user_id' => $user->id,
            'is_used' => 1,
        ]);
        UserCarts::create([
            'user_id' => $user->id,
            'book_id' => $coupon->book_id,
            'discount_price' => $coupon->discount
        ]);
        return response()->json(['message' => 'تم تطبيق الخصم بنجاح'], 200);
    }


}
