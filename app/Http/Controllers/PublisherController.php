<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $publishersQuery = Publisher::query()->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->get('search');
            $publishersQuery->where(function ($query) use ($search) {
                $query->where('publisher_name', 'like', "%$search%")
                    ->orWhere('desc', 'like', "%$search%");
            });
        }

        $publishers = $publishersQuery->paginate(10);

        $totalPublishers = Publisher::count();
        $publishersWithSocial = Publisher::whereNotNull('fb')
            ->orWhereNotNull('yt')
            ->orWhereNotNull('telegram')
            ->orWhereNotNull('whatsapp')
            ->orWhereNotNull('instagram')
            ->count();

        return view('dashboard.publishers.index', compact(
            'publishers',
            'totalPublishers',
            'publishersWithSocial'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:255|unique:publishers',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc' => 'nullable|string',
            'fb' => 'nullable|url',
            'yt' => 'nullable|url',
            'telegram' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publishers/images', 'public');
        }

        Publisher::create($data);

        return redirect()->route('publishers.index')->with('success', 'تم إضافة الناشر بنجاح');
    }

    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:255|unique:publishers,publisher_name,' . $publisher->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc' => 'nullable|string',
            'fb' => 'nullable|url',
            'yt' => 'nullable|url',
            'telegram' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'instagram' => 'nullable|url',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($publisher->image) {
                Storage::disk('public')->delete($publisher->image);
            }
            $data['image'] = $request->file('image')->store('publishers/images', 'public');
        }

        $publisher->update($data);

        return redirect()->route('publishers.index')->with('success', 'تم تحديث الناشر بنجاح');
    }

    public function destroy(Publisher $publisher)
    {
        if ($publisher->image) {
            Storage::disk('public')->delete($publisher->image);
        }

        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'تم حذف الناشر بنجاح');
    }
}
