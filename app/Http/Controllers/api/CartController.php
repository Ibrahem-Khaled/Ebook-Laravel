<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserBook;
use App\Models\UserCarts;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->guard('api')->user();

        if ($user) {
            $carts = $user->carts;
            $bookDetails = [];
            $sumPrice = 0;

            foreach ($carts as $cart) {
                $book = Book::find($cart->book_id);
                if ($book) {
                    $newPrice = $book->book_price * (1 - $cart->discount_price / 100);
                    $book->book_price = $newPrice;
                    $sumPrice += $book->book_price;
                    $book->cart_id = $cart->id;
                    $bookDetails[] = $book;
                }
            }

            // Get the count of books in the cart
            $bookCount = $carts->count();

            return response()->json([
                'userCart' => $bookDetails,
                'sumPrice' => $sumPrice,
                'bookCount' => $bookCount,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function addToCart(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        if ($user) {
            UserCarts::create([
                'user_id' => $user->id,
                'book_id' => $validatedData['book_id'],
            ]);
            return response()->json(['success' => 'Book added to cart successfully'], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function deleteFromCart(Request $request)
    {
        $user = auth()->guard('api')->user();
        if ($user) {
            $validatedData = $request->validate([
                'cart_item_id' => 'required|exists:user_carts,id',
            ]);
            $cartItem = UserCarts::where('user_id', $user->id)
                ->where('id', $validatedData['cart_item_id'])
                ->first();
            if ($cartItem) {
                $cartItem->delete();
                return response()->json(['success' => 'Item removed from cart successfully'], 200);
            } else {
                return response()->json(['error' => 'Cart item not found for the user'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function removedBooksFromCartAndAddToUserBooks($userId, $type = 'subscription', $subscriptionId = null)
    {
        $user = User::find($userId);
        if ($user) {
            if ($type == 'subscription') {
                $userSubscription = UserSubscription::create([
                    'user_id' => $user->id,
                    'subscription_id' => $subscriptionId,
                    'expiry_date' => now()->addMonths(Subscription::find($subscriptionId)->duration),
                ]);

                return response()->json([
                    'success' => 'subscription added successfully',
                    'userSubscription' => $userSubscription,
                ], 200);
            }

            $carts = $user->carts;
            foreach ($carts as $cart) {
                UserBook::create([
                    'user_id' => $cart->user_id,
                    'book_id' => $cart->book_id,
                ]);
                $cart->delete();
            }
            return view('payment.success');
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function userBook(Request $request)
    {
        $user = auth()->guard('api')->user();

        if ($user) {
            $books = $user->books;
            return response()->json([
                'userBook' => $books,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function addFreeBookToUserBooks(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        if ($user) {
            UserBook::create([
                'user_id' => $user->id,
                'book_id' => $validatedData['book_id'],
            ]);
            return response()->json(['success' => 'Book added to user books successfully'], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function sendBookAndRemoveInSender(Request $request)
    {
        $bookId = $request->bookId;
        $reciver = User::where('email', $request->email)->first();
        $user = auth()->guard('api')->user();
        if (!$reciver) {
            return response()->json(['error' => 'Reciver not found'], 404);
        }
        if ($user) {
            $book = UserBook::where('user_id', $user->id)->where('book_id', $bookId)->first();
            if ($book) {
                $book->delete();
                $reciver->books()->attach($bookId);
                return response()->json(['success' => 'Book sent successfully'], 200);
            } else {
                return response()->json(['error' => 'Book not found in sender'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}
