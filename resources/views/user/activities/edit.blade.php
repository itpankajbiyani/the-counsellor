@extends('layouts.app')

@section('content')
<div class="w-full max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
    <div class="flex items-center mb-8 border-b border-[#C5BBAF] pb-4">
        <a href="{{ route('user.dashboard') }}" class="mr-4 text-[#8C7D70] hover:text-[#5E7363] transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-3xl font-bold text-[#333]">Edit {{ ucfirst($blog->type) }}</h2>
            <p class="text-[#555] text-sm mt-1">Update your submitted activity.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <ul class="list-disc pl-5 mt-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reading.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-[#333] font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
        </div>

        @if($blog->type === 'blog')
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-2">Blog Category</label>
                <select name="category" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ old('category', $blog->category) == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        @if($blog->type === 'painting')
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-2">Current Image</label>
                @if($blog->image)
                    <img src="{{ asset('images/activities/' . $blog->image) }}" class="w-full max-w-sm h-auto object-cover rounded-lg mb-3 border border-[#D5CBBF]">
                @endif
                <label class="block text-[#333] font-bold mb-2 mt-4">Replace Image (Optional, JPG/PNG, Max 4MB)</label>
                <input type="file" name="image" accept=".jpg,.jpeg,.png" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl">
            </div>
        @else
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-2">Content</label>
                <input type="hidden" name="content" id="activity-content">
                <div id="editor-container" class="bg-white rounded-xl h-64">{!! old('content', $blog->content) !!}</div>
            </div>
        @endif

        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('user.dashboard') }}" class="px-6 py-2.5 bg-gray-200 text-[#333] font-bold rounded-xl hover:bg-gray-300 transition">Cancel</a>
            <button type="submit" id="submit-btn" class="px-6 py-2.5 bg-[#5E7363] text-white font-bold rounded-xl hover:bg-[#4A5D4E] transition shadow">Save Changes</button>
        </div>
    </form>
</div>
@endsection

@if($blog->type !== 'painting')
@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow'
        });
        
        var form = document.querySelector('form');
        form.onsubmit = function() {
            if (quill.getText().trim().length === 0) {
                alert('Content is required');
                return false;
            }
            document.getElementById('activity-content').value = quill.root.innerHTML;
        };
    });
</script>
@endsection
@endif
