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

    // عرض قائمة الناشرين مع إمكانية البحث (اختياري)
    public function index(Request $request)
    {
        $q = $request->query('query');

        $publishers = Publisher::query()
            ->withCount('books') // إضافة عدد الكتب لكل ناشر
            ->when($q, function ($query, $q) {
                return $query->where('publisher_name', 'like', '%' . $q . '%')
                    ->orWhere('desc', 'like', '%' . $q . '%');
            })
            ->get();

        return view('dashboard.publishers.index', compact('publishers', 'q'));
    }

    // تخزين بيانات الناشر الجديد مع رفع الصورة إن وُجدت
    public function store(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profilePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::slug($request->publisher_name) . '.' . $file->getClientOriginalExtension();
            $profilePath = $file->storeAs('profiles', $fileName, 'public');
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
        ]);

        return redirect()->route('publisher.index')->with('success', 'تم إنشاء الناشر بنجاح.');
    }

    // تحديث بيانات الناشر وتعديل الصورة إن وُجدت
    public function update(Request $request, $id)
    {
        $request->validate([
            'publisher_name' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $publisher = Publisher::findOrFail($id);

        $profilePath = $publisher->image;
        if ($request->hasFile('image')) {
            if ($publisher->image) {
                Storage::disk('public')->delete($publisher->image);
            }
            $file = $request->file('image');
            $fileName = Str::slug($request->publisher_name) . '.' . $file->getClientOriginalExtension();
            $profilePath = $file->storeAs('profiles', $fileName, 'public');
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
        ]);

        return redirect()->route('publisher.index')->with('success', 'تم تحديث الناشر بنجاح.');
    }

    // حذف الناشر مع حذف الصورة إن وُجدت
    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        if ($publisher->image) {
            Storage::disk('public')->delete($publisher->image);
        }
        $publisher->delete();

        return redirect()->route('publisher.index')->with('success', 'تم حذف الناشر بنجاح.');
    }

}
