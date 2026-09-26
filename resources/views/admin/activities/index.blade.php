@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="mb-6">
        <h3 class="text-2xl font-bold text-[#333]">Manage Activities (Blogs, Paintings, Poetry)</h3>
    </div>

    <!-- Pending Activities -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-[#D5CBBF] mb-8">
        <h4 class="text-lg font-bold text-[#4A5D4E] mb-4 border-b pb-2 border-gray-100">Pending Approvals</h4>
        <div class="space-y-4">
            @forelse($pendingActivities as $activity)
                <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        @if($activity->image)
                            <img src="{{ asset('images/activities/' . $activity->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                        @endif
                        <div>
                            <div class="font-bold text-[#333] text-lg">{{ $activity->title }} <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-1 rounded ml-2 uppercase">{{ $activity->type }}</span></div>
                            <div class="text-sm text-[#555]">By: {{ $activity->user->name ?? 'Unknown' }} | {{ $activity->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.activities.approve', $activity) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-green-500 text-white text-sm font-bold rounded hover:bg-green-600">Approve</button>
                        </form>
                        <form action="{{ route('admin.activities.reject', $activity) }}" method="POST" onsubmit="return confirm('Reject this activity?');">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Reject</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-500 italic">No pending activities.</div>
            @endforelse
        </div>
    </div>

    <!-- Approved Activities -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h4 class="text-lg font-bold text-[#4A5D4E] mb-4 border-b pb-2 border-gray-100">Approved Activities (User Submitted)</h4>
        <div class="space-y-4">
            @forelse($approvedActivities as $activity)
                <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center opacity-75 hover:opacity-100 transition">
                    <div class="flex items-center space-x-4">
                        @if($activity->image)
                            <img src="{{ asset('images/activities/' . $activity->image) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                        @endif
                        <div>
                            <div class="font-bold text-[#333] text-lg">{{ $activity->title }} <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded ml-2 uppercase">{{ $activity->type }}</span></div>
                            <div class="text-sm text-[#555]">By: {{ $activity->user->name ?? 'Unknown' }} | {{ $activity->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-bold rounded border border-green-200">Approved</span>
                        <form action="{{ route('admin.activities.reject', $activity) }}" method="POST" onsubmit="return confirm('Revoke approval and reject this activity?');">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Reject</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-500 italic">No approved user activities.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
