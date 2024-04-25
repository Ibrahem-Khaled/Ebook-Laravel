<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        // Retrieve all categories
        $categories = Category::with([
            'books' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(5);
            }
        ])->get();
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


}
