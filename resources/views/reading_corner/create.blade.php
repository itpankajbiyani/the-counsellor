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
                    <option value="blog" {{ request('type', 'blog') == 'blog' ? 'selected' : '' }}>Blog</option>
                    <option value="painting" {{ request('type') == 'painting' ? 'selected' : '' }}>Painting</option>
                    <option value="poetry" {{ request('type') == 'poetry' ? 'selected' : '' }}>Poetry</option>
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
                <div class="flex items-center justify-center w-full">
                    <label for="activity-image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-[#A5C3AE] border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-placeholder">
                            <i data-lucide="upload" class="w-10 h-10 text-[#5E7363] mb-3 opacity-70 group-hover:opacity-100 transition"></i>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-bold text-[#5E7363]">Click to upload</span></p>
                            <p class="text-xs text-gray-500">JPG, PNG (MAX. 4MB)</p>
                        </div>
                        <img id="image-preview" src="#" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover">
                        <input type="file" name="image" id="activity-image" accept=".jpg,.jpeg,.png" class="hidden" onchange="previewImage(this)">
                    </label>
                </div>
            </div>
            
            <div class="mb-8" id="content-field-container">
                <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                <input type="hidden" name="content" id="activity-content">
                <div id="editor-container" class="bg-white rounded-xl min-h-[300px] font-sans text-base"></div>
            </div>
            
            <button type="submit" class="w-full bg-[#5E7363] text-white font-bold py-3.5 rounded-xl hover:bg-[#4A5D4E] transition shadow-sm text-lg">Submit</button>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    #editor-container { min-height: 300px; }
    .ql-editor { min-height: 300px; }
</style>
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

    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        var placeholder = document.getElementById('upload-placeholder');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }
</script>
@endsection
