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
            <div class="flex items-center mb-8 pb-6 border-b border-gray-100">
                <div class="w-12 h-12 bg-[#FAF6F1] rounded-full flex items-center justify-center text-[#8C7D70] font-bold text-lg border border-[#EADBCC] mr-4 flex-shrink-0">
                    {{ strtoupper(substr($question->user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-[#4A5D4E] font-bold">{{ $question->user->name }}</div>
                    <div class="text-xs text-[#8C7D70]">Asked on {{ $question->created_at->format('M d, Y') }}</div>
                </div>
            </div>
            <div class="prose prose-lg prose-stone max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($question->body)) !!}
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
        
        <div class="space-y-6 mb-12">
            @forelse($question->answers as $answer)
                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-[#EADBCC] flex flex-col sm:flex-row gap-4 md:gap-6 hover:shadow-md transition">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-[#F2ECE4] rounded-full flex items-center justify-center text-[#5E7363] font-bold text-lg border border-[#D5CBBF]">
                            {{ strtoupper(substr($answer->user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex flex-wrap items-center justify-between mb-4 gap-2">
                            <div class="flex items-center flex-wrap gap-2">
                                <span class="font-bold text-[#4A5D4E]">{{ $answer->user->name }}</span>
                                @if($answer->user->role === 'counsellor')
                                    <span class="text-[10px] bg-[#5E7363] text-white px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Counsellor</span>
                                @elseif($answer->user->role === 'admin')
                                    <span class="text-[10px] bg-[#b97a61] text-white px-2 py-0.5 rounded-full uppercase tracking-wider font-bold">Admin</span>
                                @endif
                            </div>
                            <span class="text-xs text-[#8C7D70]">{{ $answer->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="prose prose-stone max-w-none text-gray-700 leading-relaxed mb-4">
                            {!! nl2br(e($answer->body)) !!}
                        </div>
                        @if(Auth::id() === $answer->user_id)
                            <div class="flex items-center space-x-6 border-t border-gray-100 pt-4 mt-2">
                                <a href="#edit-answer-form" class="text-xs text-[#5E7363] hover:text-[#4A5D4E] font-bold uppercase tracking-wider flex items-center">
                                    <i data-lucide="edit-2" class="w-3 h-3 mr-1"></i> Edit
                                </a>
                                <form action="{{ route('forum.destroyAnswer', $answer) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete your answer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-bold uppercase tracking-wider flex items-center">
                                        <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
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
                <div id="edit-answer-form" class="bg-[#F2ECE4] p-8 rounded-3xl border border-[#EADBCC]">
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
                <div class="bg-[#F2ECE4] p-8 rounded-3xl border border-[#EADBCC]">
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
