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
        $books = Book::all();
        $roles = Role::all();

        if ($q) {
            $users = User::where('name', 'like', '%' . $q . '%')
                ->orWhere('email', 'like', '%' . $q . '%')
                ->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        $publishers = Publisher::all();
        $authors = Author::all();
        return view('dashboard.users.index', compact('users', 'books', 'roles', 'publishers', 'authors'));
    }

    // حفظ مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'is_active'=>'required|boolean',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'تمت إضافة المستخدم بنجاح');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'is_active'=>'required|boolean',
            'role_id' => 'required|exists:roles,id',
        ]);

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->is_active,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
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


    //this function for add book to user ///
    public function showBook($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'المستخدم غير موجود');
        }
        $userBooks = $user->books()->paginate(6); // عرض 6 كتب في الصفحة
        return view('dashboard.users.books', compact('userBooks', 'user'));
    }

    public function destroyBook($userId, $bookId)
    {
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }

        $user->books()->detach($bookId);

        return redirect()->back()->with('success', 'Book removed successfully');
    }

    public function addBooksFromUser(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id',
        ]);

        foreach ($validatedData['book_ids'] as $bookId) {
            // التحقق من عدم وجود الكتاب للمستخدم قبل الإضافة
            $exists = UserBook::where('user_id', $userId)
                ->where('book_id', $bookId)
                ->exists();

            if (!$exists) {
                UserBook::create([
                    'user_id' => $userId,
                    'book_id' => $bookId,
                ]);
            }
        }
        return redirect()->back()->with('message', 'Books added successfully');
    }

    //this function for add author and publisher to user ///
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
