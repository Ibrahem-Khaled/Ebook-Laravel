<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    // عرض قائمة المؤلفين مع إمكانية البحث
    public function index(Request $request)
    {
        $q = $request->query('query');

        $authors = Author::query()
            ->withCount('books') // إضافة عدد الكتب لكل مؤلف
            ->when($q, function ($query, $q) {
                return $query->where('author_name', 'like', '%' . $q . '%')
                    ->orWhere('desc', 'like', '%' . $q . '%');
            })
            ->get();

        return view('dashboard.authors.index', compact('authors', 'q'));
    }
    // حفظ بيانات المؤلف الجديد مع رفع الصورة إن وُجدت
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profilePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::slug($request->author_name) . '.' . $file->getClientOriginalExtension();
            $profilePath = $file->storeAs('profiles', $fileName, 'public');
        }

        Author::create([
            'author_name' => $request->author_name,
            'desc' => $request->desc,
            'image' => $profilePath,
            'fb' => $request->fb,
            'yt' => $request->yt,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('author.index')->with('success', 'تم إنشاء المؤلف بنجاح.');
    }

    // تحديث بيانات المؤلف وتعديل الصورة إن وُجدت
    public function update(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $author = Author::findOrFail($id);

        $profilePath = $author->image;
        if ($request->hasFile('image')) {
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $file = $request->file('image');
            $fileName = Str::slug($request->author_name) . '.' . $file->getClientOriginalExtension();
            $profilePath = $file->storeAs('profiles', $fileName, 'public');
        }

        $author->update([
            'author_name' => $request->author_name,
            'desc' => $request->desc,
            'image' => $profilePath,
            'fb' => $request->fb,
            'yt' => $request->yt,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('author.index')->with('success', 'تم تحديث المؤلف بنجاح');
    }

    // حذف المؤلف مع حذف الصورة إن وُجدت
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }
        $author->delete();

        return redirect()->route('author.index')->with('success', 'تم حذف المؤلف بنجاح');
    }
}
