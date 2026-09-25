@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('counsellor.nav')

    <!-- Add Leave / Exception -->
    <div class="bg-[#E5DCD3] text-[#333] p-6 max-w-xl mx-auto rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h3 class="text-xl font-bold text-[#333] mb-4">Add Leave / Exception</h3>
        <form action="{{ route('counsellor.leaves.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Date</label>
                <input type="date" name="date" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" onkeydown="return false" required>
            </div>
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-1">Reason (Optional)</label>
                <input type="text" name="reason" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]">
            </div>
            <button type="submit" class="w-full py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition">Add Leave</button>
        </form>
        
        @if(count($leaves) > 0)
            <div class="mt-8 border-t border-[#D5CBBF] pt-6">
                <h4 class="font-bold text-[#333] mb-4">Leaves/Exception List</h4>
                <div class="max-h-60 overflow-y-auto pr-2 space-y-2">
                    @foreach($leaves as $leave)
                        <div class="text-sm bg-white p-3 rounded-lg flex justify-between items-center shadow-sm border border-[#D5CBBF]">
                            <span class="font-medium text-[#333]">{{ \Carbon\Carbon::parse($leave->date)->format('M d, Y') }} <span class="text-[#555] font-normal">({{ $leave->reason ?: 'No reason' }})</span></span>
                            <form action="{{ route('counsellor.leaves.destroy', $leave) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exception?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-100 p-1.5 rounded transition" title="Delete">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
