@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-[#efefef] text-[#333] p-6 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <div class="flex justify-between items-center mb-6 border-b border-[#D5CBBF] pb-4">
            <h3 class="text-2xl font-bold text-[#333]">Manage FAQs</h3>
            <a href="{{ route('admin.faqs.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New FAQ</a>
        </div>

    <div class="w-full">
        <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div class="p-4 {{ $loop->even ? 'bg-[#FAF6F4]' : 'bg-white' }} border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div>
                            <div>
                                <div class="font-bold text-[#333] text-lg">
                                    {{ $faq->question }}
                                    @if($faq->is_active)
                                        <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full uppercase">Active</span>
                                    @else
                                        <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full uppercase">Inactive</span>
                                    @endif
                                </div>
                                <div class="text-sm text-[#444] italic mt-1 max-w-md truncate">{{ strip_tags($faq->answer) }}</div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                            <form action="{{ route('admin.faqs.toggle', $faq) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 w-24 text-center {{ $faq->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold rounded">
                                    {{ $faq->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="px-3 py-1 bg-[#5a7b6b] text-white text-sm font-bold rounded hover:bg-[#4a6758]">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Delete this FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-[#555] bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg">No FAQs added yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
