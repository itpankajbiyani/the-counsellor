@extends('layouts.public')

@section('content')
<section class="w-full bg-[#FAF6F1] py-16 px-6 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-end mb-12 border-b border-[#EADBCC] pb-6">
            <div>
                <h1 class="serif text-4xl font-bold text-[#4A5D4E] mb-2">{{ ucfirst(Str::plural($type)) }}</h1>
                <p class="text-[#6B5D53]">Explore creative {{ Str::plural($type) }} shared by our community.</p>
            </div>
            
            @auth
                <button onclick="document.getElementById('submit-modal').classList.remove('hidden')" class="bg-[#5E7363] text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Submit {{ ucfirst($type) }}
                </button>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-[#5E7363] hover:underline">Login to submit {{ $type }}</a>
            @endauth
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($type === 'painting')
            <!-- Masonry Layout for Paintings -->
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
                @forelse($activities as $activity)
                    <div class="break-inside-avoid bg-white rounded-2xl shadow-sm border border-[#EADBCC] overflow-hidden group">
                        <img src="{{ asset('images/activities/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-auto object-cover group-hover:scale-105 transition duration-500">
                        <div class="p-4 bg-white">
                            <h3 class="font-bold text-[#4A5D4E]">{{ $activity->title }}</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs text-[#8C7D70]">By {{ $activity->user->name ?? 'Community' }}</span>
                                @if(Auth::id() === $activity->user_id)
                                    <form action="{{ route('reading.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this painting?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-[#8C7D70] italic">No paintings found.</div>
                @endforelse
            </div>
        @else
            <!-- Grid Layout for Blogs & Poetry -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#EADBCC] flex flex-col h-full">
                        <h2 class="serif text-xl font-bold text-[#4A5D4E] mb-3">{{ $activity->title }}</h2>
                        <div class="text-[#8C7D70] text-sm mb-4 flex items-center justify-between border-b border-[#F3EFE9] pb-4">
                            <span>By {{ $activity->user->name ?? 'Community' }}</span>
                            <span>{{ $activity->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="prose prose-stone text-sm text-[#6B5D53] line-clamp-4 flex-grow mb-4">
                            {!! strip_tags($activity->content) !!}
                        </div>
                        <div class="flex justify-between items-center mt-auto pt-4">
                            <a href="#" class="text-[#b97a61] font-bold text-sm hover:underline">Read More →</a>
                            @if(Auth::id() === $activity->user_id)
                                <form action="{{ route('reading.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-[#8C7D70] italic col-span-full">No {{ Str::plural($type) }} found.</div>
                @endforelse
            </div>
        @endif
    </div>

    <!-- Submit Modal -->
    @auth
    <div id="submit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-8 max-w-lg w-full shadow-2xl relative">
            <button onclick="document.getElementById('submit-modal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            
            <h3 class="serif text-2xl font-bold text-[#4A5D4E] mb-6">Submit {{ ucfirst($type) }}</h3>
            
            <form action="{{ route('reading.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
                </div>
                
                @if($type === 'painting')
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Upload Image (JPG/PNG, Max 4MB)</label>
                        <input type="file" name="image" accept=".jpg,.jpeg,.png" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl">
                    </div>
                @else
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                        <textarea name="content" rows="6" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE]"></textarea>
                    </div>
                @endif
                
                <button type="submit" class="w-full bg-[#5E7363] text-white font-bold py-3 rounded-xl hover:bg-[#4A5D4E] transition shadow">Submit for Approval</button>
            </form>
        </div>
    </div>
    @endauth
</section>
@endsection
