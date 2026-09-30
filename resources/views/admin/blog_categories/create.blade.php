@extends('layouts.app')

@section('content')
<div class="w-full max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
    <div class="flex items-center mb-8 border-b border-[#C5BBAF] pb-4">
        <a href="{{ route('admin.blog-categories.index') }}" class="mr-4 text-[#8C7D70] hover:text-[#5E7363] transition">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-3xl font-bold text-[#333]">Add New Category</h2>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            <ul class="list-disc pl-5 mt-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blog-categories.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="block text-[#333] font-bold mb-2">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl focus:ring-2 focus:ring-[#A5C3AE]">
        </div>
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.blog-categories.index') }}" class="px-6 py-2.5 bg-gray-200 text-[#333] font-bold rounded-xl hover:bg-gray-300 transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-[#5E7363] text-white font-bold rounded-xl hover:bg-[#4A5D4E] transition shadow">Save Category</button>
        </div>
    </form>
</div>
@endsection
