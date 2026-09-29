<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function blogs(Request $request)
    {
        $query = Blog::where('type', 'blog')->where('status', 'approved')->where('is_active', true);
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }
        
        $activities = $query->latest()->get();
        $categories = \App\Models\BlogCategory::where('is_active', true)->orderBy('name')->get();
        
        return view('reading_corner.index', compact('activities', 'categories'))->with('type', 'blog');
    }

    public function paintings()
    {
        $activities = Blog::where('type', 'painting')->where('status', 'approved')->where('is_active', true)->latest()->get();
        return view('reading_corner.index', compact('activities'))->with('type', 'painting');
    }

    public function poetry()
    {
        $activities = Blog::where('type', 'poetry')->where('status', 'approved')->where('is_active', true)->latest()->get();
        return view('reading_corner.index', compact('activities'))->with('type', 'poetry');
    }

    public function create()
    {
        $categories = \App\Models\BlogCategory::where('is_active', true)->orderBy('name')->get();
        return view('reading_corner.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:blog,painting,poetry',
            'category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->type = $request->type;
        $blog->category = $request->category;
        $blog->content = $request->content;
        $blog->user_id = Auth::id();
        
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'counsellor') {
            $blog->status = 'approved';
            $blog->is_active = true;
        } else {
            $blog->status = 'pending';
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/activities'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();

        $message = $blog->status === 'approved' 
            ? ucfirst($request->type) . ' posted successfully.' 
            : ucfirst($request->type) . ' submitted successfully. It will be visible after admin approval.';

        return back()->with('success', $message);
    }

    public function destroy(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }

        if ($blog->image && file_exists(public_path('images/activities/' . $blog->image))) {
            unlink(public_path('images/activities/' . $blog->image));
        }
        
        $blog->delete();
        return back()->with('success', 'Deleted successfully.');
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }
        
        $categories = \App\Models\BlogCategory::where('is_active', true)->orderBy('name')->get();
        return view('user.activities.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && file_exists(public_path('images/activities/' . $blog->image))) {
                unlink(public_path('images/activities/' . $blog->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/activities'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();

        return redirect()->route('user.dashboard')->with('success', 'Activity updated successfully.');
    }

    // Admin Methods
    public function adminIndex()
    {
        $pendingActivities = Blog::where('status', 'pending')->latest()->get();
        $approvedActivities = Blog::where('status', 'approved')->whereNotNull('user_id')->latest()->get();
        return view('admin.activities.index', compact('pendingActivities', 'approvedActivities'));
    }

    public function approve(Blog $blog)
    {
        $blog->status = 'approved';
        $blog->save();
        return back()->with('success', 'Activity approved.');
    }

    public function reject(Blog $blog)
    {
        $blog->status = 'rejected';
        $blog->save();
        return back()->with('success', 'Activity rejected.');
    }
}
