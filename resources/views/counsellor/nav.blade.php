<div class="mt-8 mb-8 flex justify-center">
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
    </div>
</div>
