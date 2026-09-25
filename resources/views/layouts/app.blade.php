<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Biyani Ghar') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #EFF1E8;
            color: #333;
        }
        h1, h2, h3, h4, .serif {
            font-family: 'Merriweather', serif;
        }
    </style>
</head>
<body class="min-h-screen antialiased flex flex-col font-sans">
    
    <!-- Navbar -->
    <header class="bg-[#FAF6F4] border-b border-[#F9ECE1] py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <div class="bg-[#5a7b6b] text-white p-2 rounded-full">
                <i data-lucide="leaf" class="w-5 h-5"></i>
            </div>
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 tracking-tight">Biyani Ghar</a>
        </div>
        
        <!-- Links -->
        <nav class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-700">
            @if(Auth::check())
                <span class="text-[#5a7b6b] font-bold text-lg">Welcome, {{ Auth::user()->name }}!</span>
            @else
                <a href="{{ route('home') }}" class="hover:text-[#5a7b6b]">Home</a>
                <a href="{{ route('about') }}" class="hover:text-[#5a7b6b]">About</a>
                <a href="{{ route('home') }}#counsellors" class="hover:text-[#5a7b6b]">Counselling</a>
                <a href="#" class="hover:text-[#5a7b6b]">Resources</a>
                <a href="{{ route('forum.index') }}" class="hover:text-[#5a7b6b]">Forum</a>
                <a href="{{ route('contact') }}" class="hover:text-[#5a7b6b]">Contact</a>
            @endif
        </nav>
        
        <!-- Right side -->
        <div class="flex items-center space-x-4">
            @if(!Auth::check())
            <div class="hidden lg:flex items-center bg-gray-100 rounded-full px-4 py-2">
                <i data-lucide="search" class="w-4 h-4 text-gray-500 mr-2"></i>
                <input type="text" placeholder="Search" class="bg-transparent outline-none text-sm w-32">
            </div>
            @endif
            
            @guest
                <a href="{{ route('login') }}" class="bg-[#5a7b6b] text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-[#4a6758] transition flex items-center space-x-1">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>User Login</span>
                </a>
            @endguest
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium hover:text-[#5a7b6b]">Dashboard</a>
                @elseif(Auth::user()->role === 'counsellor')
                    <a href="{{ route('counsellor.dashboard') }}" class="text-sm font-medium hover:text-[#5a7b6b]">Dashboard</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="text-sm font-medium hover:text-[#5a7b6b]">My Bookings</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-600 px-4 py-2 rounded-full text-sm font-medium hover:bg-red-100 ml-2">Logout</button>
                </form>
            @endauth
        </div>
    </header>

    <main class="flex-grow w-full flex flex-col items-center">
        @if(session('success'))
            <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-green-50 border-l-4 border-green-500 text-green-800 font-medium rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="w-full max-w-4xl mt-6 px-6 py-4 bg-red-50 border-l-4 border-red-500 text-red-800 font-medium rounded shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @if(!Auth::check())
    <!-- Footer Main -->
    <footer class="bg-[#F9ECE1] text-[#333] pt-16 pb-12 px-6 md:px-12 mt-16 w-full">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
            <!-- Left: Logo & Address -->
            <div class="space-y-4 max-w-sm">
                <div class="bg-[#FAF6F4] p-3 inline-block rounded border border-[#EFF1E8]">
                    <!-- Placeholder for Biyani Logo -->
                    <div class="text-[#991b1b] font-serif font-bold text-2xl leading-none">BIYANI</div>
                    <div class="text-gray-800 text-[0.6rem] font-bold tracking-widest uppercase">Group of Colleges</div>
                </div>
                <div class="flex items-start space-x-3 text-gray-700 text-sm mt-4">
                    <i data-lucide="map-pin" class="w-5 h-5 flex-shrink-0 text-gray-500 mt-0.5"></i>
                    <p>Sector -3 Vidhyadhar Nagar,<br>Jaipur (Raj.) 302039, India</p>
                </div>
            </div>
            
            <!-- Right: Help Line -->
            <div>
                <h3 class="text-xl font-serif font-bold mb-6">Help Line</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 text-gray-700">
                        <i data-lucide="phone" class="w-5 h-5 text-[#333]"></i>
                        <span>+91-8696218218</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-700">
                        <i data-lucide="phone" class="w-5 h-5 text-[#333]"></i>
                        <span>+91-8290636942</span>
                    </div>
                    <div class="pt-8 mt-8 border-t border-[#D5CBBF]">
                        <a href="{{ route('counsellor.login') }}" class="flex items-center space-x-2 text-gray-700 hover:text-[#5a7b6b] font-medium transition">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            <span>Counsellor Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Bottom -->
    <div class="bg-[#FAF6F4] py-6 px-6 md:px-12 w-full border-t border-[#F9ECE1]">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-[#5c4a3d] text-xs">
            <div class="space-y-1 text-center md:text-left max-w-3xl">
                <p class="font-bold">Copyright © {{ date('Y') }} Biyani Ghar All Rights Reserved.</p>
                <p class="opacity-80">Biyani Ghar does not discriminate on, exclude people or treat them differently on the basis of race, color, national origin, age, disability, sex, gender identity or expression or any other type of discrimination prohibited by law.</p>
            </div>
            <div class="flex items-center space-x-4">
                <i data-lucide="instagram" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="youtube" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="linkedin" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="twitter" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
                <i data-lucide="facebook" class="w-5 h-5 cursor-pointer hover:text-[#5a7b6b]"></i>
            </div>
        </div>
    </div>
    @endif

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
