@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-[#333]">Manage Blogs</h3>
        <a href="{{ route('admin.blogs.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New Blog</a>
    </div>

    <div class="w-full">
        <div class="space-y-4">
                @forelse($blogs as $blog)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($blog->image)
                                <img src="{{ asset('images/blogs/' . $blog->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                            @endif
                            <div>
                                <div class="font-bold text-[#333] text-lg">
                                    {{ $blog->title }}
                                    @if($blog->is_active)
                                        <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full uppercase">Active</span>
                                    @else
                                        <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full uppercase">Inactive</span>
                                    @endif
                                </div>
                                <div class="text-sm text-[#555]">{{ $blog->category }}</div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                            <form action="{{ route('admin.blogs.toggle', $blog) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 {{ $blog->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold rounded">
                                    {{ $blog->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="px-3 py-1 bg-[#5a7b6b] text-white text-sm font-bold rounded hover:bg-[#4a6758]">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-[#555] bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg">No blogs added yet.</div>
                @endforelse
            </div>
@endsection
