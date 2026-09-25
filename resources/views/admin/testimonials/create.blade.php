@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto">
    <div class="flex items-center space-x-4 mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="text-[#5a7b6b] hover:underline font-bold">← Back to Testimonials</a>
        <h2 class="text-3xl font-bold text-[#333]">Add New Testimonial</h2>
    </div>

    <div class="bg-[#E5DCD3] p-8 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Student Name</label>
                <input type="text" name="student_name" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Course & Year</label>
                <input type="text" name="course_year" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Testimonial Content</label>
                <input type="hidden" name="content" id="content_input">
                <div id="editor" class="bg-white text-[#333] mb-2" style="min-height: 150px;"></div>
            </div>

            <button type="submit" class="w-full py-3 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow text-lg">Add Testimonial</button>
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
        if (quill.getText().trim().length === 0) {
            alert('Content is required');
            return false;
        }
        content.value = quill.root.innerHTML;
    };
</script>
@endsection
