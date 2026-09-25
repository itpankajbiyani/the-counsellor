@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Add Testimonial Form -->
        <div class="w-full md:w-1/3">
            <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
                <h3 class="text-xl font-bold text-[#333] mb-4">Add Testimonial</h3>
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
                        <textarea name="content" rows="4" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-[#333] font-bold mb-1">Student Avatar (Optional)</label>
                        <input type="file" name="image" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    <button type="submit" class="w-full py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow">Add Testimonial</button>
                </form>
            </div>
        </div>

        <!-- Testimonials List -->
        <div class="w-full md:w-2/3">
            <h3 class="text-2xl font-bold text-[#333] mb-6">Manage Testimonials</h3>
            <div class="space-y-4">
                @forelse($testimonials as $testimonial)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($testimonial->image)
                                <img src="{{ asset('images/testimonials/' . $testimonial->image) }}" class="w-12 h-12 object-cover rounded-full shadow-sm border border-[#D5CBBF]">
                            @else
                                <div class="w-12 h-12 flex items-center justify-center bg-[#E5DCD3] rounded-full text-[#5a7b6b] border border-[#D5CBBF]">
                                    <i data-lucide="user" class="w-6 h-6"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-[#333] text-lg">{{ $testimonial->student_name }}</div>
                                <div class="text-sm text-[#555]">{{ $testimonial->course_year }}</div>
                                <div class="text-sm text-[#444] italic mt-1 max-w-md truncate">"{{ $testimonial->content }}"</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-[#555] bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg">No testimonials added yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
