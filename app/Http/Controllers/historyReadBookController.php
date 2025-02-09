<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class historyReadBookController extends Controller
{
    public function index(User $user)
    {
        $readingData = $user->bookReadHistory()
            ->with('author') // جلب بيانات المؤلف إذا كانت موجودة
            ->get();
        return view('subscriptions.history_books_read', compact('readingData'));
    }
}
