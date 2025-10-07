<header x-data="{ open: false, scrolled: false, showMegaMenu: false }" @scroll.window="scrolled = window.scrollY > 10"
    class="fixed w-full z-50 transition-all duration-500"
    :class="scrolled ? 'bg-white shadow-lg' : 'bg-gradient-to-r from-pink-100 to-purple-100 shadow-md'">
    <div class="container mx-auto px-1 py-1">
        <div class="flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2 group">
                <div class="">
                    <img src="{{$settings['site_logo']}}" alt="Site Logo" class="h-20 w-30">
                </div>
               
            </a>

            <!-- Desktop Navigation with Mega Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{route('event-packages')}}" wire:navigate
                    class="text-pink-700 hover:text-pink-600 font-medium transition">EventPackage</a>
                <a href="{{route('blog')}}" wire:navigate
                    class="text-pink-700 hover:text-pink-600 font-medium transition">Blog</a>
                <a href="{{route('about')}}" wire:navigate
                    class="text-pink-700 hover:text-pink-600 font-medium transition">About</a>
                <a href="{{route('contact')}}" wire:navigate
                    class="text-pink-700 hover:text-pink-600 font-medium transition">Contact</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-pink-600 to-purple-400 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" wire:navigate
                        class="px-4 py-2 text-pink-700 font-medium hover:text-pink-600 transition">Login</a>
                    <a href="{{ route('register') }}" wire:navigate
                        class="px-4 py-2 bg-gradient-to-r from-pink-600 to-purple-400 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <button @click="open = !open" class="md:hidden text-pink-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition:enter="animate__animated animate__fadeInDown"
            x-transition:leave="animate__animated animate__fadeOutUp" class="md:hidden mt-4 pb-4 space-y-3">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 text-pink-700 font-medium hover:bg-pink-50 rounded">Home</a>
            <a href="{{ route('event-packages') }}" wire:navigate
                class="block px-3 py-2 text-pink-700 font-medium hover:bg-pink-50 rounded">Event Packages</a>
            <a href="{{ route('blog') }}" wire:navigate
                class="block px-3 py-2 text-pink-700 font-medium hover:bg-pink-50 rounded">Blog</a>
            <a href="{{ route('about') }}" wire:navigate
                class="block px-3 py-2 text-pink-700 font-medium hover:bg-pink-50 rounded">About</a>
            <a href="{{ route('contact') }}" wire:navigate
                class="block px-3 py-2 text-pink-700 font-medium hover:bg-pink-50 rounded">Contact</a>
            <div class="pt-2 border-t border-pink-200 space-y-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full px-3 py-2 text-center bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" wire:navigate
                        class="block px-3 py-2 text-center text-pink-700 font-medium hover:bg-pink-50 rounded">Login</a>
                    <a href="{{ route('register') }}" wire:navigate
                        class="block px-3 py-2 text-center bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>