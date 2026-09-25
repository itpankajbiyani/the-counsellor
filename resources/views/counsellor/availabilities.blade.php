@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('counsellor.nav')

    <!-- Add Availability -->
    <div class="bg-[#E5DCD3] text-[#333] p-6 max-w-xl mx-auto rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h3 class="text-xl font-bold text-[#333] mb-4">Set Weekly Availability</h3>
        @error('availability')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                {{ $message }}
            </div>
        @enderror
        <form action="{{ route('counsellor.availabilities.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Day of Week</label>
                <select name="day_of_week" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" required>
                    <option value="1" {{ old('day_of_week') == '1' ? 'selected' : '' }}>Monday</option>
                    <option value="2" {{ old('day_of_week') == '2' ? 'selected' : '' }}>Tuesday</option>
                    <option value="3" {{ old('day_of_week') == '3' ? 'selected' : '' }}>Wednesday</option>
                    <option value="4" {{ old('day_of_week') == '4' ? 'selected' : '' }}>Thursday</option>
                    <option value="5" {{ old('day_of_week') == '5' ? 'selected' : '' }}>Friday</option>
                    <option value="6" {{ old('day_of_week') == '6' ? 'selected' : '' }}>Saturday</option>
                    <option value="0" {{ old('day_of_week') == '0' ? 'selected' : '' }}>Sunday</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-[#333] font-bold mb-1">Start Time</label>
                    <select name="start_time" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" required>
                        <option value="">Select Start</option>
                        @for($h=8; $h<=18; $h++)
                            @foreach(['00'] as $m)
                                @php $time = sprintf('%02d:%s', $h, $m); @endphp
                                <option value="{{ $time }}" {{ old('start_time') == $time ? 'selected' : '' }}>{{ date('h:i A', strtotime($time)) }}</option>
                            @endforeach
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-[#333] font-bold mb-1">End Time</label>
                    <select name="end_time" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" required>
                        <option value="">Select End</option>
                        @for($h=8; $h<=18; $h++)
                            @foreach(['00'] as $m)
                                @php $time = sprintf('%02d:%s', $h, $m); @endphp
                                <option value="{{ $time }}" {{ old('end_time') == $time ? 'selected' : '' }}>{{ date('h:i A', strtotime($time)) }}</option>
                            @endforeach
                        @endfor
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition">Add Availability</button>
        </form>
        
        @if(count($availabilities) > 0)
            <div class="mt-8 border-t border-[#D5CBBF] pt-6">
                <h4 class="font-bold text-[#333] mb-4 text-center">Current Availabilities</h4>
                <div class="max-h-80 overflow-y-auto pr-2 space-y-4">
                    @php
                        $groupedAvail = $availabilities->groupBy('day_of_week');
                        $daysMap = [1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 0 => 'Sunday'];
                    @endphp
                    @foreach($daysMap as $dayNum => $dayName)
                        @if($groupedAvail->has($dayNum))
                            <div class="bg-[#F5F0EA] p-3 rounded-xl border border-[#D5CBBF]">
                                <h5 class="font-bold text-[#5c4a3d] border-b border-[#D5CBBF] pb-1 mb-2">{{ $dayName }}</h5>
                                <div class="space-y-2">
                                    @foreach($groupedAvail[$dayNum]->sortBy('start_time') as $avail)
                                        <div class="text-sm bg-white p-2.5 rounded-lg flex justify-between items-center shadow-sm border border-[#D5CBBF]">
                                            <span class="font-medium text-[#333] flex items-center gap-2">
                                                <i data-lucide="clock" class="w-4 h-4 text-[#5a7b6b]"></i>
                                                {{ \Carbon\Carbon::parse($avail->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($avail->end_time)->format('g:i A') }}
                                            </span>
                                            <form action="{{ route('counsellor.availabilities.destroy', $avail) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this availability?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-100 p-1 rounded transition" title="Delete">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
