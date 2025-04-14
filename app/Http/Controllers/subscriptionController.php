<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class subscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::withCount('users')->get();
        return view('dashboard.subscriptions.index', compact('subscriptions'));
    }

    // إنشاء اشتراك جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            // 'is_active' => 'required|boolean',
        ]);

        Subscription::create($validated);

        return redirect()->back()->with('success', 'Subscription created successfully!');
    }

    // تحديث الاشتراك
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            // 'is_active' => 'required|boolean',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->update($validated);

        return redirect()->back()->with('success', 'Subscription updated successfully!');
    }

    // حذف الاشتراك
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->back()->with('success', 'Subscription deleted successfully!');
    }

    public function manageUsers(Subscription $subscription)
    {
        $users = $subscription->users; // المستخدمون المشتركين
        $allUsers = User::all(); // جميع المستخدمين لإضافتهم
        return view('dashboard.subscriptions.users', compact('subscription', 'users', 'allUsers'));
    }

    // إضافة مستخدم إلى الاشتراك
    public function addUser(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // حساب تاريخ الانتهاء بناءً على مدة الاشتراك
        $expiryDate = now()->addMonths($subscription->duration);

        // ربط المستخدم بالاشتراك مع تاريخ الانتهاء
        $subscription->users()->attach($validated['user_id'], ['expiry_date' => $expiryDate]);

        return redirect()->route('subscriptions.users', $subscription->id)->with('success', 'تم إضافة المستخدم بنجاح.');
    }

    // حذف مستخدم من الاشتراك
    public function removeUser(Request $request, Subscription $subscription, User $user)
    {
        $subscription->users()->detach($user->id);

        return redirect()->route('subscriptions.users', $subscription->id)
            ->with('success', 'تم حذف المستخدم من الاشتراك بنجاح');
    }

    // إزالة مستخدم من الاشتراك
    public function renewUser(Request $request, Subscription $subscription, User $user)
    {
        $request->validate([
            'expiry_date' => 'required|date|after_or_equal:today'
        ]);

        $subscription->users()->updateExistingPivot($user->id, [
            'expiry_date' => $request->expiry_date
        ]);

        return redirect()->route('subscriptions.users', $subscription->id)
            ->with('success', 'تم تجديد اشتراك المستخدم بنجاح');
    }
}
