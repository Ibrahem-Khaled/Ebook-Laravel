<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Notifcation;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $categories->each(function ($category) {
            $category->setRelation('books', $category->books()->limit(10)->get());
        });

        return response()->json($categories);
    }


    public function lastAdded()
    {
        $lastAddedBooks = Book::orderBy('created_at', 'desc')->take(5)->get();
        return response()->json($lastAddedBooks);
    }

    public function category($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json('not found category', 404);
        }
        $category->books;
        return response()->json($category, 200);
    }
    public function notifications()
    {
        $notifications = Notifcation::all();
        return response()->json($notifications, 200);
    }
    public function slideShow()
    {
        $slide = SlideShow::all();
        return response()->json($slide, 200);
    }




}
