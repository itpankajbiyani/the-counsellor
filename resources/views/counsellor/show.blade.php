@extends('layouts.app')

@section('content')
<div class="max-w-4xl w-full mt-8 mb-16 relative">
    
    <div class="bg-[#E5DCD3] p-8 mb-8 text-center rounded-2xl shadow-lg border border-[#D5CBBF]">
        @if($user->image)
            <img src="{{ asset('images/counsellors/' . $user->image) }}" class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-4 border-white shadow-md">
        @endif
        <h1 class="text-4xl font-bold text-[#333] mb-2">{{ $user->name }}</h1>
        @if($user->about)
            <p class="text-md text-[#444] max-w-2xl mx-auto mb-6 bg-[#FAF6F4] p-4 rounded-lg border border-[#D5CBBF]">{{ $user->about }}</p>
        @endif
        <p class="text-lg text-[#555] font-medium">Select an available 50-minute session below.</p>
    </div>

    @if(count($slots) > 0)
        <div class="space-y-6">
            @foreach($slots as $date => $daySlots)
                <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
                    <h3 class="text-2xl font-bold text-[#333] mb-4">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($daySlots as $slot)
                            @if(isset($slot['booked']) && $slot['booked'])
                                <button type="button" disabled class="w-full py-2 px-1 text-sm font-bold text-gray-400 bg-gray-200 border border-gray-300 rounded-lg shadow-sm cursor-not-allowed">
                                    {{ \Carbon\Carbon::parse($slot['start'])->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot['end'])->format('g:i A') }}
                                </button>
                            @elseif(Auth::check() && in_array(Auth::user()->role, ['admin', 'counsellor']))
                                <button type="button" disabled title="Only users can book sessions" class="w-full py-2 px-1 text-sm font-bold text-gray-500 bg-gray-100 border border-gray-300 rounded-lg shadow-sm cursor-not-allowed">
                                    {{ \Carbon\Carbon::parse($slot['start'])->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot['end'])->format('g:i A') }}
                                </button>
                            @else
                                <button type="button" onclick="openModal('{{ $date }}', '{{ $slot['start'] }}', '{{ $slot['end'] }}', '{{ \Carbon\Carbon::parse($date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($slot['start'])->format('g:i A') }}')" class="w-full py-2 px-1 text-sm font-bold text-[#333] bg-[#FAF6F4] hover:bg-[#5a7b6b] hover:text-white border border-[#D5CBBF] rounded-lg shadow transition">
                                    {{ \Carbon\Carbon::parse($slot['start'])->format('g:i A') }} - {{ \Carbon\Carbon::parse($slot['end'])->format('g:i A') }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-[#E5DCD3] p-12 text-center rounded-2xl shadow-lg border border-[#D5CBBF]">
            <h3 class="text-xl text-[#333] font-medium">No available slots in the next 14 days.</h3>
        </div>
    @endif

</div>

<!-- Booking Modal -->
<div id="booking-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-[#FAF6F4] p-8 rounded-2xl shadow-2xl border border-[#D5CBBF] w-full max-w-md mx-4">
        <h3 class="text-2xl font-bold text-[#333] mb-2">Book Session</h3>
        <p id="modal-slot-info" class="text-sm text-[#555] font-medium mb-6"></p>
        
        <form action="{{ route('user.book') }}" method="POST">
            @csrf
            <input type="hidden" name="counsellor_id" value="{{ $user->id }}">
            <input type="hidden" name="date" id="modal-date">
            <input type="hidden" name="start_time" id="modal-start">
            <input type="hidden" name="end_time" id="modal-end">
            
            @if(Auth::check() && str_starts_with(Auth::user()->name, 'User '))
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-2">Your Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full p-3 bg-white border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b]" placeholder="Enter your full name" required>
                    <p class="text-xs text-[#555] mt-1">Please provide your name for your first booking.</p>
                </div>
            @endif
            
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-2">Message for Counsellor <span class="text-red-500">*</span></label>
                <textarea name="message" rows="3" class="w-full p-3 bg-white border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b]" placeholder="Briefly describe why you are booking this session" required></textarea>
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal()" class="px-4 py-2 font-bold text-[#555] hover:text-[#333] transition">Cancel</button>
                <button type="submit" class="px-6 py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition">Confirm Booking</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(date, start, end, displayInfo) {
        @if(Auth::check())
            document.getElementById('modal-date').value = date;
            document.getElementById('modal-start').value = start;
            document.getElementById('modal-end').value = end;
            document.getElementById('modal-slot-info').innerText = displayInfo;
            document.getElementById('booking-modal').classList.remove('hidden');
        @else
            window.location.href = "{{ route('login') }}?redirect={{ urlencode(route('counsellor.show', $user->id)) }}";
        @endif
    }

    function closeModal() {
        document.getElementById('booking-modal').classList.add('hidden');
    }
</script>
@endsection
