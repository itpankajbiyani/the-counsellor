@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="mb-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Blogs Stat -->
        <div class="bg-white p-6 rounded-xl border border-[#D5CBBF] shadow-sm transition block group">
            <div class="flex items-center justify-between mb-2">
                <a href="{{ route('admin.activities.index', ['type' => 'blog', 'status' => 'pending']) }}" class="text-[#8C7D70] font-bold uppercase tracking-wider text-xs hover:text-[#5a7b6b] transition">Blogs</a>
                <div class="bg-[#FAF6F4] p-2 rounded-lg text-[#5a7b6b]">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-[#333] mb-2">{{ $stats['blog_total'] }}</div>
            <div class="flex flex-wrap gap-2 text-[10px] font-bold mt-3">
                <a href="{{ route('admin.activities.index', ['type' => 'blog', 'status' => 'pending']) }}" class="text-yellow-600 bg-yellow-50 px-2 py-1 rounded hover:bg-yellow-100 transition">{{ $stats['blog_pending'] }} Under Review</a>
                <a href="{{ route('admin.activities.index', ['type' => 'blog', 'status' => 'approved']) }}" class="text-green-600 bg-green-50 px-2 py-1 rounded hover:bg-green-100 transition">{{ $stats['blog_approved'] }} Approved</a>
                <a href="{{ route('admin.activities.index', ['type' => 'blog', 'status' => 'rejected']) }}" class="text-red-600 bg-red-50 px-2 py-1 rounded hover:bg-red-100 transition">{{ $stats['blog_rejected'] }} Rejected</a>
            </div>
        </div>

        <!-- Paintings Stat -->
        <div class="bg-white p-6 rounded-xl border border-[#D5CBBF] shadow-sm transition block group">
            <div class="flex items-center justify-between mb-2">
                <a href="{{ route('admin.activities.index', ['type' => 'painting', 'status' => 'pending']) }}" class="text-[#8C7D70] font-bold uppercase tracking-wider text-xs hover:text-[#5a7b6b] transition">Paintings</a>
                <div class="bg-[#FAF6F4] p-2 rounded-lg text-[#5a7b6b]">
                    <i data-lucide="image" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-[#333] mb-2">{{ $stats['painting_total'] }}</div>
            <div class="flex flex-wrap gap-2 text-[10px] font-bold mt-3">
                <a href="{{ route('admin.activities.index', ['type' => 'painting', 'status' => 'pending']) }}" class="text-yellow-600 bg-yellow-50 px-2 py-1 rounded hover:bg-yellow-100 transition">{{ $stats['painting_pending'] }} Under Review</a>
                <a href="{{ route('admin.activities.index', ['type' => 'painting', 'status' => 'approved']) }}" class="text-green-600 bg-green-50 px-2 py-1 rounded hover:bg-green-100 transition">{{ $stats['painting_approved'] }} Approved</a>
                <a href="{{ route('admin.activities.index', ['type' => 'painting', 'status' => 'rejected']) }}" class="text-red-600 bg-red-50 px-2 py-1 rounded hover:bg-red-100 transition">{{ $stats['painting_rejected'] }} Rejected</a>
            </div>
        </div>

        <!-- Poetry Stat -->
        <div class="bg-white p-6 rounded-xl border border-[#D5CBBF] shadow-sm transition block group">
            <div class="flex items-center justify-between mb-2">
                <a href="{{ route('admin.activities.index', ['type' => 'poetry', 'status' => 'pending']) }}" class="text-[#8C7D70] font-bold uppercase tracking-wider text-xs hover:text-[#5a7b6b] transition">Poetry</a>
                <div class="bg-[#FAF6F4] p-2 rounded-lg text-[#5a7b6b]">
                    <i data-lucide="feather" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-[#333] mb-2">{{ $stats['poetry_total'] }}</div>
            <div class="flex flex-wrap gap-2 text-[10px] font-bold mt-3">
                <a href="{{ route('admin.activities.index', ['type' => 'poetry', 'status' => 'pending']) }}" class="text-yellow-600 bg-yellow-50 px-2 py-1 rounded hover:bg-yellow-100 transition">{{ $stats['poetry_pending'] }} Under Review</a>
                <a href="{{ route('admin.activities.index', ['type' => 'poetry', 'status' => 'approved']) }}" class="text-green-600 bg-green-50 px-2 py-1 rounded hover:bg-green-100 transition">{{ $stats['poetry_approved'] }} Approved</a>
                <a href="{{ route('admin.activities.index', ['type' => 'poetry', 'status' => 'rejected']) }}" class="text-red-600 bg-red-50 px-2 py-1 rounded hover:bg-red-100 transition">{{ $stats['poetry_rejected'] }} Rejected</a>
            </div>
        </div>

        <!-- Forum Questions Stat -->
        <a href="{{ route('admin.forum.index') }}" class="bg-white p-6 rounded-xl border border-[#D5CBBF] shadow-sm hover:shadow-md transition block group">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-[#8C7D70] font-bold uppercase tracking-wider text-xs group-hover:text-[#5a7b6b]">Forum Questions</h4>
                <div class="bg-[#FAF6F4] p-2 rounded-lg text-[#5a7b6b]">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-bold text-[#333] mb-2">{{ $stats['questions_total'] }}</div>
            <div class="text-xs font-medium text-gray-500 mt-2">
                View all Q&A
            </div>
        </a>
    </div>

    <div class="bg-[#efefef] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
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
                                @elseif($booking->status === 'completed')
                                    <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded font-bold uppercase text-xs">Completed</span>
                                @else
                                    <span class="px-2 py-1 bg-red-200 text-red-800 rounded font-bold uppercase text-xs">Cancelled</span>
                                    @if($booking->cancelled_by)
                                        <p class="text-[0.65rem] font-bold text-red-600 uppercase mt-1">By: {{ $booking->cancelled_by }}</p>
                                    @endif
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
