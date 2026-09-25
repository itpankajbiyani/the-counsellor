@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl bg-[#E5DCD3] text-[#333] p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
    
    <div class="flex justify-between items-center mb-8 border-b border-[#C5BBAF] pb-4">
        <h2 class="text-3xl font-bold text-[#333]">My Appointments</h2>
        <a href="{{ route('home') }}#counsellors" class="px-4 py-2 bg-[#5a7b6b] hover:bg-[#4a6758] text-white rounded-lg shadow font-bold transition">
            {{ $bookings->isEmpty() ? 'Book A Session' : 'Book Another Session' }}
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                    <th class="p-4">Date & Time</th>
                    <th class="p-4">Counsellor</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-b border-[#C5BBAF] hover:bg-[#F2EAE1] transition">
                        <td class="p-4 whitespace-nowrap">
                            <span class="font-bold text-[#333]">{{ \Carbon\Carbon::parse($booking->date)->format('l, F j, Y') }}</span><br>
                            <span class="text-[#555]">{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</span>
                        </td>
                        <td class="p-4 font-medium text-[#4a3b32]">
                            {{ $booking->counsellor->name ?? 'N/A' }}
                        </td>
                        <td class="p-4">
                            @if($booking->status === 'pending')
                                <div class="flex flex-col space-y-2">
                                    <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm font-bold shadow-sm w-max">Pending</span>
                                    <form action="{{ route('user.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" class="flex flex-col space-y-1 mt-1">
                                        @csrf
                                        <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1.5 text-xs bg-white border border-[#D5CBBF] rounded focus:outline-none text-[#333]" required>
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold underline text-left mt-1">Cancel</button>
                                    </form>
                                </div>
                            @elseif($booking->status === 'accepted')
                                <div class="flex flex-col space-y-2">
                                    <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm font-bold shadow-sm w-max">Accepted</span>
                                    <form action="{{ route('user.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" class="flex flex-col space-y-1 mt-1">
                                        @csrf
                                        <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1.5 text-xs bg-white border border-[#D5CBBF] rounded focus:outline-none text-[#333]" required>
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold underline text-left mt-1">Cancel</button>
                                    </form>
                                </div>
                            @else
                                <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-sm font-bold shadow-sm">Cancelled</span>
                                @if($booking->cancellation_reason)
                                    <p class="text-xs mt-2 text-[#555]">Reason: {{ $booking->cancellation_reason }}</p>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-[#555] font-medium">You have no upcoming or past appointments.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
