<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('query');

        if ($q) {
            $users = User::where('name', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->get();
            $books = Book::all();
            $role = Role::all();

        } else {
            $users = User::all();
            $books = Book::all();
            $role = Role::all();
        }

        return view('users.index', compact('users', 'books', 'role'));
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
    public function addNewUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('message', 'User added successfully');
    }

}
