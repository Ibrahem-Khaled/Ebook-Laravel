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
            'count' => 'required|integer|min:1',
            'book_id' => 'required',
        ]);

        for ($i = 0; $i < $request->count; $i++) {
            $code = '';
            for ($j = 0; $j < 10; $j++) {
                $code .= mt_rand(0, 9);
            }

            Coupon::create([
                'book_id' => $request->book_id,
                'code' => $code,
                'discount' => $request->discount,
            ]);
        }

        return redirect()->route('coupons.index')->with('success', 'Coupons created successfully!');
    }

    public function bookCoupon(Request $request, $bookId)
    {
        $book = Book::find($bookId);
        $q = $request->query('query');

        if (!$book) {
            return response()->json(['error' => 'Book not found.'], 404);
        }

        if ($q) {
            $coupons = Coupon::where('code', 'like', '%' . $q . '%')
                ->get();
        } else {

            $coupons = $book->coupons;
        }

        return view('coupon.bookCoupons', compact('coupons'));
    }
}
