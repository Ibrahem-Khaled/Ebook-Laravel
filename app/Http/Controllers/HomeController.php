<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show()
    {
        $books = Book::take(5)->get();
        $categories = Category::all();
        $categories->each(function ($category) {
            $category->setRelation('books', $category->books()->limit(4)->get());
        });

        return view('home', compact('categories', 'books'));
    }
}
