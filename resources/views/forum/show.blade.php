@extends('layouts.public')

@section('content')
<section class="w-full bg-[#FAF6F1] py-16 px-6 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('forum.index') }}" class="text-sm font-bold text-[#8C7D70] uppercase flex items-center mb-8 hover:text-[#4A5D4E] transition">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Back to Forum
        </a>

        <!-- Original Question -->
        <div class="bg-white p-8 md:p-10 rounded-3xl shadow-md border-t-4 border-t-[#5E7363] mb-12">
            <h1 class="serif text-3xl font-bold text-[#2d3a37] mb-6">{{ $question->title }}</h1>
            <div class="mb-8 pb-6 border-b border-gray-100">
                <div>
                    <div class="text-[#4A5D4E] font-bold">{{ $question->user->name }}</div>
                    <div class="text-xs text-[#8C7D70]">Asked on {{ $question->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        @php
            $userAnswer = null;
            if (Auth::check()) {
                $userAnswer = $question->answers->where('user_id', Auth::id())->first();
            }
        @endphp

        <!-- Answers Section -->
        <h2 class="serif text-2xl font-bold text-[#2d3a37] mb-8">{{ $question->answers->count() }} {{ Str::plural('Answer', $question->answers->count()) }}</h2>
        
        <div class="mb-12 ml-6 md:ml-12">
            <div class="space-y-4">
                @forelse($question->answers as $answer)
                    <div class="flex gap-4 border-l-4 border-[#D5CBBF] pl-4 md:pl-6 p-4 rounded-r-xl {{ $loop->even ? 'bg-white shadow-sm' : 'bg-[#E2D6C5] shadow-sm' }}">
                        
                        <!-- Comment Content -->
                        <div class="flex-grow">
                            <div class="text-[15px] text-[#333] leading-relaxed mb-3 prose prose-sm max-w-none">
                                {!! nl2br(e($answer->body)) !!}
                            </div>
                            
                            <div class="flex items-center flex-wrap gap-4">
                                <div class="flex items-center flex-wrap gap-2">
                                    <span class="font-bold text-[13px] text-[#2d3a37]">{{ $answer->user->name }}</span>
                                    @if($answer->user->role === 'counsellor')
                                        <span class="text-[9px] bg-[#5E7363] text-white px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Counsellor</span>
                                    @elseif($answer->user->role === 'admin')
                                        <span class="text-[9px] bg-[#b97a61] text-white px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Admin</span>
                                    @endif
                                    <span class="text-[12px] text-[#8C7D70]">{{ $answer->created_at->diffForHumans() }}</span>
                                </div>
                                
                                @if(Auth::id() === $answer->user_id)
                                    <div class="flex items-center space-x-2 border-l border-[#D5CBBF] pl-4">
                                        <a href="#edit-answer-form" class="text-xs text-[#8C7D70] hover:text-[#4A5D4E] font-bold flex items-center transition">
                                            <i data-lucide="edit-2" class="w-3 h-3 mr-1"></i> Edit
                                        </a>
                                        <form action="{{ route('forum.destroyAnswer', $answer) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete your answer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-[#8C7D70] hover:text-red-700 font-bold flex items-center transition">
                                                <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
            @empty
                <div class="text-center py-12 bg-white rounded-3xl border border-dashed border-[#D5CBBF]">
                    <div class="w-16 h-16 bg-[#FAF6F1] text-[#8C7D70] rounded-full flex items-center justify-center mx-auto mb-4 border border-[#EADBCC]">
                        <i data-lucide="message-square" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#4A5D4E] mb-2">No answers yet</h3>
                    <p class="text-[#6B5D53]">Be the first to share your perspective and help out!</p>
                </div>
            @endforelse
        </div>

        <!-- Post Answer Form -->
        @auth
            @if($userAnswer)
                <div id="edit-answer-form" class="mt-12 bg-[#F2ECE4] p-8 rounded-3xl border border-[#EADBCC]">
                    <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-4">Edit Your Answer</h3>
                    @error('error')
                        <div class="mb-4 text-red-600 font-bold">{{ $message }}</div>
                    @enderror
                    <form action="{{ route('forum.updateAnswer', $userAnswer) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea name="body" rows="4" required class="w-full p-4 bg-white border border-[#EADBCC] rounded-xl focus:outline-none focus:border-[#A5C3AE] mb-4" placeholder="Update your answer here...">{{ $userAnswer->body }}</textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-[#5E7363] text-white px-8 py-3 rounded-full font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                                Update Answer
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="mt-12 bg-[#F2ECE4] p-8 rounded-3xl border border-[#EADBCC]">
                    <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-4">Post Your Answer</h3>
                    @error('error')
                        <div class="mb-4 text-red-600 font-bold">{{ $message }}</div>
                    @enderror
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
            @endif
        @else
            <div class="mt-12 bg-white p-8 rounded-3xl border border-[#EADBCC] text-center">
                <p class="text-[#6B5D53] mb-4">You must be logged in to post an answer.</p>
                <a href="{{ route('login') }}" class="inline-block bg-[#5E7363] text-white px-8 py-3 rounded-full font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                    Login Now
                </a>
            </div>
        @endauth
    </div>
</section>
@endsection
