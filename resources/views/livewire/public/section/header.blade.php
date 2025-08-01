<header x-data="{ open: false, scrolled: false, showMegaMenu: false }" @scroll.window="scrolled = window.scrollY > 10"
    class="fixed w-full z-50 transition-all duration-500"
    :class="scrolled ? 'bg-white shadow-lg' : 'bg-gradient-to-r from-zuppie-pink-100 to-zuppie-100 shadow-md'">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2 group">
                <div class="">
                    <img src="{{ $settings['site_logo'] }}" alt="{{ $settings['site_name'] }} Logo" class="h-10 w-12">
                </div>
                <span
                    class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zuppie-pink-600 to-zuppie-600 group-hover:from-zuppie-700 group-hover:to-zuppie-pink-700 transition">
                    {{ $settings['site_name'] }}
                </span>
            </a>

            <!-- Desktop Navigation with Mega Menu -->
            <nav class="hidden md:flex space-x-8">
                <a wire:navigate href="{{route('event-packages')}}" class="text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">EventPackage</a>
                <a wire:navigate href="{{route('blog')}}" class="text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">Blog</a>
                <a wire:navigate href="{{route('about')}}" class="text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">About</a>
                <a wire:navigate href="{{route('contact')}}" class="text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">Contact</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="{{ route('profile') }}"
                        class="px-4 py-2 text-zuppie-pink-700 font-medium hover:text-zuppie-pink-600 transition flex items-center space-x-2">
                        <i class="fas fa-calendar-check"></i>
                        <span>My Bookings</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-pink-600 to-zuppie-400 text-white rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-zuppie-pink-700 font-medium hover:text-zuppie-pink-600 transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-gradient-to-r from-zuppie-pink-600 to-zuppie-400 text-white rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button @click="open = !open" class="md:hidden text-zuppie-pink-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition:enter="animate__animated animate__fadeInDown"
            x-transition:leave="animate__animated animate__fadeOutUp" class="md:hidden mt-4 pb-4 space-y-3">
            <a wire:navigate href="{{ route('home') }}" class="block px-3 py-2 text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">Home</a>
            <a wire:navigate href="{{ route('event-packages') }}" class="block px-3 py-2 text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">Event Packages</a>
            <a wire:navigate href="{{ route('blog') }}" class="block px-3 py-2 text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">Blog</a>
            <a wire:navigate href="{{ route('about') }}" class="block px-3 py-2 text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">About</a>
            <a wire:navigate href="{{ route('contact') }}" class="block px-3 py-2 text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">Contact</a>
            <div class="pt-2 border-t border-zuppie-pink-200 space-y-2">
                @auth
                    <a href="{{ route('profile') }}"
                        class="block px-3 py-2 text-center text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded flex items-center justify-center space-x-2">
                        <i class="fas fa-calendar-check"></i>
                        <span>My Bookings</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full px-3 py-2 text-center bg-gradient-to-r from-zuppie-pink-600 to-zuppie-600 text-white rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-600 transition flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-center text-zuppie-pink-700 font-medium hover:bg-zuppie-pink-50 rounded">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-center bg-gradient-to-r from-zuppie-pink-600 to-zuppie-600 text-white rounded-lg hover:from-zuppie-pink-600 hover:to-zuppie-600 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
