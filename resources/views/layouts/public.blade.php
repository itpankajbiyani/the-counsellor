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
    <header class="bg-[#FAF6F1] py-5 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50 border-b border-[#E8DFC8]">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <div class="bg-[#788E81] text-white p-2 rounded-full shadow-sm">
                <i data-lucide="leaf" class="w-5 h-5"></i>
            </div>
            <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-[#4A5D4E] tracking-tight">Biyani Ghar</a>
        </div>
        
        <!-- Links -->
        <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium text-[#6B5D53]">
            <a href="{{ route('home') }}" class="hover:text-[#4A5D4E] transition {{ request()->routeIs('home') ? 'text-[#4A5D4E] font-bold' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="hover:text-[#4A5D4E] transition {{ request()->routeIs('about') ? 'text-[#4A5D4E] font-bold' : '' }}">About</a>
            <a href="{{ route('home') }}#counsellors" class="hover:text-[#4A5D4E] transition">Our Counsellors</a>
            <div class="relative group py-2">
                <button class="hover:text-[#4A5D4E] transition flex items-center">Reading Corner <i data-lucide="chevron-down" class="w-3 h-3 ml-1"></i></button>
                <div class="absolute left-0 mt-2 w-40 bg-white border border-[#E8DFC8] rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                    <a href="{{ route('reading.blogs') }}" class="block px-4 py-3 text-sm text-[#6B5D53] hover:bg-[#FAF6F1] hover:text-[#4A5D4E] font-medium border-b border-gray-50">Blogs</a>
                    <a href="{{ route('reading.paintings') }}" class="block px-4 py-3 text-sm text-[#6B5D53] hover:bg-[#FAF6F1] hover:text-[#4A5D4E] font-medium border-b border-gray-50">Paintings</a>
                    <a href="{{ route('reading.poetry') }}" class="block px-4 py-3 text-sm text-[#6B5D53] hover:bg-[#FAF6F1] hover:text-[#4A5D4E] font-medium">Poetry</a>
                </div>
            </div>
            <a href="{{ route('forum.index') }}" class="hover:text-[#4A5D4E] transition {{ request()->routeIs('forum.*') ? 'text-[#4A5D4E] font-bold' : '' }}">Forum</a>
            <a href="{{ route('contact') }}" class="hover:text-[#4A5D4E] transition {{ request()->routeIs('contact') ? 'text-[#4A5D4E] font-bold' : '' }}">Contact</a>
        </nav>
        
        <!-- Right side -->
        <div class="flex items-center space-x-4">
            <form action="{{ route('reading.blogs') }}" method="GET" class="hidden md:flex items-center bg-[#EAE3D5] rounded-full px-4 py-2 border border-[#DFD5C4]">
                <button type="submit" class="focus:outline-none"><i data-lucide="search" class="w-4 h-4 text-[#8C7D70] mr-2 hover:text-[#4A5D4E]"></i></button>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search blogs..." class="bg-transparent outline-none text-sm w-24 md:w-32 text-[#4A5D4E] placeholder-[#8C7D70]">
            </form>

            @guest
            <a href="{{ route('login') }}" class="bg-[#5E7363] text-white px-6 py-2.5 rounded-full text-sm font-bold tracking-wide hover:bg-[#4A5D4E] transition shadow-sm">
                Talk to Us
            </a>
            @endguest
            
            @auth
                <div class="relative group">
                    <button class="flex items-center space-x-1 text-[#4A5D4E] font-bold hover:text-[#6E8578] transition focus:outline-none py-2">
                        <span>Welcome, {{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                    <!-- Dropdown -->
                    <div class="absolute right-0 mt-1 w-48 bg-white border border-[#E8DFC8] rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                        <div class="py-1">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm text-[#6B5D53] hover:bg-[#F4ECE5] hover:text-[#4A5D4E] transition">Dashboard</a>
                            @elseif(Auth::user()->role === 'counsellor')
                                <a href="{{ route('counsellor.dashboard') }}" class="block px-4 py-2.5 text-sm text-[#6B5D53] hover:bg-[#F4ECE5] hover:text-[#4A5D4E] transition">Dashboard</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2.5 text-sm text-[#6B5D53] hover:bg-[#F4ECE5] hover:text-[#4A5D4E] transition">My Bookings</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block w-full text-left m-0">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
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

    <!-- Footer Main -->
    <footer class="bg-[#505A46] text-[#EADBCC] pt-16 pb-12 px-6 md:px-12 w-full border-t-[16px] border-[#D6DFD9]">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start gap-12">
            <!-- Left: Logo & Address -->
            <div class="space-y-6 max-w-sm">
                <div class="bg-white p-3 inline-block rounded border border-[#EFF1E8]">
                    <!-- Placeholder for Biyani Logo -->
                    <div class="text-[#991b1b] font-serif font-bold text-2xl leading-none">BIYANI</div>
                    <div class="text-gray-800 text-[0.6rem] font-bold tracking-widest uppercase">Group of Colleges</div>
                </div>
                <div class="flex items-start space-x-3 text-[#DCE5DF] text-sm mt-4">
                    <i data-lucide="map-pin" class="w-5 h-5 flex-shrink-0 text-[#A5C3AE] mt-0.5"></i>
                    <p>Sector -3 Vidhyadhar Nagar,<br>Jaipur (Raj.) 302039, India</p>
                </div>
            </div>
            
            <!-- Right: Help Line -->
            <div>
                <h3 class="text-xl font-serif font-bold mb-6 text-white">Help Line</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 text-[#DCE5DF]">
                        <i data-lucide="phone" class="w-5 h-5 text-[#A5C3AE]"></i>
                        <span>+91-8696218218</span>
                    </div>
                    <div class="flex items-center space-x-3 text-[#DCE5DF]">
                        <i data-lucide="phone" class="w-5 h-5 text-[#A5C3AE]"></i>
                        <span>+91-8290636942</span>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#6E8578]">
                        <a href="{{ route('counsellor.login') }}" class="flex items-center space-x-2 text-[#A5C3AE] hover:text-white font-medium transition text-sm">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            <span>Counsellor Login</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Bottom -->
    <div class="bg-[#F4E7D3] py-6 px-6 md:px-12 w-full">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-[#8C7D70] text-[0.65rem]">
            <div class="space-y-1 text-center md:text-left max-w-3xl">
                <p class="font-bold text-[#6B5D53]">Copyright © {{ date('Y') }} Biyani Ghar All Rights Reserved.</p>
                <p class="opacity-90">Biyani Ghar does not discriminate on, exclude people or treat them differently on the basis of race, color, national origin, age, disability, sex, gender identity or expression or any other type of discrimination prohibited by law.</p>
            </div>
            <div class="flex items-center space-x-4 text-[#6B5D53]">
                <i data-lucide="instagram" class="w-4 h-4 cursor-pointer hover:text-[#4A5D4E]"></i>
                <i data-lucide="youtube" class="w-4 h-4 cursor-pointer hover:text-[#4A5D4E]"></i>
                <i data-lucide="linkedin" class="w-4 h-4 cursor-pointer hover:text-[#4A5D4E]"></i>
                <i data-lucide="twitter" class="w-4 h-4 cursor-pointer hover:text-[#4A5D4E]"></i>
                <i data-lucide="facebook" class="w-4 h-4 cursor-pointer hover:text-[#4A5D4E]"></i>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
