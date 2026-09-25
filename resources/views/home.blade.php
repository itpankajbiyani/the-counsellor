@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="w-full bg-[#F4EDE4] border-b border-[#E5DCD3]">
    <img src="{{ asset('images/layout/img_0_1.jpeg') }}" class="w-full h-auto" alt="Biyani Ghar - A safe space for every student to be heard">
</section>

<!-- Comfort Section -->
<section class="w-full bg-[#FAF6F1] py-24 px-6">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <div class="flex items-center space-x-4 mb-4">
                <span class="w-8 h-px bg-[#B99A81]"></span>
                <span class="text-xs font-bold tracking-[0.2em] text-[#B99A81] uppercase">Welcome</span>
            </div>
            <h2 class="serif text-4xl md:text-5xl font-bold text-[#4A5D4E] mb-8 leading-tight">Comfort begins with<br>being heard</h2>
            <p class="text-[#6B5D53] text-lg leading-relaxed mb-10">
                Biyani Ghar is a calm corner of campus life, made for the moments when studies, friendships, relationships or the future feel like too much. Here, every student is welcome to pause, share what is on their mind and be met with warmth, never judgment.
            </p>
            <div class="flex items-center space-x-4 bg-[#F2ECE4] p-4 rounded-xl inline-flex border border-[#E8DFC8]">
                <div class="w-10 h-10 bg-[#4A5D4E] rounded-full flex items-center justify-center text-white flex-shrink-0">
                    <i data-lucide="lock" class="w-5 h-5"></i>
                </div>
                <p class="text-sm text-[#4A5D4E] font-medium leading-snug">
                    <strong class="font-bold">Secure Platform:</strong> your information shared will be kept confidential.
                </p>
            </div>
        </div>
        <div class="md:w-1/2">
            <!-- Illustration -->
            <div class="rounded-[3rem] overflow-hidden relative shadow-sm border border-[#F0E6CD]">
                <img src="{{ asset('images/layout/img_0_24.jpeg') }}" class="w-full h-auto object-cover" alt="Comfort Illustration">
            </div>
        </div>
    </div>
</section>

<!-- How Biyani Ghar Helps -->
<section class="w-full bg-[#EEF2ED] py-24 px-6 border-y border-[#E2E8DF]">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center space-x-4 mb-4">
                <span class="w-8 h-px bg-[#8BA090]"></span>
                <span class="text-xs font-bold tracking-[0.2em] text-[#8BA090] uppercase">Gentle, Private Support</span>
                <span class="w-8 h-px bg-[#8BA090]"></span>
            </div>
            <h2 class="serif text-4xl font-bold text-[#4A5D4E]">How Biyani Ghar Helps</h2>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <!-- Illustration -->
                <div class="rounded-[3rem] overflow-hidden relative shadow-sm border border-[#F4E1D8]">
                    <img src="{{ asset('images/layout/img_0_26.jpeg') }}" class="w-full h-auto object-cover" alt="Support Illustration">
                </div>
            </div>
            <div class="md:w-1/2">
                <p class="text-[#6B5D53] text-lg leading-relaxed mb-8">
                    Biyani Ghar offers a private, welcoming space to talk with trained counsellors who listen without judgment. Whether it is exam stress, homesickness or a heavy heart you cannot quite explain, you will be guided at your own pace towards small, practical steps that help you feel steady again.
                </p>
                <a href="#counsellors" class="inline-block bg-[#5E7363] text-white px-8 py-3 rounded-full font-bold text-sm tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What brings you here today? -->
