@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-[#333]">Manage FAQs</h3>
        <a href="{{ route('admin.faqs.create') }}" class="px-6 py-2 bg-[#5a7b6b] text-white font-bold rounded-lg shadow hover:bg-[#4a6758] transition">Add New FAQ</a>
    </div>

    <div class="w-full">
        <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
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
                                <button type="submit" class="px-3 py-1 {{ $faq->is_active ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm font-bold ro