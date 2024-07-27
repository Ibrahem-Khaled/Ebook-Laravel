<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Coupon;
use App\Models\Notifcation;
use App\Models\Payment;
use App\Models\Publisher;
use App\Models\SlideShow;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;

class BookDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userBooks = UserBook::all();
        $coupons = Coupon::all();
        $slides = SlideShow::all();
        $notification = Notifcation::all();
        $contact = ContactUs::all();
        $payment = Payment::all();

        $categories = Category::all();
        $subcategories = Subcategory::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $books = Book::all();
        return view(
            'dashboard.books_dashboard',
            compact(
                'users',
                'userBooks',
                'coupons',
                'notification',
                'contact',
                'slides',
                'categories',
                'subcategories',
                'authors',
                'publishers',
                'books',
                'payment',
            )
        );
    }

    public function bookSold(Request $request)
    {
        $query = Book::query();
        // return response()->json($request->end_date == null ? 'null' : 'beso');

        $start = $request->start_date;
        $end = $request->end_date;
        $author = $request->author;
        $publisher = $request->publisher;
        $book_title = $request->book_title;

        if ($start !== null && $end !== null) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        if ($author !== null) {
            $author = $request->input('author');
            $query->whereHas('author', function ($q) use ($author) {
                $q->where('author_name', 'like', "%{$author}%");
            });
        }

        if ($publisher !== null) {
            $publisher = $request->input('publisher');
            $query->whereHas('publisher', function ($q) use ($publisher) {
                $q->where('publisher_name', 'like', "%{$publisher}%");
            });
        }

        if ($book_title !== null) {
            $book_title = $request->input('book_title');
            $query->where('book_title', 'like', "%{$book_title}%");
        }

        $books = $query->get();

        return view('dashboard.bookSold', compact('books'));
    }



    public function soldBookDetails($bookId)
    {
        $book = Book::with('userBooks')->find($bookId);
        return view('dashboard.soldBookDetails', compact('book'));
    }


    public function getAuthors(Request $request)
    {
        $search = $request->get('term');
        $authors = Author::where('author_name', 'LIKE', "%{$search}%")->pluck('author_name');
        return response()->json($authors);
    }

    public function getPublishers(Request $request)
    {
        $search = $request->get('term');
        $publishers = Publisher::where('publisher_name', 'LIKE', "%{$search}%")->pluck('publisher_name');
        return response()->json($publishers);
    }

}
