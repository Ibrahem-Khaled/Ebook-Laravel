<?php

namespace App\Http\Controllers;

use App\Models\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends Controller
{

    // عرض قائمة الشرائح
    public function index()
    {
        $slides = SlideShow::all();
        return view('dashboard.slides.index', compact('slides'));
    }

    // تخزين شريحة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'related_id' => 'nullable|integer',
            'type_related' => 'nullable|in:book,author,publisher',
        ]);

        $imagePath = $request->file('image')->store('slides', 'public');

        SlideShow::create([
            'image' => $imagePath,
            'related_id' => $request->related_id,
            'type_related' => $request->type_related,
        ]);

        return redirect()->route('slides.index')->with('success', 'تم إنشاء الشريحة بنجاح.');
    }

    // تحديث شريحة موجودة
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'related_id' => 'nullable|integer',
            'type_related' => 'nullable|in:book,author,publisher',
        ]);

        $slide = SlideShow::findOrFail($id);

        $imagePath = $slide->image;
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إن وُجدت
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            $imagePath = $request->file('image')->store('slides', 'public');
        }

        $slide->update([
            'image' => $imagePath,
            'related_id' => $request->related_id,
            'type_related' => $request->type_related,
        ]);

        return redirect()->route('slides.index')->with('success', 'تم تحديث الشريحة بنجاح.');
    }

    // حذف شريحة
    public function destroy($id)
    {
        $slide = SlideShow::findOrFail($id);
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();
        return redirect()->route('slides.index')->with('success', 'تم حذف الشريحة بنجاح.');
    }
}
