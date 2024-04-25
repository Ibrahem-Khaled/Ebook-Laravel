<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();
        return view('publisher.index', compact('publishers'));
    }

    public function create()
    {
        return view('publisher.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            // Store the PDF file in the storage disk
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
            'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
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
            'publisher_name' => 'required'
        ]);

        $publisher = Publisher::findOrFail($id);

        if ($request->hasFile('image')) {
            $pdfFile = $request->file('image');
            $pdfFileName = Str::slug($request->author_name) . '.' . $pdfFile->getClientOriginalExtension();
            // Store the PDF file in the storage disk
            $profilePath = $pdfFile->storeAs('profiles', $pdfFileName, 'public');
        }

        $publisher->update([
            'publisher_name' => $request->publisher_name,
            'desc' => $request->desc,
            'image' => $request->hasFile('image') ? $profilePath : $publisher->image,
            'fb' => $request->fb,
            'yt' => $request->yt,
            'telegram' => $request->telegram,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('publisher.index')->with('success', 'Editorial actualizada correctamente');
    }

    public function delete($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()->route('publisher.index')->with('success', 'Editorial eliminada exitosamente.');
    }

    public function searchSelect(Request $request)
    {
        $sql = "SELECT publishers.id, publishers.publisher_name FROM publishers WHERE publisher_name LIKE '%$request->search%' LIMIT 5";
        $publishers = DB::select($sql);
        return response()->json($publishers, 200);
    }



}
