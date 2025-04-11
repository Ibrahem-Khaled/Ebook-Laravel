<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // عرض قائمة الفئات
    public function index()
    {
        $categories = Category::withCount(['subCategories', 'books'])->orderBy('order')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    // إضافة فئة جديدة مع رفع الصورة
    public function store(Request $request)
    {
        // التحقق من صحة البيانات مع التحقق من الصورة
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path("img/categories/");
            if ($image->move($destinationPath, $imageName)) {
                Category::create([
                    'category_name' => $validatedData['category_name'],
                    'category_description' => $validatedData['category_description'] ?? '',
                    'order' => $validatedData['order'] ?? 0,
                    'category_image_url' => 'img/categories/' . $imageName,
                ]);
            }
        }

        return redirect()->back()->with('message', 'تمت إضافة الفئة بنجاح');
    }

    // تعديل الفئة
    public function update(Request $request, Category $category)
    {
        // في حالة التعديل، لا نقوم برفع الصورة مرة أخرى؛ نستخدم الرابط الحالي للصورة
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string',
            'order' => 'nullable|integer',
            // نتحقق من فريدة الرابط مع استثناء السجل الحالي
            // 'category_image_url' => 'required|url|unique:categories,category_image_url,' . $category->id,
        ]);

        $category->update($validatedData);

        return redirect()->back()->with('message', 'تم تحديث الفئة بنجاح');
    }

    // حذف الفئة
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', 'تم حذف الفئة بنجاح');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->order; // مصفوفة تحتوي على معرفات الفئات بالترتيب الجديد
        foreach ($order as $index => $id) {
            // تحديث حقل order لكل فئة بناءً على موقعها الجديد
            Category::where('id', $id)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}
