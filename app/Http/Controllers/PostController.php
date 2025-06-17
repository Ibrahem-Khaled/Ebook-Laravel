<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $selectedTab = $request->get('tab', 'all');

        // إحصائيات المنشورات
        $totalPosts = Post::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();
        $userPosts = auth()->user()->posts()->count();
        $users = User::all();
        // تصفية المنشورات حسب التبويب المختار
        $query = Post::query();

        if ($selectedTab === 'published') {
            $query->where('status', 'published');
        } elseif ($selectedTab === 'draft') {
            $query->where('status', 'draft');
        } elseif ($selectedTab === 'mine') {
            $query->where('user_id', auth()->id());
        }

        // البحث
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $posts = $query->latest()->paginate(10);

        return view('dashboard.posts.index', compact(
            'posts',
            'selectedTab',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'userPosts',
            'users'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|in:published,draft',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $postData = $request->except(['images', 'files']);

        // معالجة الصور
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts/images', 'public');
                $images[] = $path;
            }
            $postData['images'] = json_encode($images);
        }

        // معالجة الملفات
        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $path = $file->store('posts/files', 'public');
                $files[] = $path;
            }
            $postData['files'] = json_encode($files);
        }

        $post = Post::create($postData);

        return redirect()->route('posts.index')
            ->with('success', 'تم إنشاء المنشور بنجاح.');
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|in:published,draft',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $postData = $request->except(['images', 'files']);

        // معالجة الصور الجديدة
        if ($request->hasFile('images')) {
            $images = json_decode($post->images, true) ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts/images', 'public');
                $images[] = $path;
            }
            $postData['images'] = json_encode($images);
        }

        // معالجة الملفات الجديدة
        if ($request->hasFile('files')) {
            $files = json_decode($post->files, true) ?? [];
            foreach ($request->file('files') as $file) {
                $path = $file->store('posts/files', 'public');
                $files[] = $path;
            }
            $postData['files'] = json_encode($files);
        }

        $post->update($postData);

        return redirect()->route('posts.index')
            ->with('success', 'تم تحديث المنشور بنجاح.');
    }

    public function destroy(Post $post)
    {
        // حذف الصور المرتبطة
        if ($post->images) {
            foreach (json_decode($post->images) as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // حذف الملفات المرتبطة
        if ($post->files) {
            foreach (json_decode($post->files) as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'تم حذف المنشور بنجاح.');
    }

    public function deleteImage(Post $post, $imageIndex)
    {
        $images = json_decode($post->images, true);
        if (isset($images[$imageIndex])) {
            Storage::disk('public')->delete($images[$imageIndex]);
            unset($images[$imageIndex]);
            $post->update(['images' => json_encode(array_values($images))]);
        }

        return back()->with('success', 'تم حذف الصورة بنجاح.');
    }

    public function deleteFile(Post $post, $fileIndex)
    {
        $files = json_decode($post->files, true);
        if (isset($files[$fileIndex])) {
            Storage::disk('public')->delete($files[$fileIndex]);
            unset($files[$fileIndex]);
            $post->update(['files' => json_encode(array_values($files))]);
        }

        return back()->with('success', 'تم حذف الملف بنجاح.');
    }
}
