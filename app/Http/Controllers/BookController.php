<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookInfo;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->get('category', 'all');

        $booksQuery = Book::with(['author', 'publisher', 'category', 'subcategory'])
            ->orderBy('sort_order', 'asc');

        if ($selectedCategory !== 'all') {
            $booksQuery->where('category_id', $selectedCategory);
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $booksQuery->where(function ($query) use ($search) {
                $query->where('book_title', 'like', "%$search%")
                    ->orWhere('book_isbn', 'like', "%$search%")
                    ->orWhere('book_description', 'like', "%$search%");
            });
        }

        $books = $booksQuery->paginate(10);

        $categories = Category::all();
        $totalBooks = Book::count();
        $activeBooks = Book::where('is_active', 1)->count();
        $freeBooks = Book::where('free_sample', 1)->count();
        $discountedBooks = Book::where('book_discount', '>', 0)->count();

        return view('dashboard.books.index', compact(
            'books',
            'categories',
            'selectedCategory',
            'totalBooks',
            'activeBooks',
            'freeBooks',
            'discountedBooks'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_isbn' => 'nullable|string|max:20|unique:books',
            'book_title' => 'required|string|max:255|unique:books',
            'book_pdf' => 'nullable|file|max:20480',
            'book_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'category_id' => 'nullable|exists:categories,id',
            'book_number_pages' => 'nullable|integer|min:1',
            'book_publication_date' => 'nullable|date',
            'book_description' => 'nullable|string',
            'book_price' => 'nullable|numeric|min:0',
            'book_discount' => 'nullable|integer|min:0|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'free_sample' => 'boolean',
        ]);

        $data = $request->except(['book_pdf', 'book_image_url']);

        if ($request->hasFile('book_pdf')) {
            $data['book_pdf'] = $request->file('book_pdf')->store('books/pdfs', 'public');
        }

        if ($request->hasFile('book_image_url')) {
            $data['book_image_url'] = $request->file('book_image_url')->store('books/images', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'تم إضافة الكتاب بنجاح');
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_isbn' => 'nullable|string|max:20|unique:books,book_isbn,' . $book->id,
            'book_title' => 'required|string|max:255|unique:books,book_title,' . $book->id,
            'book_pdf' => 'nullable|file|max:20480',
            'book_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'nullable|exists:authors,id',
            'publisher_id' => 'nullable|exists:publishers,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'category_id' => 'nullable|exists:categories,id',
            'book_number_pages' => 'nullable|integer|min:1',
            'book_publication_date' => 'nullable|date',
            'book_description' => 'nullable|string',
            'book_price' => 'nullable|numeric|min:0',
            'book_discount' => 'nullable|integer|min:0|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
            'free_sample' => 'boolean',
        ]);

        $data = $request->except(['book_pdf', 'book_image_url']);

        if ($request->hasFile('book_pdf')) {
            if ($book->book_pdf) {
                Storage::disk('public')->delete($book->book_pdf);
            }
            $data['book_pdf'] = $request->file('book_pdf')->store('books/pdfs', 'public');
        }

        if ($request->hasFile('book_image_url')) {
            if ($book->book_image_url) {
                Storage::disk('public')->delete($book->book_image_url);
            }
            $data['book_image_url'] = $request->file('book_image_url')->store('books/images', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'تم تحديث الكتاب بنجاح');
    }

    public function destroy(Book $book)
    {
        if ($book->book_pdf) {
            Storage::disk('public')->delete($book->book_pdf);
        }

        if ($book->book_image_url) {
            Storage::disk('public')->delete($book->book_image_url);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'تم حذف الكتاب بنجاح');
    }

    // تفعيل/إلغاء تفعيل الكتاب
    public function toggleActivation($id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->update(['is_active' => !$book->is_active]);

        $status = $book->is_active ? 'مفعل' : 'غير مفعل';
        return redirect()->back()->with('success', "تم تغيير حالة الكتاب إلى {$status} بنجاح.");
    }

    // حذف مترجم الكتاب
    public function deleteBookTranslator($translatorId): RedirectResponse
    {
        $book = BookInfo::findOrFail($translatorId);
        $book->delete();
        return redirect()->back()->with('success', "تم حذف المترجم بنجاح");
    }

    // عرض الكتب التابعة لفئة معينة
    public function showBooks($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $books = $category->books()->orderBy('sort_order')->get();

        return view('dashboard.books.index', compact('category', 'books'));
    }

    // تحديث ترتيب الكتب
    public function updateBooksOrder(Request $request, $categoryId): JsonResponse
    {
        $order = $request->order;

        foreach ($order as $index => $id) {
            Book::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
