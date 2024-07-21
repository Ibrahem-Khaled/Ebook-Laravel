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
    public function index(Request $request)
    {
        $q = $request->query('query');

        $authors = Author::query()
            ->when($q, function ($query, $q) {
                return $query->where('author_name', 'like', '%' . $q . '%')
                    ->orWhere('desc', 'like', '%' . $q . '%');
            })
            ->get();

        return view('author.index', compact('authors', 'q'));
    }

    public function create()
    {
        return view('author.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'author_name' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profilePath = null;
        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('author.index')->with('success', 'تم إنشاء المؤلف بنجاح.');
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('author.show', compact('author'));
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('author.edit', compact('author'));
    }

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
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
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
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('author.index')->with('success', 'تم تحديث المؤلف بنجاح');
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id);
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }
        $author->delete();

        return redirect()->route('author.index')->with('success', 'تم حذف المؤلف بنجاح');
    }

    public function searchSelect(Request $request)
    {
        $search = $request->input('search', '');
        $authors = DB::table('authors')
            ->select('id', 'author_name')
            ->where('author_name', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();

        return response()->json($authors, 200);
    }
}
