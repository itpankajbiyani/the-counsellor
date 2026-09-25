@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('counsellor.nav')

    <!-- Main: Bookings -->
    <div class="bg-[#E5DCD3] text-[#333] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h3 class="text-2xl font-bold text-[#333] mb-6">Your Bookings</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                        <th class="p-3">Date & Time</th>
                        <th class="p-3">Patient</th>
                        <th class="p-3">Status / Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-[#C5BBAF] hover:bg-[#F2EAE1] transition">
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
                            <td class="p-3">
                                @if($booking->status === 'pending')
                                    <div class="flex flex-col space-y-2">
                                        <form action="{{ route('counsellor.bookings.accept', $booking) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded w-full">Accept</button>
                                        </form>
                                        <form action="{{ route('counsellor.bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel?');">
                                            @csrf
                                            <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1 mb-1 text-sm border rounded" required>
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded w-full">Cancel</button>
                                        </form>
                                    </div>
                                @elseif($booking->status === 'accepted')
                                    <div class="flex flex-col space-y-2">
                                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded font-bold uppercase text-center w-full block">Accepted</span>
                                        <form action="{{ route('counsellor.bookings.complete', $booking) }}" method="POST" onsubmit="return confirm('Mark this session as completed?');">
                                            @csrf
                                            <button type="submit" class="bg-[#5a7b6b] hover:bg-[#4a6758] text-white font-bold py-1 px-3 rounded w-full">Complete</button>
                                        </form>
                                        <form action="{{ route('counsellor.bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this accepted booking?');">
                                            @csrf
                                            <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1 mb-1 text-sm border rounded bg-white text-[#333]" required>
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded w-full">Cancel</button>
                                        </form>
                                    </div>
                                @elseif($booking->status === 'completed')
                                    <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded font-bold uppercase block text-center">Completed</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded font-bold uppercase block text-center">Cancelled</span>
                                    @if($booking->cancellation_reason)
                                        <p class="text-xs mt-1 text-[#555]">"{{ $booking->cancellation_reason }}"</p>
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
