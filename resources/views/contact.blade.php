@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="w-full relative overflow-hidden bg-[#fdfcf9] pt-12 pb-16 border-b border-gray-100">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 opacity-40">
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#89a89d] rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
        <h4 class="text-sm font-bold tracking-[0.2em] text-[#b97a61] uppercase mb-4">Get In Touch</h4>
        <h1 class="serif text-5xl md:text-6xl font-bold text-[#2d3a37] mb-6">Contact Us</h1>
        <p class="text-xl text-gray-700 font-medium">We are here to listen and help.</p>
    </div>
</section>

<!-- Contact Info Section -->
<section class="w-full bg-[#f4f7f5] py-24 px-6 flex-grow">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        
        <!-- Left: Info Cards -->
        <div class="space-y-6">
            <h2 class="serif text-3xl font-bold text-[#2d3a37] mb-8">Reach Out To Us</h2>
            
            <!-- Map Address Card -->
            <a href="https://maps.app.goo.gl/V9fiKG1ezvceqicU6" target="_blank" rel="noopener noreferrer" class="flex items-start space-x-6 p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-[#89a89d] transition group">
                <div class="w-16 h-16 bg-[#faeddd] rounded-full flex items-center justify-center flex-shrink-0 group-hover:bg-[#f5b8a0] transition">
                    <img decoding="async" src="https://cdn-icons-png.flaticon.com/512/854/854878.png" alt="Map Icon" class="w-8 h-8 opacity-80">
                </div>
                <div>
                    <h3 class="serif text-xl font-bold text-[#2d3a37] mb-2 group-hover:text-[#b97a61] transition">Address</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Biyani Career Counselling Cell, R4, Mall Rd, Sector-3, Vidyadhar Nagar, Jaipur (Raj.) 302039, India
                    </p>
                </div>
            </a>
            
            <!-- Phone Card -->
            <div class="flex items-start space-x-6 p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-[#e1eae6] rounded-full flex items-center justify-center flex-shrink-0">
                    <i data-lucide="phone" class="w-7 h-7 text-[#5a7b6b]"></i>
                </div>
                <div>
                    <h3 class="serif text-xl font-bold text-[#2d3a37] mb-2">Help Line</h3>
                    <div class="space-y-2 text-gray-600 font-medium">
                        <p>+91-8696218218</p>
                        <p>+91-8290636942</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right: Map Embed (Optional Visual) -->
        <div class="h-full w-full min-h-[400px] bg-gray-200 rounded-3xl overflow-hidden shadow-inner border-4 border-white">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.0701047683935!2d75.7766023!3d26.9329712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db3cc75d79a2f%3A0xc4802b79e7c385c5!2sBiyani%20Group%20of%20Colleges!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        
    </div>
</section>
@endsection
