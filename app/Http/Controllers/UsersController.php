<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
use App\Models\userAuthorPublisher;
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
                ->paginate(10);
            $books = Book::all();
            $roles = Role::all();

        } else {
            $users = User::paginate(10);
            $books = Book::all();
            $roles = Role::all();
        }

        $publishers = Publisher::all();
        $authors = Author::all();
        return view('users.index', compact('users', 'books', 'roles', 'publishers', 'authors'));
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

    public function addBooksFromUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id',
        ]);

        foreach ($validatedData['book_ids'] as $bookId) {
            UserBook::create([
                'user_id' => $validatedData['user_id'],
                'book_id' => $bookId,
            ]);
        }

        return redirect()->back()->with('message', 'Books added successfully');
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

    public function addAuthorAndPublisherFromUser(Request $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        userAuthorPublisher::create([
            'user_id' => $userId,
            'author_id' => $request->author_id,
            'publisher_id' => $request->publisher_id,
        ]);

        return redirect()->back()->with('message', 'Author and publisher added successfully');
    }

    public function getAuthorAndPublisherFromUser(Request $request, $userId)
    {
        $user = User::with(['author.books', 'publisher.books'])->find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'المستخدم غير موجود');
        }
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $books = collect();

        foreach ($user->author as $author) {
            $books = $books->merge($author->books);
        }

        foreach ($user->publisher as $publisher) {
            $books = $books->merge($publisher->books);
        }
        $books = $books->unique('id');

        // فلترة الكتب حسب التواريخ إذا كانت موجودة
        if ($startDate || $endDate) {
            $books = $books->filter(function ($book) use ($startDate, $endDate) {
                $releaseDate = $book->release_date;

                // التحقق من وجود تاريخ الإصدار
                if (!$releaseDate) {
                    return false;
                }

                // التحقق من مطابقة الكتاب للنطاق الزمني المطلوب
                $withinStart = $startDate ? $releaseDate >= $startDate : true;
                $withinEnd = $endDate ? $releaseDate <= $endDate : true;

                return $withinStart && $withinEnd;
            });
        }
        return view('users.author_publisher', compact('user', 'books'));
    }

    public function followedPublishersAndAuthors($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $followedPublishers = $user->publisher;
        $followedAuthors = $user->author;

        

        return view('users.followeDpublisherSandAuthors', compact('user', 'followedPublishers', 'followedAuthors'));
    }

    public function deleteUserFollowedPublisherAndAuthor($id)
    {
        $followedPublisherAndAuthor = userAuthorPublisher::find($id);
        if (!$followedPublisherAndAuthor) {
            return redirect()->back()->with('error', 'Publisher or Author not found');
        }
        $followedPublisherAndAuthor->delete();
        return redirect()->back()->with('message', 'Publisher deleted successfully');
    }



}
