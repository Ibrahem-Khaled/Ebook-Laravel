<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\BookRating;
use Illuminate\Http\Request;

class BookRatingController extends Controller
{
    public function index()
    {
        $bookRatings = BookRating::all();
        return view('dashboard.book-rating', compact('bookRatings'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'book_id' => 'required',
            'rating' => 'required',
        ]);

        BookRating::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return response()->json(['success' => 'Book rating added successfully']);
    }

    public function destroy($ratingBook)
    {
        BookRating::findOrFail($ratingBook)->delete();
        return redirect()->back()->with('success', 'Book rating deleted successfully');
    }
}
