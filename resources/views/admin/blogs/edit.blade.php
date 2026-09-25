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

            @if($blog->image)
                <div class="mb-6 flex justify-center">
                    <img id="current-image-preview" src="{{ asset('images/blogs/' . $blog->image) }}" class="h-32 w-auto object-contain rounded-lg border border-[#D5CBBF] shadow-sm bg-white">
                </div>
            @endif
            
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-1">Update Image (Max 4MB, JPG/PNG)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#D5CBBF] border-dashed rounded-lg cursor-pointer bg-[#FAF6F4] hover:bg-[#F2EAE1] @error('image') border-red-500 @enderror relative overflow-hidden">
                        <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-[#5a7b6b]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-[#555]"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover">
                        <input id="image-upload" name="image" type="file" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(event, 'image-preview', 'upload-placeholder', 'current-image-preview', 'image-error')" />
                    </label>
                </div>
                @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                <span id="image-error" class="text-red-500 text-xs font-bold mt-1 block"></span>
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

function previewImage(event, previewId, placeholderId, currentImageId, errorSpanId) {
    const input = event.target;
    const errorSpan = document.getElementById(errorSpanId);
    if (errorSpan) errorSpan.textContent = ''; // clear error
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate Size (4MB)
        if (file.size > 4 * 1024 * 1024) {
            if (errorSpan) errorSpan.textContent = 'Error: The image must not be greater than 4 MB.';
            input.value = ''; // clear file
            return;
        }
        
        // Validate Extension
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            if (errorSpan) errorSpan.textContent = 'Error: Only JPG, JPEG, and PNG formats are allowed.';
            input.value = ''; // clear file
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).classList.remove('hidden');
            if (document.getElementById(placeholderId)) {
                document.getElementById(placeholderId).classList.add('hidden');
            }
            if (currentImageId && document.getElementById(currentImageId)) {
                document.getElementById(currentImageId).classList.add('hidden');
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
