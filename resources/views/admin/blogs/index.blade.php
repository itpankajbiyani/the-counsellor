@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Add Blog Form -->
        <div class="w-full md:w-1/3">
            <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
                <h3 class="text-xl font-bold text-[#333] mb-4">Add Blog</h3>
                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-[#333] font-bold mb-1">Title</label>
                        <input type="text" name="title" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[#333] font-bold mb-1">Category (e.g. Mental Wellbeing)</label>
                        <input type="text" name="category" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" maxlength="255">
                    </div>
                    <div class="mb-4">
                        <label class="block text-[#333] font-bold mb-1">Link (Read More URL)</label>
                        <input type="url" name="link" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]">
                    </div>
                    <div class="mb-6">
                        <label class="block text-[#333] font-bold mb-1">Image (Max 4MB)</label>
                        <input type="file" name="image" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    <button type="submit" class="w-full py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow">Add Blog</button>
                </form>
            </div>
        </div>

        <!-- Blogs List -->
        <div class="w-full md:w-2/3">
            <h3 class="text-2xl font-bold text-[#333] mb-6">Manage Blogs</h3>
            <div class="space-y-4">
                @forelse($blogs as $blog)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($blog->image)
                                <img src="{{ asset('images/blogs/' . $blog->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                            @endif
                            <div>
                                <div class="font-bold text-[#333] text-lg">{{ $blog->title }}</div>
                                <div class="text-sm text-[#555]">{{ $blog->category }}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
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
        </div>
    </div>
</div>
@endsection
