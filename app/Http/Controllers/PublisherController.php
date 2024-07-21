<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('query');

        $publishers = Publisher::query()
            ->when($q, function ($query, $q) {
                return $query->where('publisher_name', 'like', '%' . $q . '%');
            })
            ->get();

        return view('publisher.index', compact('publishers', 'q'));
    }

    public function create()
    {
        return view('publisher.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profilePath = null;
        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->publisher_name) . '.' . $pdfFile->getClientOriginalExtension();
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
        }

        Publisher::create([
            'publisher_name' => $request->publisher_name,
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

        return redirect()->route('publisher.index')->with('success', 'تم إنشاء دار النشر بنجاح');
    }

    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);

        return view('publisher.show', compact('publisher'));
    }

    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);

        return view('publisher.edit', compact('publisher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $publisher = Publisher::findOrFail($id);

        $profilePath = $publisher->image;
        if ($request->hasFile('image')) {
            if ($publisher->image) {
                Storage::disk('public')->delete($publisher->image);
            }
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->publisher_name) . '.' . $pdfFile->getClientOriginalExtension();
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
        }

        $publisher->update([
            'publisher_name' => $request->publisher_name,
            'desc' => $request->desc,
            'image' => $profilePath,
            'fb' => $request->fb,
            'yt' => $request->yt,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('publisher.index')->with('success', 'تم تحديث دار النشر بنجاح');
    }

    public function delete($id)
    {
        $publisher = Publisher::findOrFail($id);
        if ($publisher->image) {
            Storage::disk('public')->delete($publisher->image);
        }
        $publisher->delete();

        return redirect()->route('publisher.index')->with('success', 'تم حذف دار النشر بنجاح');
    }

    public function searchSelect(Request $request)
    {
        $search = $request->input('search', '');
        $publishers = DB::table('publishers')
            ->select('id', 'publisher_name')
            ->where('publisher_name', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();

        return response()->json($publishers, 200);
    }
}
