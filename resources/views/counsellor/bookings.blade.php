@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('counsellor.nav')

    <!-- Main: Bookings -->
    <div class="bg-[#efefef] text-[#333] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-[#333]">Your Bookings</h3>
            
            <form action="{{ route('counsellor.bookings') }}" method="GET" class="flex items-center space-x-2 mt-4 md:mt-0">
                <input type="date" name="date" value="{{ request('date') }}" class="p-2 border border-[#D5CBBF] rounded bg-[#FAF6F4] text-[#333]">
                <select name="status" class="p-2 border border-[#D5CBBF] rounded bg-[#FAF6F4] text-[#333]">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-[#5a7b6b] text-white px-4 py-2 rounded font-bold hover:bg-[#4a6758]">Filter</button>
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                        <th class="p-3">Date & Time</th>
                        <th class="p-3 w-2/4">Patient</th>
                        <th class="p-3 text-right">Status / Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-[#C5BBAF] even:bg-[#FAF6F4] hover:bg-[#F2EAE1] transition">
                            <td class="p-3 whitespace-nowrap">
                                <strong class="text-[#333]">{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</strong><br>
                                <span class="text-[#555]">{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</span>
                            </td>
                            <td class="p-3 text-[#333]">
                                <div class="font-bold">{{ $booking->user->name ?? 'N/A' }}</div>
                                <span class="text-sm text-[#555]">{{ $booking->user->phone ?? '' }}</span>
                                @if($booking->message)
                                    <div class="mt-2 text-sm text-[#555]">
                                        <strong class="text-xs uppercase text-[#5a7b6b]">Message:</strong><br>
                                        {{ $booking->message }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                @if($booking->status === 'pending')
                                    <div class="flex flex-col space-y-2 items-end">
                                        <form action="{{ route('counsellor.bookings.accept', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to accept this booking?');">
                                            @csrf
                                            <button type="submit" class="bg-[#5E7363] hover:bg-[#4A5D4E] text-white font-bold text-xs py-1.5 px-4 rounded-full transition shadow-sm">Accept</button>
                                        </form>
                                        <form action="{{ route('counsellor.bookings.cancel', $booking) }}" method="POST" class="flex flex-col items-end" onsubmit="if(!confirm('Are you sure you want to cancel this booking?')) return false; const reason = prompt('Cancel booking for {{ addslashes($booking->user->name ?? 'Unknown') }} on {{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}?\n\nPlease enter a reason:'); if(reason === null || reason.trim() === '') { return false; } this.cancellation_reason.value = reason; return true;">
                                            @csrf
                                            <input type="hidden" name="cancellation_reason" value="">
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 font-bold text-xs py-1.5 px-4 rounded-full transition shadow-sm">Cancel</button>
                                        </form>
                                    </div>
                                @elseif($booking->status === 'accepted')
                                    <div class="flex flex-col space-y-2 items-end">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Accepted</span>
                                        <form action="{{ route('counsellor.bookings.complete', $booking) }}" method="POST" onsubmit="return confirm('Mark this session as completed?');">
                                            @csrf
                                            <button type="submit" class="bg-[#5E7363] hover:bg-[#4A5D4E] text-white font-bold text-xs py-1.5 px-4 rounded-full transition shadow-sm">Complete</button>
                                        </form>
                                        <form action="{{ route('counsellor.bookings.cancel', $booking) }}" method="POST" class="flex flex-col items-end" onsubmit="if(!confirm('Are you sure you want to cancel this accepted booking?')) return false; const reason = prompt('Cancel ACCEPTED booking for {{ addslashes($booking->user->name ?? 'Unknown') }} on {{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}?\n\nPlease enter a reason:'); if(reason === null || reason.trim() === '') { return false; } this.cancellation_reason.value = reason; return true;">
                                            @csrf
                                            <input type="hidden" name="cancellation_reason" value="">
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 font-bold text-xs py-1.5 px-4 rounded-full transition shadow-sm">Cancel</button>
                                        </form>
                                    </div>
                                @elseif($booking->status === 'completed')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded inline-block">Completed</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded inline-block">Cancelled</span>
                                    @if($booking->cancelled_by)
                                        <p class="text-[9px] font-bold text-red-500 uppercase text-right mt-1.5">By: {{ $booking->cancelled_by }}</p>
                                    @endif
                                    @if($booking->cancellation_reason)
                                        <p class="text-[11px] mt-1 text-[#8C7D70] text-right italic">"{{ $booking->cancellation_reason }}"</p>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-[#555]">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
