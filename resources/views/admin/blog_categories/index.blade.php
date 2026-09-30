@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex justify-between items-center mb-6 mt-6">
        <h3 class="text-2xl font-bold text-[#333]">Manage Blog Categories</h3>
        <a href="{{ route('admin.blog-categories.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New Category</a>
    </div>

    <div class="w-full">
        <div class="space-y-4">
            @forelse($categories as $category)
                <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                    <div>
                        <div class="font-bold text-[#333] text-lg flex items-center">
                            {{ $category->name }}
                            @if($category->is_active)
                                <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full uppercase">Active</span>
                            @else
                                <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full uppercase">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 items-center">
                        <form action="{{ route('admin.blog-categories.toggle', $category) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 w-24 text-center {{ $category->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold rounded">
                                {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.blog-categories.edit', $category) }}" class="px-3 py-1 bg-[#5a7b6b] text-white text-sm font-bold rounded hover:bg-[#4a6758]">Edit</a>
                        <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-[#555] bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg">No categories added yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
