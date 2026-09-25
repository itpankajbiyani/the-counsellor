@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto">
    <div class="flex items-center space-x-4 mb-6">
        <a href="{{ route('admin.blogs.index') }}" class="text-[#5a7b6b] hover:underline font-bold">← Back to Blogs</a>
        <h2 class="text-3xl font-bold text-[#333]">Edit Blog</h2>
    </div>

    <div class="bg-[#E5DCD3] p-8 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Title</label>
                <input type="text" name="title" value="{{ $blog->title }}" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Category (e.g. Mental Wellbeing)</label>
                <input type="text" name="category" value="{{ $blog->category }}" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Content (Optional)</label>
                <input type="hidden" name="content" id="content_input">
                <div id="editor" class="bg-white text-[#333] mb-2" style="min-height: 250px;">{!! $blog->content !!}</div>
            </div>

            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-1">Image (Max 4MB)</label>
                @if($blog->image)
                    <div class="mb-2 text-sm text-[#555]">Current Image: <img src="{{ asset('images/blogs/' . $blog->image) }}" class="h-16 mt-1 rounded border border-[#D5CBBF]"></div>
                @endif
                <input type="file" name="image" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" accept="image/jpeg,image/png,image/jpg">
                <p class="text-xs text-[#555] mt-1">Leave blank to keep current image.</p>
            </div>
            <button type="submit" class="w-full py-3 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow text-lg">Update Blog</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
    var form = document.querySelector('form');
    form.onsubmit = function() {
        var content = document.querySelector('#content_input');
        content.value = quill.root.innerHTML;
    };
</script>
@endsection
