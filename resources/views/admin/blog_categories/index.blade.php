@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-[#efefef] p-6 rounded-2xl shadow-lg border border-[#D5CBBF] mt-6">
        <h3 class="text-2xl font-bold text-[#333] mb-6">Manage Blog Categories</h3>
        
        <div class="mb-8">
            <form action="{{ route('admin.blog-categories.store') }}" method="POST" class="flex gap-4 items-end">
                @csrf
                <div class="flex-grow">
                    <label class="block text-[#333] font-bold mb-1">New Category Name</label>
                    <input type="text" name="name" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required>
                </div>
                <button type="submit" class="bg-[#5a7b6b] text-white px-6 py-2 rounded font-bold hover:bg-[#4a6758] h-[42px]">Add</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                        <th class="p-3">ID</th>
                        <th class="p-3">Category Name</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-[#C5BBAF] hover:bg-[#F2EAE1] transition">
                            <td class="p-3 text-[#333]">{{ $category->id }}</td>
                            <td class="p-3 text-[#333]">
                                <form action="{{ route('admin.blog-categories.update', $category) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}" class="p-1 border border-[#D5CBBF] rounded text-sm w-48" required>
                                    @if($category->is_active)
                                        <span class="text-[10px] bg-green-100 text-green-800 px-2 py-1 rounded uppercase flex items-center">Active</span>
                                    @else
                                        <span class="text-[10px] bg-red-100 text-red-800 px-2 py-1 rounded uppercase flex items-center">Inactive</span>
                                    @endif
                                    <button type="submit" class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Update</button>
                                </form>
                            </td>
                            <td class="p-3">
                                <form action="{{ route('admin.blog-categories.toggle', $category) }}" method="POST" class="inline flex-shrink-0">
                                    @csrf
                                    <button type="submit" class="text-xs w-20 text-center {{ $category->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white px-2 py-1 rounded">
                                        {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="inline ml-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-[#555]">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
