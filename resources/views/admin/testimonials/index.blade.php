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
                                <div class="font-bold text-[#333] text-lg">
                                    {{ $testimonial->student_name }}
                                    @if($testimonial->is_active)
                                        <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full uppercase">Active</span>
                                    @else
                                        <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full uppercase">Inactive</span>
                                    @endif
                                </div>
                                <div class="text-sm text-[#555]">{{ $testimonial->course_year }}</div>
                                <div class="text-sm text-[#444] italic mt-1 max-w-md truncate">"{!! Str::limit(strip_tags($testimonial->content), 100) !!}"</div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                            <form action="{{ route('admin.testimonials.toggle', $testimonial) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 w-24 text-center {{ $testimonial->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold rounded">
                                    {{ $testimonial->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
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
