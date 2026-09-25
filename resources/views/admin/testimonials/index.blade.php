@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-[#333]">Manage Testimonials</h3>
        <a href="{{ route('admin.testimonials.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New Testimonial</a>
    </div>

    <div class="w-full">
        <div class="space-y-4">
                @forelse($testimonials as $testimonial)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div>
                            <div>
                                <div class="font-bold text-[#333] text-lg">{{ $testimonial->student_name }}</div>
                                <div class="text-sm text-[#555]">{{ $testimonial->course_year }}</div>
                                <div class="text-sm text-[#444] italic mt-1 max-w-md truncate">"{{ $testimonial->content }}"</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="px-3 py-1 bg-[#5a7b6b] text-white text-sm font-bold rounded hover:bg-[#4a6758]">Edit</a>
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
@endsection
