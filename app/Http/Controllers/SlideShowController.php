<?php

namespace App\Http\Controllers;

use App\Models\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SlideShowController extends Controller
{

    public function index()
    {
        $slides = SlideShow::all();
        return view('SlideShow.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imagePath = $request->file('image')->store('slides', 'public');
        SlideShow::create([
            'image' => $imagePath,
        ]);

        return back()->with('success', 'تم إنشاء السلايد شو بنجاح.');
    }
    public function delete(Request $request, $slideId)
    {
        $slide = SlideShow::find($slideId);
        if (!$slide) {
            return response()->json(['error' => 'Slide not found'], 404);
        }
        $slide->delete();
        return back()->with('success', 'تم حذف السلايد بنجاح.');
    }

}
