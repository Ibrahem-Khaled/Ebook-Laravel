<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $books = Book::all();
        if ($users) {
            return view('users.index', compact('users', 'books'));
        }
    }
    public function showBook($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $userBooks = $user->books()->get();
        return view('users.show', compact('userBooks'));
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->books()->delete();
        $user->delete();
        return back()->with('success', 'User and associated books deleted successfully');
    }

    public function addBookFromUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $userBook = UserBook::create([
            'user_id' => $validatedData['user_id'],
            'book_id' => $validatedData['book_id'],
        ]);

        if ($userBook) {
            return redirect()->back()->with('message', 'Book added successfully');
        } else {
            return redirect()->back()->with('message', 'Failed to add book');
        }
    }
}
