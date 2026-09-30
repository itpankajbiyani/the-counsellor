@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="w-full max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
        <div class="flex items-center mb-8 border-b border-[#C5BBAF] pb-4">
            <a href="{{ route('admin.testimonials.index') }}" class="mr-4 text-[#8C7D70] hover:text-[#5E7363] transition">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-[#333]">Edit Testimonial</h2>
            </div>
        </div>
        <form id="testimonial-form" action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Student Name</label>
                <input type="text" name="student_name" value="{{ $testimonial->student_name }}" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Course & Year</label>
                <input type="text" name="course_year" value="{{ $testimonial->course_year }}" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Testimonial Content</label>
                <input type="hidden" name="content" id="content_input">
                <div id="editor" class="bg-white text-[#333] mb-2" style="min-height: 150px;">{!! $testimonial->content !!}</div>
            </div>

            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2.5 bg-gray-200 text-[#333] font-bold rounded-xl hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-[#5E7363] text-white font-bold rounded-xl hover:bg-[#4A5D4E] transition shadow">Update Testimonial</button>
            </div>
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
    var form = document.getElementById('testimonial-form');
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
