@extends('layouts.public')

@section('content')
<section class="w-full bg-[#FAF6F1] py-16 px-6 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="serif text-4xl font-bold text-[#4A5D4E] mb-2">Community Forum</h1>
                <p class="text-[#8C7D70]">Ask questions, share experiences, and support each other.</p>
            </div>
            @auth
                <button onclick="document.getElementById('askModal').classList.remove('hidden')" class="bg-[#5E7363] text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                    Ask a Question
                </button>
            @else
                <a href="{{ route('login') }}" class="bg-[#5E7363] text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                    Login to Ask
                </a>
            @endauth
        </div>

        <div class="space-y-4">
            @forelse($questions as $question)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#F0E6CD] hover:border-[#A5C3AE] transition">
                    <a href="{{ route('forum.show', $question) }}" class="block">
                        <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-2 group-hover:text-[#5E7363] transition">{{ $question->title }}</h3>
                        <p class="text-[#6B5D53] text-sm mb-4 line-clamp-2">{{ $question->body }}</p>
                        <div class="flex justify-between items-center text-xs text-[#8C7D70] border-t border-[#F3EFE9] pt-4">
                            <span class="flex items-center"><i data-lucide="user" class="w-3 h-3 mr-1"></i> {{ $question->user->name }}</span>
                            <span class="flex items-center space-x-4">
                                <span><i data-lucide="message-square" class="w-3 h-3 inline mr-1"></i> {{ $question->answers_count }} Answers</span>
                                <span><i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i> {{ $question->created_at->diffForHumans() }}</span>
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-[#F0E6CD]">
                    <i data-lucide="messages-square" class="w-12 h-12 text-[#D2B591] mx-auto mb-4 opacity-50"></i>
                    <p class="text-[#8C7D70]">No questions yet. Be the first to ask!</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $questions->links() }}
        </div>
    </div>
</section>

<!-- Ask Question Modal -->
@auth
<div id="askModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-lg w-full relative shadow-xl">
        <button onclick="document.getElementById('askModal').classList.add('hidden')" class="absolute top-6 right-6 text-[#8C7D70] hover:text-[#4A5D4E]">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        <h2 class="serif text-2xl font-bold text-[#4A5D4E] mb-6">Ask a Question</h2>
        <form action="{{ route('forum.storeQuestion') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-[#6B5D53] mb-2">Title</label>
                <input type="text" name="title" required class="w-full p-3 bg-[#FAF6F1] border border-[#EADBCC] rounded-xl focus:outline-none focus:border-[#A5C3AE]" placeholder="What is your question?">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold text-[#6B5D53] mb-2">Details</label>
                <textarea name="body" rows="5" required class="w-full p-3 bg-[#FAF6F1] border border-[#EADBCC] rounded-xl focus:outline-none focus:border-[#A5C3AE]" placeholder="Explain your situation or question in detail..."></textarea>
            </div>
            <button type="submit" class="w-full bg-[#5E7363] text-white px-6 py-3 rounded-xl font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                Post Question
            </button>
        </form>
    </div>
</div>
@endauth
@endsection
