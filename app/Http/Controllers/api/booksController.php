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
        $book = Book::with(['bookInfo.author','bookWatchInfo'])->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->bookWatchInfo()->updateOrCreate([
            'view_count' => $book->bookWatchInfo->view_count + 1,
        ]);

        // إعداد تفاصيل الكتاب
        $bookDetails = $book->toArray();

        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(5)
            ->get();

        $averageRating = $book->bookRatings()->avg('rating');
        $latestPaperbackLink = $book->bookInfo()->latest()->first();

        if ($user) {
            // إذا كان المستخدم مسجل الدخول
            $isFavorite = $user->bookFav()->where('book_id', $book->id)->exists();
            $ownsBook = $user->books()->where('book_id', $book->id)->exists();

            // إضافة تفاصيل إضافية للمستخدم
            $bookDetails['is_favorite'] = $isFavorite;
            $bookDetails['addtocart'] = !$ownsBook;
            $bookDetails['average_rating'] = $averageRating;
            $bookDetails['latest_paperback_link'] = $latestPaperbackLink ? $latestPaperbackLink->paper_url : null;
            $bookDetails['related_books'] = $relatedBooks;
        } else {
            // إذا لم يكن المستخدم مسجل الدخول
            $bookDetails['is_favorite'] = 0;
            $bookDetails['addtocart'] = null;
            $bookDetails['average_rating'] = $averageRating;
            $bookDetails['latest_paperback_link'] = $latestPaperbackLink ? $latestPaperbackLink->paper_url : null;
            $bookDetails['related_books'] = $relatedBooks;
        }

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
