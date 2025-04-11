<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Coupon;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        // جلب الكتب التي تحتوي على كوبونات فقط
        $booksWithCoupons = Book::whereHas('coupons', function ($query) {
            $query->where('type', 'book');
        })->get();

        // جلب الاشتراكات التي تحتوي على كوبونات فقط
        $subscriptionsWithCoupons = Subscription::whereHas('coupons', function ($query) {
            $query->where('type', 'subscription');
        })->get();

        $books = Book::all();
        $subscriptions = Subscription::all();
        return view('dashboard.coupons.index', compact('booksWithCoupons', 'subscriptionsWithCoupons', 'books', 'subscriptions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0|max:100',
            'count' => 'required|integer|min:1',
            'type' => 'required|in:book,subscription',
            'reference_id' => 'required|integer', // إما book_id أو subscription_id بناءً على النوع
        ]);

        for ($i = 0; $i < $request->count; $i++) {
            $code = '';
            for ($j = 0; $j < 10; $j++) {
                $code .= mt_rand(0, 9);
            }

            // إنشاء الكوبون بناءً على النوع
            Coupon::create([
                'type' => $request->type,
                'book_id' => $request->type === 'book' ? $request->reference_id : null,
                'subscription_id' => $request->type === 'subscription' ? $request->reference_id : null,
                'code' => $code,
                'discount' => $request->discount,
            ]);
        }

        return redirect()->route('coupons.index')->with('success', 'تم إنشاء الكوبونات بنجاح!');
    }


    public function deleteCoupons(Request $request)
    {
        $couponIds = $request->input('coupons');

        if ($couponIds) {
            Coupon::whereIn('id', $couponIds)->delete();
            return redirect()->back()->with('success', 'تم حذف الأكواد المحددة بنجاح.');
        }

        return redirect()->back()->with('error', 'لم يتم تحديد أي أكواد لحذفها.');
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

        return view('dashboard.coupons.bookCoupons', compact('coupons'));
    }

    public function showSubscriptionCoupons(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        $q = $request->query('query');

        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found.'], 404);
        }

        if ($q) {
            $coupons = Coupon::where('code', 'like', '%' . $q . '%')
                ->get();
        } else {
            $coupons = $subscription->coupons;
        }

        return view('dashboard.coupons.subscriptionCoupons', compact('coupons', 'subscription'));
    }
}
