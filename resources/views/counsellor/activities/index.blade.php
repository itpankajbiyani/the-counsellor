@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('counsellor.nav')

    <div class="bg-[#efefef] text-[#333] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 border-b border-[#D5CBBF] pb-4">
            <h3 class="text-2xl font-bold text-[#333]">Manage {{ ucfirst($type) }}</h3>
        </div>
        
        <!-- Tabs -->
        <div class="flex border-b border-[#D5CBBF] mb-6 flex-wrap">
            <a href="{{ route('counsellor.activities', ['type' => $type, 'status' => 'pending']) }}" class="py-2 px-4 border-b-2 font-bold {{ $status === 'pending' ? 'border-[#5a7b6b] text-[#5a7b6b]' : 'border-transparent text-gray-500 hover:text-[#5a7b6b]' }}">Under Review ({{ $counts['pending'] ?? 0 }})</a>
            <a href="{{ route('counsellor.activities', ['type' => $type, 'status' => 'approved']) }}" class="py-2 px-4 border-b-2 font-bold {{ $status === 'approved' ? 'border-[#5a7b6b] text-[#5a7b6b]' : 'border-transparent text-gray-500 hover:text-[#5a7b6b]' }}">Approved ({{ $counts['approved'] ?? 0 }})</a>
            <a href="{{ route('counsellor.activities', ['type' => $type, 'status' => 'rejected']) }}" class="py-2 px-4 border-b-2 font-bold {{ $status === 'rejected' ? 'border-[#5a7b6b] text-[#5a7b6b]' : 'border-transparent text-gray-500 hover:text-[#5a7b6b]' }}">Rejected ({{ $counts['rejected'] ?? 0 }})</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($activities as $activity)
                <div class="bg-white p-5 rounded-xl border border-[#D5CBBF] flex flex-col relative group">
                    <h4 class="font-bold text-lg mb-2">{{ $activity->title }}</h4>
                    <p class="text-xs text-[#8C7D70] mb-4">By {{ $activity->user->name ?? 'Unknown' }} on {{ $activity->created_at->format('M d, Y') }}</p>
                    
                    @if($type === 'painting' && $activity->image)
                        <img src="{{ asset('images/activities/' . $activity->image) }}" class="w-full h-40 object-cover rounded-lg mb-4">
                    @elseif($activity->content)
                        <div class="text-sm text-[#555] line-clamp-3 mb-4">{!! strip_tags($activity->content) !!}</div>
                    @endif
                    
                    <div class="mt-auto flex space-x-2 pt-4 border-t border-[#F3EFE9]">
                        @if($status === 'pending')
                            <form action="{{ route('counsellor.activities.approve', $activity) }}" method="POST" class="w-1/2">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-[#d7ecd7] hover:bg-[#c2e1c2] text-[#2c522c] rounded-lg text-sm font-bold transition">Approve</button>
                            </form>
                            <form action="{{ route('counsellor.activities.reject', $activity) }}" method="POST" class="w-1/2">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-[#fbe0e0] hover:bg-[#fad0d0] text-[#8a2222] rounded-lg text-sm font-bold transition">Reject</button>
                            </form>
                        @elseif($status === 'approved')
                            <form action="{{ route('counsellor.activities.reject', $activity) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-[#fbe0e0] hover:bg-[#fad0d0] text-[#8a2222] rounded-lg text-sm font-bold transition">Reject</button>
                            </form>
                        @elseif($status === 'rejected')
                            <form action="{{ route('counsellor.activities.approve', $activity) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full py-2 bg-[#d7ecd7] hover:bg-[#c2e1c2] text-[#2c522c] rounded-lg text-sm font-bold transition">Approve</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-[#D5CBBF]">
                    <div class="w-12 h-12 bg-[#FAF6F1] text-[#8C7D70] rounded-full flex items-center justify-center mx-auto mb-3">
                        <i data-lucide="folder-open" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-[#4A5D4E] font-bold">No {{ $type }} found</h4>
                    <p class="text-sm text-[#8C7D70]">There are no items in the "{{ $status }}" list.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
