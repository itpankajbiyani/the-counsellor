@extends('layouts.public')

@section('content')
<section class="w-full bg-[#FAF6F1] py-16 px-6 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white rounded-3xl p-8 shadow-sm border border-[#EADBCC]">
        <div class="flex justify-between items-center mb-6">
            <h1 class="serif text-3xl font-bold text-[#4A5D4E]">Submit Activity</h1>
            <a href="javascript:history.back()" class="text-gray-500 hover:text-gray-800">
                <i data-lucide="x" class="w-6 h-6"></i>
            </a>
        </div>
        
        <form action="{{ route('reading.store') }}" method="POST" enctype="multipart/form-data" id="activity-form">
            @csrf
            
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-bold mb-2">What do you want to share?</label>
                <select name="type" id="activity-type" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE]" onchange="toggleActivityFields()">
                    <option value="blog">Blog</option>
                    <option value="painting">Painting</option>
                    <option value="poetry">Poetry</option>
                </select>
            </div>
            
            <div class="mb-5" id="category-field-container">
                <label class="block text-gray-700 text-sm font-bold mb-2">Category (for blogs)</label>
                <select name="category" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
            </div>
            
            <div class="mb-5" id="image-field-container" style="display: none;">
                <label class="block text-gray-700 text-sm font-bold mb-2">Upload Image (JPG/PNG, Max 4MB)</label>
                <input type="file" name="image" id="activity-image" accept=".jpg,.jpeg,.png" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl">
            </div>
            
            <div class="mb-8" id="content-field-container">
                <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                <input type="hidden" name="content" id="activity-content">
                <div id="editor-container" class="bg-white rounded-xl h-64 font-sans text-base"></div>
            </div>
            
            <button type="submit" class="w-full bg-[#5E7363] text-white font-bold py-3.5 rounded-xl hover:bg-[#4A5D4E] transition shadow-sm text-lg">Submit</button>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill;
    document.addEventListener('DOMContentLoaded', function() {
        quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your content here...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['clean']
                ]
            }
        });

        document.getElementById('activity-form').onsubmit = function() {
            var html = quill.root.innerHTML;
            if(html === '<p><br></p>') html = '';
            document.getElementById('activity-content').value = html;
        };
        
        toggleActivityFields();
    });

    function toggleActivityFields() {
        var type = document.getElementById('activity-type').value;
        var categoryContainer = document.getElementById('category-field-container');
        var imageContainer = document.getElementById('image-field-container');
        var imageInput = document.getElementById('activity-image');
        
        if (type === 'blog') {
            categoryContainer.style.display = 'block';
            imageContainer.style.display = 'block';
            imageInput.required = true;
        } else if (type === 'painting') {
            categoryContainer.style.display = 'none';
            imageContainer.style.display = 'block';
            imageInput.required = true;
        } else if (type === 'poetry') {
            categoryContainer.style.display = 'none';
            imageContainer.style.display = 'none';
            imageInput.required = false;
        }
    }
</script>
@endsection
