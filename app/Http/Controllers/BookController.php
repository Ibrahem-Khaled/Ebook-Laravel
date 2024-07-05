<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    // in admin dashbhoard
    public function index(): View
    {

        $books = Book::all();
        return view('book.index', compact('books'));
    }

    public function create(): View
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('book.create', compact('authors', 'publishers', 'categories'));
    }

    public function save(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'book_isbn' => 'required|min:8',
            'book_pdf' => 'nullable|file|max:102400',
            'category_id' => 'required|min:1|integer',
            'subcategory_id' => 'required|min:1|integer',
            'book_title' => 'required',
            'author_id' => 'required|min:1|integer',
            'publisher_id' => 'required|min:1|integer',
            'book_publication_date' => 'required|date',
            'book_image' => 'required|image',
            'book_number_pages' => 'required|integer|min:1',
            'book_discount' => 'integer|max:100'
        ]);

        if ($request->hasFile('book_pdf')) {
            $pdfFile = $request->file('book_pdf');
            $pdfFileName = Str::slug($request->book_isbn) . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName, 'public');
        } else {
            $pdfFilePath = null;
        }

        if ($request->hasFile("book_image")) {
            $image = $request->file("book_image");
            $imageName = Str::slug($request->book_isbn) . "." . $image->guessExtension();
            $destinationPath = public_path("img/books/");

            $image->move($destinationPath, $imageName);

            Book::create([
                'book_isbn' => $request->book_isbn,
                'book_pdf' => $pdfFilePath,
                'book_title' => $request->book_title,
                'subcategory_id' => $request->subcategory_id,
                'category_id' => $request->category_id,
                'author_id' => $request->author_id,
                'publisher_id' => $request->publisher_id,
                'free_sample' => $request->free_sample,
                'book_number_pages' => $request->book_number_pages,
                'book_publication_date' => $request->book_publication_date,
                'book_description' => $request->book_description,
                'book_image_url' => 'img/books/' . $imageName,
                'book_price' => $request->book_price,
                'book_discount' => $request->book_discount,
            ]);
        }

        return redirect()->route('book.index')->with('success', 'تم إنشاء الكتاب بنجاح.');
    }


    public function edit($id): View
    {
        $book = Book::findOrFail($id);
        $subcategory = Subcategory::findOrFail($book->subcategory_id);
        $category = Category::findOrFail($subcategory->category_id);
        $author = Author::findOrFail($book->author_id);
        $publisher = Publisher::findOrFail($book->publisher_id);

        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('book.edit', compact('book', 'subcategory', 'category', 'author', 'publisher', 'authors', 'publishers', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'book_isbn' => 'required|min:8|max:13',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'book_title' => 'required',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'book_publication_date' => 'required|date',
            'book_number_pages' => 'required|integer|min:1',
            'book_discount' => 'integer|max:100|nullable'
        ]);

        $book = Book::findOrFail($id);

        // Update PDF if a new file is uploaded
        $pdfFilePath = $book->book_pdf;
        if ($request->hasFile('book_pdf')) {
            $pdfFile = $request->file('book_pdf');
            $pdfFileName = Str::slug($request->book_isbn) . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName, 'public');
        }

        // Update image if a new file is uploaded
        $bookImageUrl = $book->book_image_url;
        if ($request->hasFile('book_image')) {
            if (Storage::disk('public')->exists($book->book_image_url)) {
                Storage::disk('public')->delete($book->book_image_url);
            }
            $image = $request->file("book_image");
            $imageName = Str::slug($request->book_isbn) . "." . $image->guessExtension();
            $destinationPath = public_path("img/books/");
            $image->move($destinationPath, $imageName);
            $bookImageUrl = 'img/books/' . $imageName;
        }

        // Update book record
        $book->update([
            'book_isbn' => $request->book_isbn,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'book_title' => $request->book_title,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
            'book_publication_date' => $request->book_publication_date,
            'book_number_pages' => $request->book_number_pages,
            'free_sample' => $request->free_sample,
            'book_description' => $request->book_description,
            'book_pdf' => $pdfFilePath,
            'book_image_url' => $bookImageUrl,
            'book_price' => $request->book_price,
            'book_discount' => $request->book_discount
        ]);

        return redirect()->route('book.index')->with('success', 'تم تحديث الكتاب بنجاح.');
    }

    public function show($id): View
    {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    public function view($id): View
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('book.view', compact('book', 'categories'));
    }

    public function search(): View
    {
        $categories = Category::all();

        $sql = 'SELECT
        books.id,
        books.book_isbn,
        books.book_title,
        books.book_price,
        books.book_image_url,
        authors.author_name,
        publishers.publisher_name,
        categories.category_name,
        subcategories.subcategory_name
        FROM books, authors, publishers, categories, subcategories
        WHERE books.author_id = authors.id
        AND books.publisher_id = publishers.id
        AND books.subcategory_id = subcategories.id
        AND subcategories.category_id = categories.id
        ORDER BY books.updated_at DESC
        LIMIT 30';
        $books = DB::select($sql);

        return view('book.search', compact('categories', 'books'));
    }
    public function search2(Request $request): View
    {
        $categorySelected = null;
        if (isset($request->category)) {
            $categorySelected = Category::findOrFail($request->category);
        }

        $subcategorySelected = null;
        if (isset($request->subcategory)) {
            $subcategorySelected = Subcategory::findOrFail($request->subcategory);
        }
        $categories = Category::all();
        $sql = 'SELECT
        books.id,
        books.book_isbn,
        books.book_title,
        books.book_price,
        books.book_image_url,
        authors.author_name,
        publishers.publisher_name,
        categories.category_name,
        subcategories.subcategory_name
        FROM books, authors, publishers, categories, subcategories
        WHERE books.author_id = authors.id
        AND books.publisher_id = publishers.id
        AND books.subcategory_id = subcategories.id
        AND subcategories.category_id = categories.id';

        if (isset($request->category)) {
            $sql = $sql . " AND categories.id = " . $request->category . " ";
        }

        if (isset($request->subcategory)) {
            $sql = $sql . "AND subcategories.id = " . $request->subcategory;
        }

        $sql = $sql . ' ORDER BY books.updated_at DESC LIMIT 50';



        $books = DB::select($sql);

        return view('book.search', compact('categories', 'categorySelected', 'subcategorySelected', 'books'));
    }

    public function delete($id): RedirectResponse
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('book.index')->with('success', "Libro eliminado correctamente");
    }

    public function searchSelect($search): JsonResponse
    {
        $sql = "SELECT
    books.id,
    books.book_isbn,
    books.book_title,
    books.book_price,
    authors.author_name,
    publishers.publisher_name,
    categories.category_name,
    subcategories.subcategory_name
    FROM books, authors, publishers, categories, subcategories
    WHERE books.author_id = authors.id
    AND books.publisher_id = publishers.id
    AND books.subcategory_id = subcategories.id
    AND subcategories.category_id = categories.id
    AND(
        books.book_title LIKE '%$search%' OR
        books.book_isbn LIKE '%$search%' OR
        authors.author_name LIKE '%$search%' OR
        publishers.publisher_name LIKE '%$search%')
        ORDER BY books.updated_at DESC
        LIMIT 30";

        $books = DB::select($sql);
        return response()->json($books);
    }

}
