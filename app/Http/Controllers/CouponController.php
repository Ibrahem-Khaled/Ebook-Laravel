<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::get();
        $books = Book::get();
        return view('coupon.home', compact('coupons', 'books'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1', // Make sure count is provided and is at least 1
            'book_id' => 'required', // Assuming you also need a book_id
        ]);

        for ($i = 0; $i < $request->count; $i++) {
            $code = Str::random(20);
            Coupon::create([
                'book_id' => $request->book_id,
                'code' => $code,
                'discount' => $request->discount,
            ]);
        }

        // Redirect the user to a relevant page (e.g., the index page)
        return redirect()->route('coupons.index')->with('success', 'Coupons created successfully!');
    }

    public function bookCoupon($bookId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return response()->json(['error' => 'Book not found.'], 404);
        }
        $coupons = $book->coupons;
        return view('coupon.bookCoupons', compact('coupons'));
    }
}
