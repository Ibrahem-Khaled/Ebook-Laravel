<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show()
    {
        $user = auth()->guard('api')->user();
        $chats = Chat::where('receiver_id', $user->id)->orWhere('user_id', $user->id)->get();
        return response()->json($chats);
    }


    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
        $recevier = User::where('role_id', 1)->first();
        $user = auth()->guard('api')->user();
        $chat = new Chat();
        $chat->message = $request->message;
        $chat->user_id = $user->id;
        $chat->receiver_id = $recevier->id;
        $chat->save();
        return response()->json($chat);
    }
}
