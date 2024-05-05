<?php

namespace App\Http\Controllers;

use App\Models\Notifcation;
use Illuminate\Http\Request;

class NotifcationsController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = Notifcation::all();
        return view('notifcation.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notification_images', 'public');
        } else {
            $imagePath = null;
        }
        Notifcation::create([
            'title' => $request->title,
            'desc' => $request->description,
            'image' => $imagePath
        ]);
        return redirect()->back()->with('success', 'Notification created successfully.');
    }

    public function update(Request $request, Notifcation $notification)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Example validation for image upload
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notification_images', 'public');
            // Delete old image if exists
            if ($notification->image_path) {
                \Storage::disk('public')->delete($notification->image_path);
            }
            $notification->image_path = $imagePath;
        }

        // Update the notification
        $notification->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect back with success message
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    // Remove the specified notification from the database
    public function destroy($notificationId)
    {
        $notification = Notifcation::find($notificationId);
        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
