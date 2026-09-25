@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="w-full relative overflow-hidden bg-[#fdfcf9] pt-16 pb-24 border-b border-gray-100">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-40">
        <div class="absolute -top-10 -right-10 w-64 h-64 bg-[#89a89d] rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute top-40 -left-20 w-48 h-48 bg-[#f5b8a0] rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
    </div>
    
    <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
        <h4 class="text-sm font-bold tracking-[0.2em] text-[#b97a61] uppercase mb-4">About Biyani Ghar</h4>
        <h1 class="serif text-5xl md:text-6xl font-bold text-[#2d3a37] mb-8 leading-tight">Nurturing Minds,<br>Empowering Futures.</h1>
        <p class="text-xl text-gray-600 font-medium max-w-3xl mx-auto leading-relaxed">
            Biyani Ghar is more than just a counselling cell; it is a safe haven where students can freely express their thoughts, overcome their challenges, and discover their true potential in a judgment-free environment.
        </p>
    </div>
</section>

<!-- Our Mission & Vision -->
<section class="w-full bg-white py-24 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div>
            <div class="bg-[#faeddd] rounded-3xl p-8 relative overflow-hidden h-96 flex items-center justify-center">
                <!-- Abstract visual placeholder instead of missing image -->
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full mix-blend-overlay opacity-40"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 bg-[#b97a61] rounded-full mix-blend-multiply opacity-20 filter blur-xl"></div>
                <i data-lucide="heart-handshake" class="w-32 h-32 text-[#b97a61] relative z-10 opacity-80"></i>
            </div>
        </div>
        <div>
            <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-6">Our Mission</h2>
            <p class="text-gray-600 text-lg leading-relaxed mb-10">
                To foster a culture of mental wellbeing and emotional resilience within the campus community. We aim to provide accessible, empathetic, and professional psychological support to help students navigate academic pressures, personal struggles, and career dilemmas.
            </p>
            
            <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-6">Our Vision</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                We envision a campus where every student feels valued, heard, and mentally equipped to face life's challenges. Through Biyani Ghar, we strive to break the stigma around mental health and create a generation of confident, self-aware individuals.
            </p>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="w-full bg-[#f4f7f5] py-24 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h4 class="text-sm font-bold tracking-[0.2em] text-[#5a7b6b] uppercase mb-4">What We Stand For</h4>
        <h2 class="serif text-4xl font-bold text-[#2d3a37] mb-16">Our Core Values</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition">
                <div class="w-16 h-16 bg-[#e1eae6] rounded-full flex items-center justify-center mb-6 text-[#5a7b6b]">
                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                </div>
                <h3 class="serif text-2xl font-bold text-[#2d3a37] mb-4">Confidentiality</h3>
                <p class="text-gray-600">Your stories, struggles, and identity remain strictly confidential. What is shared in Biyani Ghar, stays in Biyani Ghar.</p>
            </div>
            
            <!-- Value 2 -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition">
                <div class="w-16 h-16 bg-[#faeddd] rounded-full flex items-center justify-center mb-6 text-[#b97a61]">
                    <i data-lucide="users" class="w-8 h-8"></i>
                </div>
                <h3 class="serif text-2xl font-bold text-[#2d3a37] mb-4">Empathy</h3>
                <p class="text-gray-600">We listen to understand, not to judge. Our counsellors approach every session with deep compassion and an open mind.</p>
            </div>
            
            <!-- Value 3 -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:shadow-md transition">
                <div class="w-16 h-16 bg-[#f5b8a0] rounded-full flex items-center justify-center mb-6 text-white">
                    <i data-lucide="sparkles" class="w-8 h-8"></i>
                </div>
                <h3 class="serif text-2xl font-bold text-[#2d3a37] mb-4">Empowerment</h3>
                <p class="text-gray-600">We don't just solve problems; we equip you with the mental tools and resilience needed to overcome future hurdles independently.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="w-full bg-[#2d3a37] py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        <h2 class="serif text-3xl md:text-4xl font-bold text-white mb-6">Ready to take the first step?</h2>
        <p class="text-gray-300 text-lg mb-10">Talking to someone is a sign of strength. Book a session with one of our expert counsellors today.</p>
        <a href="{{ route('home') }}#counsellors" class="inline-block bg-[#f5b8a0] text-white px-8 py-4 rounded-full font-bold tracking-wide uppercase hover:bg-[#e0a899] transition shadow-lg">
            Book A Session Now
        </a>
    </div>
</section>
@endsection
