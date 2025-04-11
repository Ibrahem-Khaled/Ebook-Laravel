<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // عرض قائمة الأدوار
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    // إضافة دور جديد
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        Role::create([
            'role_name' => $request->role_name,
        ]);

        return redirect()->back()->with('message', 'تمت إضافة الدور بنجاح');
    }

    // تعديل الدور
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role->update([
            'role_name' => $request->role_name,
        ]);

        return redirect()->back()->with('message', 'تم تحديث الدور بنجاح');
    }

    // حذف الدور
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'تم حذف الدور بنجاح');
    }
}
