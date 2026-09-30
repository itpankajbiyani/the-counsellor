<div class="flex flex-wrap gap-4 mb-6 mt-8">
    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        All Bookings
    </a>
    <a href="{{ route('admin.counsellors.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.counsellors.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Counsellors
    </a>
    <!-- <a href="{{ route('admin.blogs.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.blogs.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Blogs
    </a> -->
    <a href="{{ route('admin.blog-categories.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.blog-categories.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Blog Categories
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Testimonials
    </a>
    <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.faqs.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage FAQs
    </a>
    <a href="{{ route('admin.forum.index') }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.forum.*') ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Forum Manager
    </a>
    <a href="{{ route('admin.activities.index', ['type' => 'blog']) }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.activities.*') && request()->route('type') == 'blog' ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Blogs
    </a>
    <a href="{{ route('admin.activities.index', ['type' => 'painting']) }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.activities.*') && request()->route('type') == 'painting' ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Paintings
    </a>
    <a href="{{ route('admin.activities.index', ['type' => 'poetry']) }}" class="px-6 py-2 rounded-lg font-bold transition {{ request()->routeIs('admin.activities.*') && request()->route('type') == 'poetry' ? 'bg-[#5a7b6b] text-white' : 'bg-[#FAF6F4] text-[#5a7b6b] border border-[#D5CBBF] hover:bg-[#efefef]' }}">
        Manage Poetry
    </a>
</div>
