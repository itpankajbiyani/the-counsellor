@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-[#efefef] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 border-b border-[#D5CBBF] pb-4">
            <h3 class="text-2xl font-bold text-[#333]">Manage Forum Questions</h3>
        </div>
        
        <div class="space-y-6">
            @forelse($questions as $question)
                <div class="bg-white p-6 rounded-xl border border-[#D5CBBF] shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-xl font-bold text-[#333] mb-2">{{ $question->title }}</h4>
                            <p class="text-sm text-[#555] mb-2">{{ $question->content }}</p>
                            <div class="text-xs text-[#8C7D70] font-medium">
                                Asked by <span class="font-bold">{{ $question->user->name ?? 'Unknown' }}</span> on {{ $question->created_at->format('M d, Y h:i A') }}
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2 ml-4">
                            <form action="{{ route('admin.forum.destroyQuestion', $question) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question? This will also delete all of its answers.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-1 bg-red-100 border border-red-200 text-red-700 text-xs font-bold rounded hover:bg-red-200 transition text-center">Delete Question</button>
                            </form>
                            <a href="{{ route('forum.show', $question) }}" target="_blank" class="w-full px-3 py-1 bg-[#FAF6F4] border border-[#D5CBBF] text-[#5a7b6b] text-xs font-bold rounded hover:bg-[#efefef] transition text-center">View Public</a>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-[#F3EFE9]">
                        <h5 class="text-sm font-bold text-[#4A5D4E] mb-3">Answers ({{ $question->answers->count() }})</h5>
                        
                        @if($question->answers->count() > 0)
                            <div class="space-y-3">
                                @foreach($question->answers as $answer)
                                    <div class="bg-[#FAF6F4] p-4 rounded-lg border border-[#EADBCC]">
                                        <div class="flex justify-between items-start">
                                            <p class="text-sm text-[#444] mb-2 w-5/6">{{ $answer->content }}</p>
                                            <form action="{{ route('admin.forum.destroyAnswer', $answer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this answer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-bold underline">Delete</button>
                                            </form>
                                        </div>
                                        <div class="text-xs text-[#8C7D70] flex justify-between">
                                            <span>
                                                Answered by <span class="font-bold">{{ $answer->user->name ?? 'Unknown' }}</span> 
                                                @if(isset($answer->user) && $answer->user->role === 'counsellor')
                                                    <span class="bg-[#5a7b6b] text-white px-1.5 py-0.5 rounded text-[10px] ml-1 uppercase">Counsellor</span>
                                                @endif
                                            </span>
                                            <span>{{ $answer->created_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-sm text-gray-500 italic">No answers yet.</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl border border-dashed border-[#D5CBBF]">
                    <div class="w-12 h-12 bg-[#FAF6F1] text-[#8C7D70] rounded-full flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-[#4A5D4E] font-bold">No questions found</h4>
                    <p class="text-sm text-[#8C7D70]">There are no forum questions available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
