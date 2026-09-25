@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="w-full relative overflow-hidden bg-[#fdfcf9] pt-12 pb-24">
    <!-- Abstract shapes -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-40">
        <div class="absolute top-10 left-10 w-32 h-32 bg-[#89a89d] rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
        <div class="absolute top-20 right-20 w-48 h-48 bg-[#f5b8a0] rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col items-center text-center">
        <h4 class="text-sm font-bold tracking-[0.2em] text-[#b97a61] uppercase mb-4">Biyani Group of Colleges</h4>
        <h1 class="serif text-5xl md:text-7xl font-bold text-[#2d3a37] mb-6">Biyani Ghar</h1>
        <p class="text-xl md:text-2xl text-gray-700 font-medium mb-12">A safe space for every student to be heard</p>
        
        <div class="w-full max-w-5xl">
            <img src="{{ asset('images/hero.jpg') }}" alt="Hero Illustration" class="w-full h-auto rounded-3xl shadow-xl border border-gray-100 object-cover" style="max-height: 500px; object-position: center;">
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="w-full bg-white py-24 px-6 border-t border-gray-100">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <h4 class="text-sm font-bold tracking-[0.2em] text-[#b97a61] uppercase mb-4">Welcome</h4>
            <h2 class="serif text-4xl md:text-5xl font-bold text-[#2d3a37] mb-6 leading-tight">Comfort begins with<br>being heard</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                Biyani Ghar is a calm corner of campus life, made for the moments when studies, friendships or the future feel like too much. Here, every student is welcome to pause, share what is on their mind and be met with warmth, never judgment.
            </p>
        </div>
        <div class="md:w-1/2">
            <div class="bg-[#faeddd] rounded-3xl p-6 md:p-12 relative">
                <img src="{{ asset('images/welcome.jpg') }}" alt="Welcome Illustration" class="w-full h-auto rounded-2xl shadow-sm mix-blend-multiply border-2 border-white/50">
            </div>
        </div>
    </div>
</section>

