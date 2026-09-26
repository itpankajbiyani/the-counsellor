@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto">
    <div class="flex items-center space-x-4 mb-6">
        <a href="{{ route('admin.faqs.index') }}" class="text-[#5a7b6b] hover:underline font-bold">← Back to FAQs</a>
        <h2 class="text-3xl font-bold text-[#333]">Edit FAQ</h2>
    </div>

    <div class="bg-[#efefef] p-8 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Question</label>
                <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Answer</label>
                <textarea name="answer" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <button type="submit" class="w-full py-3 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow text-lg">Update FAQ</button>
        </form>
    </div>
</div>
@endsection
