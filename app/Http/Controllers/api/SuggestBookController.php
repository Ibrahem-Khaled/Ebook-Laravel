<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SuggestBook;
use Illuminate\Http\Request;

class SuggestBookController extends Controller
{
    public function index(Request $request)
    {
        $books = SuggestBook::all();
        return view('dashboard.suggestBook', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        SuggestBook::create($request->all());

        return response()->json(['success' => 'Suggest book created successfully.']);
    }

    public function destroy($id)
    {
        SuggestBook::find($id)->delete();
        return redirect()->back()->with('success', 'Suggest book deleted successfully.');
    }

}
