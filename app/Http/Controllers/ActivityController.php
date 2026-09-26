<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function blogs()
    {
        $activities = Blog::where('type', 'blog')->where('status', 'approved')->latest()->get();
        return view('reading_corner.index', compact('activities'))->with('type', 'blog');
    }

    public function paintings()
    {
        $activities = Blog::where('type', 'painting')->where('status', 'approved')->latest()->get();
        return view('reading_corner.index', compact('activities'))->with('type', 'painting');
    }

    public function poetry()
    {
        $activities = Blog::where('type', 'poetry')->where('status', 'approved')->latest()->get();
        return view('reading_corner.index', compact('activities'))->with('type', 'poetry');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:blog,painting,poetry',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->type = $request->type;
        $blog->content = $request->content;
        $blog->user_id = Auth::id();
        $blog->status = 'pending';

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/activities'), $imageName);
            $blog->image = $imageName;
        }

        $blog->save();

        return back()->with('success', ucfirst($request->type) . ' submitted successfully. It will be visible after admin approval.');
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
