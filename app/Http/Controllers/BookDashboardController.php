<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Coupon;
use App\Models\Notifcation;
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


        $categories = Category::all();
        $subcategories = Subcategory::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $books = Book::all();
        return view(
            'books_dashboard',
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
            )
        );
    }
}
