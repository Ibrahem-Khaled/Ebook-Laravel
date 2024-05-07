<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('query');

        if ($q) {
            $authors = Author::where('author_name', 'like', '%' . $q . '%')
                ->orWhere('desc', 'like', '%' . $q . '%')
                ->get();
        } else {
            $authors = Author::all();
        }

        return view('author.index', compact('authors', 'q'));
    }


    public function save(Request $request)
    {
        $request->validate(['author_name' => 'min:3|required']);

        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            // Store the PDF file in the storage disk
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
            'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('author.index')->with('success', 'تم إنشاء المؤلف بنجاح.');
    }

    public function create()
    {
        return view('author.create');
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
        $request->validate(['author_name' => 'min:3|required']);
        $author = Author::findOrFail($id);

        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            // Store the PDF file in the storage disk
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
        }

        $author->update([
            'author_name' => $request->author_name,
            'desc' => $request->desc,
            'image' => $request->hasFile('image') ? $profilePath : $author->image,
            'fb' => $request->fb,
            'yt' => $request->yt,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('author.index')->with('success', 'تم تحديث المؤلف بنجاح');
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('author.index')->with('success', "Autor eliminado correctamente");
    }

    public function searchSelect(Request $request)
    {
        $sql = "SELECT authors.id, authors.author_name FROM authors WHERE author_name LIKE '%$request->search%' LIMIT 5";
        $authors = DB::select($sql);
        return response()->json($authors, 200);
    }


}
