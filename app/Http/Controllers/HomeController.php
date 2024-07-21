<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
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

        $authors = Author::all();
        $publishers = Publisher::all();

        return view('home', compact('categories', 'books', 'authors', 'publishers'));
    }

    public function author($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('author', compact('author'));
    }
}
