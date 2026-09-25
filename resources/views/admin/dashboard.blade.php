@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-[#333]">All Platform Bookings</h3>
            
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center space-x-2 mt-4 md:mt-0">
                <select name="counsellor_id" class="p-2 border border-[#D5CBBF] rounded bg-[#FAF6F4] text-[#333]">
                    <option value="">All Counsellors</option>
                    @foreach($counsellors as $counsellor)
                        <option value="{{ $counsellor->id }}" {{ request('counsellor_id') == $counsellor->id ? 'selected' : '' }}>
                            {{ $counsellor->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-[#5a7b6b] text-white px-4 py-2 rounded font-bold hover:bg-[#4a6758]">Filter</button>
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                        <th class="p-3">Date & Time</th>
                        <th class="p-3">Patient</th>
                        <th class="p-3">Counsellor</th>
                        <th class="p-3">Status</th>
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
                            <td class="p-3 font-medium text-[#333]">{{ $booking->counsellor->name ?? 'N/A' }}</td>
                            <td class="p-3">
                                @if($booking->status === 'pending')
                                    <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded font-bold uppercase text-xs">Pending</span>
                                @elseif($booking->status === 'accepted')
                                    <span class="px-2 py-1 bg-green-200 text-green-800 rounded font-bold uppercase text-xs">Accepted</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded font-bold uppercase text-xs">Cancelled</span>
                                    @if($booking->cancellation_reason)
                                        <p class="text-xs mt-1 text-[#555]">"{{ $booking->cancellation_reason }}"</p>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-[#555]">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
