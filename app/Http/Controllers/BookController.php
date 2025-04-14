<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookInfo;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Subcategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // عرض قائمة الكتب في لوحة التحكم
    public function index(): View
    {
        $books = Book::with(['category', 'subcategory', 'author', 'publisher'])->paginate(10);
        $totalBooks = $books->count();
        $activeBooks = $books->where('is_active', true)->count();
        $inactiveBooks = $books->where('is_active', false)->count();

        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('dashboard.books.index', compact(
            'books',
            'totalBooks',
            'activeBooks',
            'inactiveBooks',
            'publishers',
            'authors',
            'categories',
            'subcategories',
        ));
    }

    // حفظ كتاب جديد
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'book_isbn' => 'nullable|min:8',
            'book_pdf' => 'nullable|file|max:102400',
            'category_id' => 'required|min:1|integer',
            'subcategory_id' => 'required|min:1|integer',
            'book_title' => 'required|unique:books,book_title',
            'author_id' => 'required|min:1|integer',
            'publisher_id' => 'required|min:1|integer',
            'book_publication_date' => 'required|date',
            'book_image' => 'required|image',
            'book_number_pages' => 'required|integer|min:1',
            'book_discount' => 'integer|max:100',
            'is_active' => 'boolean',
        ]);

        $pdfFilePath = null;
        if ($request->hasFile('book_pdf')) {
            $pdfFile = $request->file('book_pdf');
            $pdfFileName = Str::slug($request->book_isbn) . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName, 'public');
        }

        if ($request->hasFile("book_image")) {
            $image = $request->file("book_image");
            $imageName = Str::slug($request->book_isbn) . "." . $image->guessExtension();
            $destinationPath = public_path("img/books/");
            $image->move($destinationPath, $imageName);

            $book = Book::create([
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
                'is_active' => $request->is_active ?? true, // تفعيل الكتاب افتراضيًا
            ]);

            if ($book && ($request->author_id_2 || $request->paper_url)) {
                BookInfo::create([
                    'book_id' => $book->id,
                    'author_id' => $request->author_id_2,
                    'paper_url' => $request->paper_url,
                ]);
            }
        }

        return redirect()->route('book.index')->with('success', 'تم إنشاء الكتاب بنجاح.');
    }

    // تحديث كتاب
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'book_isbn' => 'nullable|min:8|max:13',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'book_title' => 'required',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'book_publication_date' => 'required|date',
            'book_number_pages' => 'required|integer|min:1',
            'book_discount' => 'integer|max:100|nullable',
            'is_active' => 'boolean',
        ]);

        $book = Book::findOrFail($id);

        // تحديث ملف PDF إذا تم تحميل ملف جديد
        $pdfFilePath = $book->book_pdf;
        if ($request->hasFile('book_pdf')) {
            $pdfFile = $request->file('book_pdf');
            $pdfFileName = Str::slug($request->book_isbn) . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFilePath = $pdfFile->storeAs('pdfs', $pdfFileName, 'public');
        }

        // تحديث الصورة إذا تم تحميل صورة جديدة
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

        // تحديث بيانات الكتاب
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
            'book_discount' => $request->book_discount,
            'is_active' => $request->is_active ?? $book->is_active, // الحفاظ على الحالة الحالية إذا لم يتم التحديث
        ]);

        if ($book && ($request->author_id_2 || $request->paper_url)) {
            BookInfo::updateOrCreate(
                ['book_id' => $book->id],
                [
                    'author_id' => $request->author_id_2,
                    'paper_url' => $request->paper_url,
                ]
            );
        }

        return redirect()->route('book.index')->with('success', 'تم تحديث الكتاب بنجاح.');
    }

    // تفعيل/إلغاء تفعيل الكتاب
    public function toggleActivation($id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->update(['is_active' => !$book->is_active]);

        $status = $book->is_active ? 'مفعل' : 'غير مفعل';
        return redirect()->back()->with('success', "تم تغيير حالة الكتاب إلى {$status} بنجاح.");
    }

    // حذف كتاب
    public function destroy($id): RedirectResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'تم حذف الكتاب بنجاح.');
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