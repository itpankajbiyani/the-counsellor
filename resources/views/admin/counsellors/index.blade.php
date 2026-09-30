@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-[#efefef] text-[#333] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex justify-between items-center mb-6 border-b border-[#D5CBBF] pb-4">
            <h3 class="text-2xl font-bold text-[#333]">Manage Counsellors</h3>
            <a href="{{ route('admin.counsellors.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New Counsellor</a>
        </div>

    <div class="w-full">
        <div class="space-y-4">
            @forelse($counsellors as $counsellor)
                <div class="p-4 {{ $loop->even ? 'bg-[#FAF6F4]' : 'bg-white' }} border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        @if($counsellor->image)
                            <img src="{{ asset('images/counsellors/' . $counsellor->image) }}" class="w-12 h-12 object-cover rounded-full border border-[#D5CBBF] shadow-sm">
                        @else
                            <div class="w-12 h-12 flex items-center justify-center bg-[#efefef] rounded-full text-[#5a7b6b] border border-[#D5CBBF] shadow-sm">
                                <i data-lucide="user" class="w-6 h-6"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-[#333] text-lg flex items-center">
                                {{ $counsellor->name }}
                                @if($counsellor->is_active)
                                    <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full uppercase">Active</span>
                                @else
                                    <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full uppercase">Inactive</span>
                                @endif
                            </div>
                            <div class="text-sm text-[#555]">{{ $counsellor->email }}</div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                        <form action="{{ route('admin.counsellors.toggle', $counsellor) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 w-24 text-center {{ $counsellor->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold rounded">
                                {{ $counsellor->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.counsellors.edit', $counsellor) }}" class="px-3 py-1 bg-[#5a7b6b] text-white text-sm font-bold rounded hover:bg-[#4a6758]">Edit</a>
                        <form action="{{ route('admin.counsellors.destroy', $counsellor) }}" method="POST" onsubmit="return confirm('Delete this counsellor? All their data might be affected.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-[#555] bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg">No counsellors found.</div>
            @endforelse
        </div>
    </div>
    </div>
</div>
@endsection
