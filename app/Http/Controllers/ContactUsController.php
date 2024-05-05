<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contact = ContactUs::all();
        return view('contactUs', compact('contact'));
    }
    public function destroy($contactId)
    {
        $contact = ContactUs::find($contactId);
        if (!$contact) {
            return redirect()->back()->with('error', 'Contact message not found.');
        }
        $contact->delete();
        return redirect()->back()->with('success', 'Contact message deleted successfully.');
    }
}
