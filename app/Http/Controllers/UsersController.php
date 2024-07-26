<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $roles = Role::all();

        } else {
            $users = User::all();
            $books = Book::all();
            $roles = Role::all();
        }

        return view('users.index', compact('users', 'books', 'roles'));
    }

    public function update(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'User updated successfully');
    }


    public function showBook($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $userBooks = $user->books()->get();
        return view('users.show', compact('userBooks', 'userId'));
    }

    public function destroyBook($userId, $bookId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }

        $user->books()->detach($bookId);
        return redirect()->route('user.show.books', $userId)->with('success', 'Book detached successfully');
    }

    public function delete($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        try {
            $user->delete();
            return back()->with('success', 'User and associated books deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while deleting the user'], 500);
        }
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
    public function updateUserRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user->update([
            'role_id' => $request->role,
        ]);

        return redirect()->back()->with('message', 'User role updated successfully');
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        return view('users.profile', compact('user'));
    }

}
