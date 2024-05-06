<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class userFavoriteController extends Controller
{
    public function favorite()
    {
        $user = auth()->guard('api')->user();
        $favoriteBooks = $user->bookFav;

        return response()->json($favoriteBooks, 200);
    }
    public function addForFavorite(Request $request)
    {
        $user = auth()->guard('api')->user();

        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($existingFavorite) {
            return response()->json(['message' => 'The book is already in favorites.'], 400);
        }

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'book_id' => $request->book_id
        ]);

        return response()->json($favorite, 200);
    }

    public function deleteForFavorite(Request $request)
    {
        $user = auth()->guard('api')->user();
        $favorite = Favorite::where([
            'user_id' => $user->id,
            'book_id' => $request->book_id
        ])->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Favorite deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Favorite not found'], 404);
        }
    }

}
