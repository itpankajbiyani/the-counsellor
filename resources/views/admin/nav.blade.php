<div class="flex flex-wrap gap-4 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#E5DCD3]' }}">
        All Bookings
    </a>
    <a href="{{ route('admin.counsellors.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.counsellors.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#E5DCD3]' }}">
        Manage Counsellors
    </a>
    <a href="{{ route('admin.blogs.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.blogs.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#E5DCD3]' }}">
        Manage Blogs
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#E5DCD3]' }}">
        Manage Testimonials
    </a>
</div>