<!-- How Biyani Ghar Helps -->
<section class="w-full bg-[#f4f7f5] py-24 px-6">
    <div class="max-w-6xl mx-auto flex flex-col-reverse md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <div class="bg-[#faeddd] rounded-3xl p-6 md:p-10 relative">
                <img src="{{ asset('images/how_it_helps.jpg') }}" alt="Online Consultation" class="w-full h-auto rounded-2xl shadow-sm mix-blend-multiply border-2 border-white/50">
            </div>
        </div>
        <div class="md:w-1/2">
            <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-6">How Biyani Ghar Helps</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-8">
                Biyani Ghar offers a private, welcoming space to talk with trained counsellors who listen without judgment. Whether it is exam stress, homesickness or a heavy heart you cannot quite explain, you will be guided at your own pace towards small, practical steps that help you feel steady again.
            </p>
            <a href="#counsellors" class="inline-block bg-[#5a7b6b] text-white px-8 py-3 rounded-full font-medium hover:bg-[#4a6758] transition">Book Now</a>
        </div>
    </div>
</section>

<!-- What brings you here today? -->
<section class="w-full bg-[#fdfcf9] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-4">What brings you here today?</h2>
        <p class="text-gray-600 text-lg mb-16 max-w-2xl mx-auto">
            You do not have to be in crisis to talk to someone. Choose what feels closest to you right now.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
            <!-- Card 1 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="heart" class="text-red-400 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Relationships</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Untangle friendships, family ties and heartbreak with care.</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="wind" class="text-green-500 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Anxiety & Panic</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Quiet a racing mind and find your footing again.</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="cloud-rain" class="text-yellow-600 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Depression & Low Mood</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Find your way back to motivation when everything feels heavy.</p>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="battery-low" class="text-orange-500 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Stress & Burnout</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Ease the pressure of deadlines, exams and expectations.</p>
            </div>
            <!-- Card 5 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="brain" class="text-purple-500 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Overthinking</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Step out of the what-ifs and back into the present.</p>
            </div>
            <!-- Card 6 -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-teal-50 rounded-full flex items-center justify-center mb-6">
                    <i data-lucide="compass" class="text-teal-500 w-6 h-6"></i>
                </div>
                <h3 class="serif text-xl font-bold text-[#2d3a37] mb-3">Life Direction</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Gain clarity about your path and choose with confidence.</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Counsellors -->
<section id="counsellors" class="w-full bg-[#f6efe9] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-4">Our Counsellors</h2>
        <p class="text-gray-600 text-lg mb-16">
            Meet caring, trained professionals who are here to listen and guide.
        </p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($counsellors as $counsellor)
                <div class="bg-white p-6 rounded-2xl text-center border border-gray-100 shadow-sm flex flex-col items-center">
                    @if($counsellor->image)
                        <img src="{{ asset('images/counsellors/' . $counsellor->image) }}" class="w-20 h-20 rounded-full object-cover mb-4 border-2 border-[#e1eae6]">
                    @else
                        <div class="w-20 h-20 bg-[#e1eae6] rounded-full flex items-center justify-center mb-4 text-[#5a7b6b]">
                            <i data-lucide="user" class="w-8 h-8"></i>
                        </div>
                    @endif
                    <h3 class="serif font-bold text-[#2d3a37] mb-6">{{ $counsellor->name }}</h3>
                    <a href="{{ route('counsellor.show', $counsellor) }}" class="mt-auto bg-[#6e8578] text-white text-xs font-bold tracking-wide uppercase px-6 py-2 rounded-full hover:bg-[#5a7b6b] transition w-full">Book Session</a>
                </div>
            @empty
                <div class="col-span-full text-gray-500 py-8">No counsellors currently available.</div>
            @endforelse
            
            <!-- Generate a few dummy visual placeholders if < 10 counsellors exist to match the grid look of the PDF -->
            @for ($i = $counsellors->count(); $i < 10; $i++)
                <div class="bg-white p-6 rounded-2xl text-center border border-gray-100 shadow-sm flex flex-col items-center opacity-70">
                    <div class="w-20 h-20 bg-[#faeddd] rounded-full flex items-center justify-center mb-4 text-[#b97a61]">
                        <i data-lucide="user" class="w-8 h-8"></i>
                    </div>
                    <h3 class="serif font-bold text-[#2d3a37] mb-1">Counsellor Name</h3>
                    <p class="text-xs text-gray-500 mb-1">Qualification</p>
                    <p class="text-xs text-gray-500 mb-6">Experience: X years</p>
                    <button disabled class="mt-auto bg-gray-300 text-white text-xs font-bold tracking-wide uppercase px-6 py-2 rounded-full w-full cursor-not-allowed">Book Session</button>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="w-full bg-[#f4f7f5] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-4">Testimonials</h2>
        <p class="text-gray-600 text-lg mb-16">In their own words</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @php $avatarColors = ['bg-[#f5b8a0]', 'bg-[#89a89d]', 'bg-[#e0a899]']; @endphp
            @forelse($testimonials as $index => $testimonial)
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex text-yellow-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="italic text-gray-600 text-sm leading-relaxed flex-grow mb-8">
                        "{{ $testimonial->content }}"
                    </p>
                    <div class="flex items-center space-x-3">
                        @if($testimonial->image)
                            <img src="{{ asset('images/testimonials/' . $testimonial->image) }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 {{ $avatarColors[$index % 3] }} rounded-full flex items-center justify-center text-white"><i data-lucide="user" class="w-5 h-5"></i></div>
                        @endif
                        <div>
                            <h4 class="font-bold text-sm text-[#2d3a37]">{{ $testimonial->student_name }}</h4>
                            <p class="text-xs text-gray-500">{{ $testimonial->course_year }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">No testimonials added yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Blogs -->
<section class="w-full bg-[#fdfcf9] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-16">Mental Health Blogs to Guide Your Journey</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            @php $blogColors = ['bg-[#faeddd]', 'bg-[#e1eae6]', 'bg-[#faeddd]']; @endphp
            @forelse($blogs as $index => $blog)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col">
                    <div class="h-48 {{ $blogColors[$index % 3] }} relative flex items-center justify-center overflow-hidden">
                        @if($blog->category)
                            <div class="absolute top-4 left-4 bg-white text-[0.6rem] font-bold tracking-wider uppercase px-2 py-1 rounded text-[#b97a61]">{{ $blog->category }}</div>
                        @endif
                        @if($blog->image)
                            <img src="{{ asset('images/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover opacity-60 mix-blend-multiply">
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="serif text-lg font-bold text-[#2d3a37] mb-4 flex-grow">{{ $blog->title }}</h3>
                        @if($blog->link)
                            <a href="{{ $blog->link }}" target="_blank" class="text-xs font-bold tracking-widest text-gray-500 uppercase flex items-center hover:text-[#5a7b6b]">Read More <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i></a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">No blogs added yet.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection
