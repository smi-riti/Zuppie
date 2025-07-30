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
                {{-- <div @mouseenter="showMegaMenu = true" @mouseleave="showMegaMenu = false" class="relative">
                    <button class="flex items-center text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">
                        Events
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Mega Menu Dropdown -->
                    <div x-show="showMegaMenu" x-transition
                        class="absolute left-0 mt-2 w-96 bg-white rounded-xl shadow-2xl p-6 z-50">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold text-zuppie-pink-800 mb-3">Event Types</h4>
                                <ul class="space-y-2">
                                    <li><a href="#"
                                            class="flex items-center text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-zuppie-pink-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Birthday Parties
                                        </a></li>
                                    <li><a href="#"
                                            class="flex items-center text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-zuppie-pink-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                            </svg>
                                            Weddings
                                        </a></li>
                                    <li><a href="#"
                                            class="flex items-center text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-zuppie-pink-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Corporate Events
                                        </a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-zuppie-pink-800 mb-3">Quick Links</h4>
                                <ul class="space-y-2">
                                    <li><a href="#"
                                            class="text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">Venues</a></li>
                                    <li><a href="#"
                                            class="text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">Catering</a></li>
                                    <li><a href="#"
                                            class="text-zuppie-pink-700 hover:text-zuppie-pink-600 transition">Photographers</a></li>
                                    <li><a href="#" class="text-zuppie-pink-700 hove <a href="/"
                                            class="flex items-center space-x-2 group">
                                            <div
                                                class="animate__animated animate__pulse animate__infinite animate__slower">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-10 w-10 text-zuppie-600 group-hover:text-zuppie-pink-600 transition"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zuppie-pink-600 to-zuppie-600 group-hover:from-zuppie-700 group-hover:to-zuppie-pink-700 transition">
                                                Zuppie
                                            </span>
                                        </a>r:text-zuppie-pink-600 transition">Decorators</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <a wire:navigate href="{{route('event-packages')}}" class="text-zuppie-pink-700 hover:text-zuppie-pink-600 font-medium transition">EventPackage</a>
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
