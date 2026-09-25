@extends('layouts.public')

@section('content')
<section class="w-full bg-[#FAF6F1] py-16 px-6 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('forum.index') }}" class="text-sm font-bold text-[#8C7D70] uppercase flex items-center mb-8 hover:text-[#4A5D4E] transition">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Back to Forum
        </a>

        <!-- Original Question -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#F0E6CD] mb-8">
            <h1 class="serif text-3xl font-bold text-[#4A5D4E] mb-4">{{ $question->title }}</h1>
            <div class="flex items-center text-xs text-[#8C7D70] mb-6 pb-6 border-b border-[#F3EFE9] space-x-4">
                <span class="flex items-center"><i data-lucide="user" class="w-4 h-4 mr-1"></i> Asked by {{ $question->user->name }}</span>
                <span class="flex items-center"><i data-lucide="calendar" class="w-4 h-4 mr-1"></i> {{ $question->created_at->format('M d, Y') }}</span>
            </div>
            <div class="prose prose-stone max-w-none text-[#6B5D53] leading-relaxed">
                {!! nl2br(e($question->body)) !!}
            </div>
        </div>

        <!-- Answers Section -->
        <h2 class="serif text-2xl font-bold text-[#4A5D4E] mb-6">{{ $question->answers->count() }} {{ Str::plural('Answer', $question->answers->count()) }}</h2>
        
        <div class="space-y-6 mb-12">
            @forelse($question->answers as $answer)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#EADBCC]">
                    <div class="prose prose-stone max-w-none text-[#6B5D53] leading-relaxed mb-4">
                        {!! nl2br(e($answer->body)) !!}
                    </div>
                    <div class="flex items-center justify-between text-xs text-[#8C7D70] border-t border-[#F3EFE9] pt-4">
                        <span class="flex items-center font-medium"><i data-lucide="user" class="w-3 h-3 mr-1"></i> {{ $answer->user->name }}</span>
                        <span>{{ $answer->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="text-[#8C7D70] italic p-6 bg-[#F3EFE9] rounded-2xl text-center">No answers yet. Be the first to help!</div>
            @endforelse
        </div>

        <!-- Post Answer Form -->
        @auth
            <div class="bg-[#F2ECE4] p-8 rounded-3xl border border-[#EADBCC]">
                <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-4">Post Your Answer</h3>
                <form action="{{ route('forum.storeAnswer', $question) }}" method="POST">
                    @csrf
                    <textarea name="body" rows="4" required class="w-full p-4 bg-white border border-[#EADBCC] rounded-xl focus:outline-none focus:border-[#A5C3AE] mb-4" placeholder="Write your answer here..."></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#5E7363] text-white px-8 py-3 rounded-full font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                            Submit Answer
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white p-8 rounded-3xl border border-[#EADBCC] text-center">
                <p class="text-[#6B5D53] mb-4">You must be logged in to post an answer.</p>
                <a href="{{ route('login') }}" class="inline-block bg-[#5E7363] text-white px-8 py-3 rounded-full font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                    Login Now
                </a>
            </div>
        @endauth
    </div>
</section>
@endsection
