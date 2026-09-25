@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto mt-16 mb-16">
    <div class="bg-[#E5DCD3] text-[#333] p-8 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h2 class="text-2xl font-bold text-[#333] mb-6 text-center">Staff / Counsellor Login</h2>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-2">Email Address</label>
                <input type="email" name="email" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" required>
            </div>
            <div class="mb-6">
                <label class="block text-[#333] font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" required>
            </div>
            <button type="submit" class="w-full py-3 mt-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition text-lg">Login</button>
        </form>
    </div>
</div>
@endsection
