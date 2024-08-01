<?php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $users = User::all();
        $chats = Chat::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->orWhere('receiver_id', $userId);
        })
            ->where('is_deleted', false)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('dashboard.chats.index', compact('chats', 'user', 'users'));
    }

    public function users()
    {
        $users = User::all();
        return view('dashboard.chats.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Chat::create([
            'user_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
            'type' => $request->type ?? 'text',
        ]);

        return redirect()->back()->with('message', 'Message sent successfully');
    }

    public function update(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);

        $request->validate([
            'message' => 'required',
        ]);

        $chat->update(['message' => $request->message]);

        return redirect()->back()->with('message', 'Message updated successfully');
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->update(['is_deleted' => true]);

        return redirect()->back()->with('message', 'Message updated successfully');
    }
}
