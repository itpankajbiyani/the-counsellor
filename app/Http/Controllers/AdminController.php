<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Booking::with(['user', 'counsellor'])->orderBy('date', 'desc')->orderBy('start_time', 'desc');
        
        if ($request->has('counsellor_id') && $request->counsellor_id != '') {
            $query->where('counsellor_id', $request->counsellor_id);
        }
        
        $bookings = $query->get();
        $counsellors = User::where('role', 'counsellor')->get();
        return view('admin.dashboard', compact('bookings', 'counsellors'));
    }

    public function counsellorsIndex()
    {
        $counsellors = User::where('role', 'counsellor')->get();
        return view('admin.counsellors.index', compact('counsellors'));
    }

    public function storeCounsellor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'experience' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/counsellors'), $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'about' => $request->about,
            'experience' => $request->experience,
            'image' => $imageName,
            'role' => 'counsellor',
        ]);

        return back()->with('success', 'Counsellor added successfully.');
    }

    public function editCounsellor(User $user)
    {
        if ($user->role !== 'counsellor') abort(404);
        return view('admin.counsellors.edit', compact('user'));
    }

    public function updateCounsellor(Request $request, User $user)
    {
        if ($user->role !== 'counsellor') abort(404);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'experience' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->experience = $request->experience;
        
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/counsellors'), $imageName);
            $user->image = $imageName;
        }
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        return redirect()->route('admin.counsellors.index')->with('success', 'Counsellor updated.');
    }

    public function destroyCounsellor(User $user)
    {
        if ($user->role !== 'counsellor') abort(404);
        $user->delete();
        return back()->with('success', 'Counsellor deleted.');
    }

    public function blogsIndex()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function createBlog()
    {
        return view('admin.blogs.create');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/blogs'), $imageName);
        }
        
        Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imageName,
        ]);
        
        return back()->with('success', 'Blog added successfully.');
    }

    public function destroyBlog(Blog $blog)
    {
        $blog->delete();
        return back()->with('success', 'Blog deleted successfully.');
    }

    public function editBlog(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function updateBlog(Request $request, Blog $blog)
    {
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
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/blogs'), $imageName);
            $blog->image = $imageName;
        }
        
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function testimonialsIndex()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function createTestimonial()
    {
        return view('admin.testimonials.create');
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_year' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        
        Testimonial::create([
            'student_name' => $request->student_name,
            'course_year' => $request->course_year,
            'content' => $request->content,
        ]);
        
        return back()->with('success', 'Testimonial added successfully.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted successfully.');
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'course_year' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);
        
        $testimonial->student_name = $request->student_name;
        $testimonial->course_year = $request->course_year;
        $testimonial->content = $request->content;
        
        $testimonial->save();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }
}
