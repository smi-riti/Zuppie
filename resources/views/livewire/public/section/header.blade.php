<header x-data="{ 
        open: false, 
        scrolled: false, 
        showMegaMenu: false,
        init() {
            this.open = false;
            // Force close on mobile
            if (window.innerWidth < 768) {
                this.open = false;
            }
        }
    }" 
    @scroll.window="scrolled = window.scrollY > 10"
    @resize.window="if (window.innerWidth >= 768) open = false"
    class="fixed w-full z-50 transition-all duration-500"
    :class="scrolled ? 'bg-white shadow-lg' : 'bg-gradient-to-r from-pink-100 to-purple-100 shadow-md'"
    <div class="container mx-auto px-1 py-1">
        <div class="flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2 group">
                <div class="">
                    <x-imagekit-image 
                        :src="$settings['site_logo']" 
                        :alt="$settings['site_name'] . ' Logo'" 
                        class="h-20 w-30"
                        width="120"
                        height="80"
                        :lazy="false"
                        :critical="true"
                    />
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
            <button @click="open = !open" 
                class="md:hidden text-pink-700 hover:text-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 rounded-lg p-2 transition-colors"
                :class="scrolled ? 'text-pink-700' : 'text-pink-800'"
                :aria-expanded="open"
                aria-label="Toggle mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform duration-200" 
                    :class="open ? 'rotate-90' : ''"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" 
            x-transition:enter="transition-all duration-300 ease-out"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition-all duration-200 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden mt-4 pb-4 space-y-3 border-t border-pink-200"
            :class="scrolled ? 'bg-white' : 'bg-gradient-to-r from-pink-50 to-purple-50'"
            <a href="{{ route('home') }}" @click="open = false"
                class="block px-3 py-2 text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">Home</a>
            <a href="{{ route('event-packages') }}" wire:navigate @click="open = false"
                class="block px-3 py-2 text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">Event Packages</a>
            <a href="{{ route('blog') }}" wire:navigate @click="open = false"
                class="block px-3 py-2 text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">Blog</a>
            <a href="{{ route('about') }}" wire:navigate @click="open = false"
                class="block px-3 py-2 text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">About</a>
            <a href="{{ route('contact') }}" wire:navigate @click="open = false"
                class="block px-3 py-2 text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">Contact</a>
            <div class="pt-2 border-t border-pink-200 space-y-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full px-3 py-2 text-center bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg hover:from-pink-700 hover:to-purple-700 transition-all duration-200 flex items-center justify-center space-x-2 shadow-md hover:shadow-lg">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" wire:navigate @click="open = false"
                        class="block px-3 py-2 text-center text-pink-800 font-medium hover:bg-pink-100 hover:text-pink-900 rounded-lg transition-colors">Login</a>
                    <a href="{{ route('register') }}" wire:navigate @click="open = false"
                        class="block px-3 py-2 text-center bg-gradient-to-r from-pink-600 to-purple-600 text-white rounded-lg hover:from-pink-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>