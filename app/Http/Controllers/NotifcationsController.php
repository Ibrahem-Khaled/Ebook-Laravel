<?php

namespace App\Http\Controllers;

use App\Models\Notifcation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotifcationsController extends Controller
{
    public function index()
    {
        $notifications = Notifcation::with('user')->latest()->get();
        $totalNotifications = $notifications->count();
        $notificationsWithUsers = $notifications->whereNotNull('user_id')->count();
        $notificationsWithoutUsers = $notifications->whereNull('user_id')->count();
        $latestNotifications = $notifications->take(5);
        $users = User::all();

        return view('dashboard.notifcations.index', compact(
            'notifications',
            'totalNotifications',
            'notificationsWithUsers',
            'notificationsWithoutUsers',
            'latestNotifications',
            'users'
        ));
    }
    // تخزين إشعار جديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'nullable|string',
            'user_id' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // تخزين الصورة داخل مجلد "notifcations" في التخزين العام
            $imagePath = $request->file('image')->store('notifcations', 'public');
        }

        Notifcation::create([
            'title' => $request->title,
            'image' => $imagePath,
            'desc' => $request->desc,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('notifcations.index')->with('success', 'تم إنشاء الإشعار بنجاح.');
    }

    // عرض صفحة التعديل (غير مستخدمة في الـ CRUD باستخدام Modal)
    public function show($id)
    {
        // يمكن استخدامها لعرض تفاصيل الإشعار بشكل منفصل إذا رغبت
        $notifcation = Notifcation::findOrFail($id);
        return view('dashboard.notifcations.show', compact('notifcation'));
    }

    // تحديث إشعار موجود
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'nullable|string',
            'user_id' => 'nullable|integer',
        ]);

        $notifcation = Notifcation::findOrFail($id);

        $imagePath = $notifcation->image;
        if ($request->hasFile('image')) {
            if ($notifcation->image) {
                Storage::disk('public')->delete($notifcation->image);
            }
            $imagePath = $request->file('image')->store('notifcations', 'public');
        }

        $notifcation->update([
            'title' => $request->title,
            'image' => $imagePath,
            'desc' => $request->desc,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('notifcations.index')->with('success', 'تم تحديث الإشعار بنجاح.');
    }

    // حذف إشعار
    public function destroy($id)
    {
        $notifcation = Notifcation::findOrFail($id);
        if ($notifcation->image) {
            Storage::disk('public')->delete($notifcation->image);
        }
        $notifcation->delete();
        return redirect()->route('notifcations.index')->with('success', 'تم حذف الإشعار بنجاح.');
    }
}
