@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="w-full relative overflow-hidden bg-[#fdfcf9] pt-16 pb-16 border-b border-gray-100">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-40">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#89a89d] rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>
        <div class="absolute bottom-0 -left-10 w-32 h-32 bg-[#f5b8a0] rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
        @if($blog->category)
            <h4 class="text-xs font-bold tracking-[0.2em] text-[#b97a61] uppercase mb-4">{{ $blog->category }}</h4>
        @endif
        <h1 class="serif text-4xl md:text-5xl font-bold text-[#2d3a37] mb-6 leading-tight">{{ $blog->title }}</h1>
        <div class="text-sm text-gray-500 font-medium">Published on {{ $blog->created_at->format('M d, Y') }}</div>
    </div>
</section>

<!-- Content Section -->
<section class="w-full bg-white py-16 px-6 flex-grow">
    <div class="max-w-3xl mx-auto">
        @if($blog->image)
            <div class="mb-12 rounded-3xl overflow-hidden shadow-sm border border-gray-100 h-96 relative">
                <img src="{{ asset('images/blogs/' . $blog->image) }}" class="w-full h-full object-cover">
            </div>
        @endif
        
        <div class="prose prose-lg prose-stone max-w-none text-gray-700 leading-relaxed">
            @if($blog->content)
                {!! nl2br(e($blog->content)) !!}
            @else
                <p class="italic text-gray-500 text-center py-8">This blog is currently empty or available via an external link.</p>
            @endif
        </div>
        
        @if($blog->link)
            <div class="mt-12 text-center">
                <a href="{{ $blog->link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center bg-[#f4f7f5] text-[#5a7b6b] border border-[#e1eae6] px-8 py-3 rounded-full font-bold hover:bg-[#e1eae6] transition">
                    Read original article <i data-lucide="external-link" class="w-4 h-4 ml-2"></i>
                </a>
            </div>
        @endif
        
        <div class="mt-16 border-t border-gray-100 pt-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-[#b97a61] font-bold text-sm uppercase tracking-wider flex items-center hover:text-[#9c634d] transition">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Back to Home
            </a>
            
            <div class="flex items-center space-x-3 text-gray-400">
                <span class="text-sm font-medium">Share:</span>
                <i data-lucide="twitter" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="facebook" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="linkedin" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
            </div>
        </div>
    </div>
</section>
@endsection
