<div class="mt-12 mb-8 flex justify-center">
    <div class="glass p-1.5 inline-flex flex-wrap justify-center gap-1 rounded-full bg-white/30 backdrop-blur-md border border-white/50 shadow-sm">
        <a href="{{ route('counsellor.bookings') }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.bookings') || request()->routeIs('counsellor.dashboard') ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>Bookings</span>
        </a>
        
        <a href="{{ route('counsellor.availabilities') }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.availabilities') ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="clock" class="w-4 h-4"></i>
            <span>Availabilities</span>
        </a>
        
        <a href="{{ route('counsellor.leaves') }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.leaves') ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="calendar-off" class="w-4 h-4"></i>
            <span>Exceptions</span>
        </a>
        
        <a href="{{ route('counsellor.activities', ['type' => 'blog']) }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.activities') && request()->route('type') === 'blog' ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="file-text" class="w-4 h-4"></i>
            <span>Manage Blogs</span>
        </a>
        
        <a href="{{ route('counsellor.activities', ['type' => 'painting']) }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.activities') && request()->route('type') === 'painting' ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="palette" class="w-4 h-4"></i>
            <span>Manage Paintings</span>
        </a>
        
        <a href="{{ route('counsellor.activities', ['type' => 'poetry']) }}" 
           class="px-6 py-2.5 rounded-full font-bold text-sm transition-all duration-300 flex items-center gap-2
                  {{ request()->routeIs('counsellor.activities') && request()->route('type') === 'poetry' ? 'bg-white text-[#5c4a3d] shadow-md scale-105' : 'text-gray-700 hover:bg-white/50 hover:text-[#5c4a3d]' }}">
            <i data-lucide="feather" class="w-4 h-4"></i>
            <span>Manage Poetry</span>
        </a>
    </div>
</div>
