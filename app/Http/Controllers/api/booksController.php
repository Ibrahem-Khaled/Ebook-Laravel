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
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        if ($book->free_sample == 1) {
            // Fetch the PDF file for the free sample (assuming it's stored in the storage/app/public directory)
            $pdfPath = "free_samples/{$book->id}.pdf"; // Adjust this path according to your file structure

            // Check if the PDF file exists
            if (Storage::exists($pdfPath)) {
                // Read the PDF file
                $pdfContent = Storage::get($pdfPath);

                // Return the PDF file as a downloadable response
                return response()->streamDownload(function () use ($pdfContent) {
                    echo $pdfContent;
                }, "{$book->title}_free_sample.pdf");
            } else {
                // If the PDF file doesn't exist, return a message
                return response()->json(['message' => 'Free sample PDF not found'], 404);
            }
        } else {
            // If free sample is not activated, return the book details
            return response()->json($book);
        }
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
