<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserBook;


class HomeController extends Controller
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
        $subscriptions = Subscription::all();
        $subscribersCount = User::whereHas('subscription')->count();
        return view(
            'dashboard.index',
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
                'subscriptions',
                'subscribersCount'
            )
        );
    }


    public function show()
    {

        // return redirect()->route('home.dashboard');

        $books = Book::take(5)->get();
        $categories = Category::all();
        $categories->each(function ($category) {
            $category->setRelation('books', $category->books()->limit(5)->get());
        });

        $authors = Author::all();
        $publishers = Publisher::all();

        return view('app', compact('categories', 'books', 'authors', 'publishers'));
    }

    public function author($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('author', compact('author'));
    }
}
