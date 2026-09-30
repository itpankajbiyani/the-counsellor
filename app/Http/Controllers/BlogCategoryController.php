<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
        ]);
        BlogCategory::create(['name' => $request->name]);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category added.');
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog_categories.edit', compact('blog_category'));
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blog_category->id,
        ]);
        $blog_category->update(['name' => $request->name]);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function toggle(BlogCategory $blog_category)
    {
        $blog_category->is_active = !$blog_category->is_active;
        $blog_category->save();
        return back()->with('success', 'Category status updated.');
    }
}