<section class="w-full bg-[#FAF6F1] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <span class="w-8 h-px bg-[#B99A81]"></span>
            <span class="text-xs font-bold tracking-[0.2em] text-[#B99A81] uppercase">Find your starting point</span>
            <span class="w-8 h-px bg-[#B99A81]"></span>
        </div>
        <h2 class="serif text-4xl font-bold text-[#4A5D4E] mb-4">What brings you here today?</h2>
        <p class="text-[#8C7D70] italic text-lg mb-16 max-w-2xl mx-auto">
            You do not have to be in crisis to talk to someone. Choose what feels closest to you right now.
        </p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            <!-- 9 Cards -->
            @php
            $cards = [
                ['icon' => 'heart', 'color' => 'text-[#D9877A]', 'bg' => 'bg-[#F9E9E7]', 'title' => 'Relationships', 'desc' => 'Untangle friendships, family ties and heartbreak with care.'],
                ['icon' => 'wind', 'color' => 'text-[#7CB3A1]', 'bg' => 'bg-[#E5F1ED]', 'title' => 'Anxiety & Panic', 'desc' => 'Quiet a racing mind and find your footing again.'],
                ['icon' => 'cloud-rain', 'color' => 'text-[#DDB15C]', 'bg' => 'bg-[#FDF2D9]', 'title' => 'Depression & Low Mood', 'desc' => 'Find your way back to motivation when everything feels heavy.'],
                ['icon' => 'battery-low', 'color' => 'text-[#D79469]', 'bg' => 'bg-[#F8EBE3]', 'title' => 'Stress & Burnout', 'desc' => 'Ease the pressure of deadlines, exams and expectations.'],
                ['icon' => 'brain', 'color' => 'text-[#A0A56E]', 'bg' => 'bg-[#F1F2E8]', 'title' => 'Overthinking', 'desc' => 'Step out of the what-ifs and back into the present.'],
                ['icon' => 'compass', 'color' => 'text-[#7AB296]', 'bg' => 'bg-[#E5F1EB]', 'title' => 'Life Direction', 'desc' => 'Gain clarity about your path and choose with confidence.'],
                ['icon' => 'shield', 'color' => 'text-[#B88764]', 'bg' => 'bg-[#F5EBE4]', 'title' => 'Abuse & Bullying', 'desc' => 'A safe space to talk about abuse or bullying, in confidence and without judgment.'],
                ['icon' => 'alert-circle', 'color' => 'text-[#A68F87]', 'bg' => 'bg-[#F2EDEA]', 'title' => 'Harassment & Past Trauma', 'desc' => 'Process harassment or past trauma at your own pace, with steady, patient support.'],
                ['icon' => 'leaf', 'color' => 'text-[#9CB67F]', 'bg' => 'bg-[#F0F5EB]', 'title' => 'Grief & Loss of a Loved One', 'desc' => 'Gentle support for grief and the loss of someone you love.']
            ];
            @endphp
            
            @foreach($cards as $card)
            <div class="bg-white p-8 rounded-3xl border border-[#F0E6CD] shadow-sm hover:shadow-md transition">
                <div class="w-10 h-10 {{ $card['bg'] }} rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="{{ $card['icon'] }}" class="{{ $card['color'] }} w-5 h-5"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-3">{{ $card['title'] }}</h3>
                <p class="text-[#7A6E63] text-sm leading-relaxed">{{ $card['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Our Counsellors -->
<section id="counsellors" class="w-full bg-[#F4ECE5] py-24 px-6 border-y border-[#EADBCC]">
    <div class="max-w-6xl mx-auto text-center">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <span class="w-8 h-px bg-[#B99A81]"></span>
            <span class="text-xs font-bold tracking-[0.2em] text-[#B99A81] uppercase">Meet The Team</span>
            <span class="w-8 h-px bg-[#B99A81]"></span>
        </div>
        <h2 class="serif text-4xl font-bold text-[#4A5D4E] mb-4">Our Counsellors</h2>
        <p class="text-[#8C7D70] italic text-lg mb-16">
            Caring, trained professionals who are here to listen and guide.
        </p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($counsellors as $counsellor)
                <div class="bg-white p-6 rounded-3xl text-center border border-[#EADBCC] shadow-sm flex flex-col items-center group hover:border-[#A5C3AE] transition">
                    <div class="bg-[#F4ECE5] w-24 h-24 rounded-t-full rounded-b-xl flex items-end justify-center mb-6 pt-4 px-2 overflow-hidden border border-[#EADBCC]">
                        @if($counsellor->image)
                            <img src="{{ asset('images/counsellors/' . $counsellor->image) }}" class="w-full h-full object-cover rounded-t-full rounded-b-xl">
                        @else
                            <i data-lucide="user" class="w-16 h-16 text-[#B99A81] mb-[-10px]"></i>
                        @endif
                    </div>
                    <h3 class="serif font-bold text-[#4A5D4E] mb-1">{{ $counsellor->name }}</h3>
                    <p class="text-[0.65rem] text-[#8C7D70] uppercase tracking-wider mb-1 font-bold">Qualification</p>
                    <p class="text-[0.65rem] text-[#8C7D70] mb-6">Experience: X years</p>
                    
                    <a href="{{ route('counsellor.show', $counsellor) }}" class="mt-auto bg-[#6E8578] text-white text-[0.65rem] font-bold tracking-widest uppercase px-4 py-2.5 rounded-full group-hover:bg-[#4A5D4E] transition w-full shadow-sm">
                        Book Session
                    </a>
                </div>
            @empty
                <div class="col-span-full text-[#8C7D70] py-8">No counsellors currently available.</div>
            @endforelse
            
            <!-- Padding empty slots to match design grid if few counsellors -->
            @for ($i = $counsellors->count(); $i < 5; $i++)
                <div class="bg-white p-6 rounded-3xl text-center border border-[#EADBCC] shadow-sm flex flex-col items-center opacity-60">
                    <div class="bg-[#F4ECE5] w-24 h-24 rounded-t-full rounded-b-xl flex items-end justify-center mb-6 pt-4 px-2 overflow-hidden border border-[#EADBCC]">
                        <i data-lucide="user" class="w-16 h-16 text-[#B99A81] mb-[-10px]"></i>
                    </div>
                    <h3 class="serif font-bold text-[#4A5D4E] mb-1">Coming Soon</h3>
                    <p class="text-[0.65rem] text-[#8C7D70] uppercase tracking-wider mb-6 font-bold">Counsellor</p>
                    <button disabled class="mt-auto bg-[#D5DCD8] text-[#8C9B90] text-[0.65rem] font-bold tracking-widest uppercase px-4 py-2.5 rounded-full w-full cursor-not-allowed">
                        Book Session
                    </button>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Activity Corner -->
<section class="w-full bg-[#FAF6F1] py-24 px-6">
    <div class="max-w-5xl mx-auto text-center">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <span class="w-8 h-px bg-[#B99A81]"></span>
            <span class="text-xs font-bold tracking-[0.2em] text-[#B99A81] uppercase">Share Your Voice</span>
            <span class="w-8 h-px bg-[#B99A81]"></span>
        </div>
        <h2 class="serif text-4xl font-bold text-[#4A5D4E] mb-4">Activity Corner</h2>
        <p class="text-[#8C7D70] italic text-lg mb-16">
            A space for students to express themselves. Submit your blogs, paintings and poetry, and we may feature them here.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
            $activities = [
                ['icon' => 'book-open', 'title' => 'Blogs', 'desc' => 'Share your thoughts, stories or reflections with fellow students.'],
                ['icon' => 'paintbrush', 'title' => 'Paintings', 'desc' => 'Submit artwork or sketches that express how you feel.'],
                ['icon' => 'feather', 'title' => 'Poetry', 'desc' => 'Put your emotions into verse and share them with the community.']
            ];
            @endphp
            
            @foreach($activities as $act)
            <div class="bg-white p-8 rounded-3xl border border-[#F0E6CD] shadow-sm flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-[#F3EFE9] rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="{{ $act['icon'] }}" class="text-[#B99A81] w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#4A5D4E] mb-3">{{ $act['title'] }}</h3>
                <p class="text-[#7A6E63] text-xs leading-relaxed mb-8 flex-grow px-4">{{ $act['desc'] }}</p>
                <button class="bg-[#6E8578] text-white text-[0.65rem] font-bold tracking-widest uppercase px-6 py-2.5 rounded-full hover:bg-[#4A5D4E] transition shadow-sm">
                    Submit Now
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="w-full bg-[#FCF8E9] py-24 px-6 border-y border-[#F3EDD7]">
    <div class="max-w-6xl mx-auto text-center">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <span class="w-8 h-px bg-[#C9B387]"></span>
            <span class="text-xs font-bold tracking-[0.2em] text-[#C9B387] uppercase">In Their Own Words</span>
            <span class="w-8 h-px bg-[#C9B387]"></span>
        </div>
        <h2 class="serif text-4xl font-bold text-[#4A5D4E] mb-16">Testimonials</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @php $avatarColors = ['bg-[#E4B594]', 'bg-[#98B3A4]', 'bg-[#D6A28C]']; @endphp
            @forelse($testimonials as $index => $testimonial)
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-[#F0E6CD] flex flex-col">
                    <div class="flex text-[#F5C771] mb-6 space-x-1">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="italic text-[#6B5D53] text-sm leading-relaxed flex-grow mb-8">
                        "{{ $testimonial->content }}"
                    </p>
                    <div class="border-t border-[#F3EFE9] pt-6">
                        <div>
                            <h4 class="serif font-bold text-sm text-[#4A5D4E]">{{ $testimonial->student_name }}</h4>
                            <p class="text-xs text-[#8C7D70] italic">{{ $testimonial->course_year }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#8C7D70] py-8">No testimonials added yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Mental Health Blogs -->
<section class="w-full bg-[#FAF6F1] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <span class="w-8 h-px bg-[#B99A81]"></span>
            <span class="text-xs font-bold tracking-[0.2em] text-[#B99A81] uppercase">Read & Reflect</span>
            <span class="w-8 h-px bg-[#B99A81]"></span>
        </div>
        <h2 class="serif text-4xl font-bold text-[#4A5D4E] mb-16">Mental Health Blogs to Guide Your Journey</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @php $blogColors = ['bg-[#FCEFE9]', 'bg-[#EBF2EE]', 'bg-[#FDF4E7]']; @endphp
            @forelse($blogs as $index => $blog)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-[#F0E6CD] flex flex-col group">
                    <div class="h-48 {{ $blogColors[$index % 3] }} relative flex items-center justify-center overflow-hidden p-6">
                        @if($blog->category)
                            <div class="absolute top-4 left-4 bg-white text-[0.55rem] font-bold tracking-widest uppercase px-3 py-1.5 rounded-full shadow-sm text-[#8C7D70] z-10">{{ $blog->category }}</div>
                        @endif
                        @if($blog->image)
                            <img src="{{ asset('images/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover absolute top-0 left-0 opacity-40 mix-blend-multiply group-hover:opacity-60 transition duration-500">
                        @else
                            <i data-lucide="book-open" class="w-20 h-20 text-[#D4C3B3] opacity-50 relative z-0 group-hover:scale-110 transition duration-500"></i>
                        @endif
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="serif text-lg font-bold text-[#4A5D4E] mb-6 flex-grow leading-snug group-hover:text-[#6E8578] transition">{{ $blog->title }}</h3>
                        <a href="{{ route('blog.show', $blog) }}" class="text-[0.65rem] font-bold tracking-widest text-[#8C7D70] uppercase flex items-center hover:text-[#4A5D4E] transition group-hover:translate-x-1 duration-300">
                            Read More <i data-lucide="arrow-right" class="w-3 h-3 ml-2"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-[#8C7D70] py-8">No blogs added yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="w-full bg-[#EEF2ED] py-24 px-6 border-t border-[#E2E8DF]">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center space-x-4 mb-4">
                <span class="w-8 h-px bg-[#8BA090]"></span>
                <span class="text-xs font-bold tracking-[0.2em] text-[#8BA090] uppercase">Got Questions?</span>
                <span class="w-8 h-px bg-[#8BA090]"></span>
            </div>
            <h2 class="serif text-4xl font-bold text-[#4A5D4E]">Frequently Asked Questions</h2>
        </div>
        
        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#E2E8DF] flex space-x-4 items-start">
                <div class="w-8 h-8 bg-[#DCE5DF] rounded-full flex items-center justify-center text-[#4A5D4E] flex-shrink-0 mt-1">
                    <i data-lucide="help-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="serif font-bold text-[#4A5D4E] mb-2">Are my details confidential?</h4>
                    <p class="text-sm text-[#7A6E63] leading-relaxed">100% confidential. Everything you share with your counsellor stays strictly between the two of you. Biyani Ghar never discloses your identity, conversations or personal details to college staff, faculty or anyone else without your written consent.</p>
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#E2E8DF] flex space-x-4 items-start">
                <div class="w-8 h-8 bg-[#DCE5DF] rounded-full flex items-center justify-center text-[#4A5D4E] flex-shrink-0 mt-1">
                    <i data-lucide="help-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="serif font-bold text-[#4A5D4E] mb-2">Is counselling free for students?</h4>
                    <p class="text-sm text-[#7A6E63] leading-relaxed">Yes, Biyani Ghar's counselling sessions are offered free of cost to all enrolled students.</p>
                </div>
            </div>
            <!-- FAQ 3 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#E2E8DF] flex space-x-4 items-start">
                <div class="w-8 h-8 bg-[#DCE5DF] rounded-full flex items-center justify-center text-[#4A5D4E] flex-shrink-0 mt-1">
                    <i data-lucide="help-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="serif font-bold text-[#4A5D4E] mb-2">How do I book a session?</h4>
                    <p class="text-sm text-[#7A6E63] leading-relaxed">Use the "Book Session" button anywhere on this page to choose a counsellor and a time that works for you.</p>
                </div>
            </div>
            <!-- FAQ 4 -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#E2E8DF] flex space-x-4 items-start">
                <div class="w-8 h-8 bg-[#DCE5DF] rounded-full flex items-center justify-center text-[#4A5D4E] flex-shrink-0 mt-1">
                    <i data-lucide="help-circle" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="serif font-bold text-[#4A5D4E] mb-2">Can I reach out anonymously at first?</h4>
                    <p class="text-sm text-[#7A6E63] leading-relaxed">Yes, you are welcome to ask general questions anonymously before deciding whether to share your name and details.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
