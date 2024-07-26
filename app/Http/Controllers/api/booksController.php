<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class booksController extends Controller
{
    public function show($id)
    {
        $user = auth()->guard('api')->user();
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $isFavorite = $user->bookFav()->where('book_id', $book->id)->exists();
        $ownsBook = $user->books()->where('book_id', $book->id)->exists();
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(5)
            ->get();

        $averageRating = $book->bookRatings()->avg('rating');

        $bookDetails = $book->toArray();
        $bookDetails['is_favorite'] = $isFavorite;
        $bookDetails['addtocart'] = !$ownsBook;
        $bookDetails['average_rating'] = $averageRating;
        $bookDetails['related_books'] = $relatedBooks;

        return response()->json($bookDetails);
    }



    public function publisherOrAuthor($type, $id)
    {
        if ($type == 'author') {
            $author = Author::find($id);
            if (!$author) {
                return response()->json(['message' => 'Author not found'], 404);
            } else {
                $author->books;
                return response()->json($author);
            }
        } else {
            $publisher = Publisher::find($id);
            if (!$publisher) {
                return response()->json(['message' => 'Publisher not found'], 404);
            } else {
                $publisher->books;
                return response()->json($publisher);
            }
        }
    }
}
