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
                <a href="{{ route('reading.create', ['type' => $type]) }}" class="bg-[#5E7363] text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Submit {{ ucfirst($type) }}
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-[#5E7363] hover:underline">Login to submit {{ $type }}</a>
            @endauth
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($type === 'blog')
            <div class="mb-8 flex flex-wrap items-center gap-4 bg-[#FAF6F4] p-4 rounded-xl border border-[#EADBCC] shadow-sm">
                <span class="text-[#4A5D4E] font-bold tracking-wide uppercase text-sm">Filter by Category:</span>
                <form action="{{ route('reading.blogs') }}" method="GET" class="flex flex-wrap items-center gap-4 w-full sm:w-auto">
                    <select name="category" class="px-4 py-2 border border-[#D5CBBF] rounded-lg bg-white text-[#4A5D4E] font-bold focus:ring-2 focus:ring-[#5E7363] outline-none shadow-sm cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @isset($categories)
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                    @if(request()->filled('category') || request()->filled('keyword'))
                        <a href="{{ route('reading.blogs') }}" class="text-sm font-bold text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-lg transition shadow-sm border border-red-200 flex items-center">
                            <i data-lucide="x" class="w-4 h-4 mr-1"></i> Reset Filter
                        </a>
                    @endif
                </form>
            </div>
        @endif

        @if($type === 'painting')
            <!-- Grid Layout for Paintings (Like Blogs) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div class="bg-white rounded-3xl shadow-sm border border-[#EADBCC] overflow-hidden group relative cursor-pointer flex flex-col h-full" onclick="openLightbox('{{ asset('images/activities/' . $activity->image) }}', '{{ addslashes($activity->title) }}', '{{ addslashes($activity->user->name ?? 'Community') }}')">
                        <div class="relative w-full h-64 overflow-hidden">
                            <img src="{{ asset('images/activities/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out">
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="bg-white/30 backdrop-blur-md p-3 rounded-full">
                                    <i data-lucide="zoom-in" class="w-6 h-6 text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white relative z-10 border-t border-[#F3EFE9] flex flex-col flex-grow">
                            <h2 class="serif text-xl font-bold text-[#4A5D4E] mb-3">{{ $activity->title }}</h2>
                            <div class="text-[#8C7D70] text-sm mb-4 flex items-center justify-between">
                                <span>By {{ $activity->user->name ?? 'Community' }}</span>
                                <span>{{ $activity->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            @if(Auth::id() === $activity->user_id)
                                <div class="flex justify-end items-center mt-auto pt-4 border-t border-[#F3EFE9]">
                                    <form action="{{ route('reading.destroy', $activity) }}" method="POST" onsubmit="event.stopPropagation(); return confirm('Delete this painting?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-full transition flex-shrink-0"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-[#8C7D70] italic col-span-full">No paintings found.</div>
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
                        <div class="flex justify-between items-center mt-auto pt-4 border-t border-[#F3EFE9]">
                            <a href="{{ route('blog.show', $activity) }}" class="text-[#b97a61] font-bold text-sm hover:underline">Read More →</a>
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
        
        <div class="mt-8">
            {{ $activities->appends(request()->query())->links() }}
        </div>
    </div>



    <!-- Lightbox Modal -->
    <div id="lightbox-modal" class="fixed inset-0 bg-black/95 hidden flex-col items-center justify-center p-4 backdrop-blur-md transition-opacity duration-300" style="z-index: 9999;" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/70 hover:text-white transition bg-white/10 hover:bg-white/20 p-2 rounded-full backdrop-blur-sm z-50">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        <div class="relative max-w-5xl w-full max-h-[85vh] flex items-center justify-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="Painting" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
        </div>
        <div class="mt-6 text-center" onclick="event.stopPropagation()">
            <h3 id="lightbox-title" class="serif text-2xl font-bold text-white mb-2 tracking-wide"></h3>
            <p id="lightbox-author" class="text-white/70 text-sm tracking-widest uppercase"></p>
        </div>
    </div>

</section>
@endsection

@section('scripts')
<script>
    function openLightbox(imageSrc, title, author) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const titleEl = document.getElementById('lightbox-title');
        const authorEl = document.getElementById('lightbox-author');
        
        img.src = imageSrc;
        titleEl.textContent = title;
        authorEl.textContent = 'By ' + author;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('lightbox-img').src = '';
    }
</script>
@endsection
