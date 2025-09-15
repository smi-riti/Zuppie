<div x-data="{ mobileMenuOpen: false }" x-init="window.addEventListener('open-admin-mobile-menu', () => mobileMenuOpen = true)">
  <!-- Mobile sidebar overlay -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-0 z-40 bg-black bg-opacity-70 md:hidden" 
       @click="mobileMenuOpen = false"
       x-transition:enter="transition-opacity ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
  </div>        
  
  <!-- Sidebar - Desktop (Fixed) -->
  <div class="hidden md:flex md:flex-shrink-0 fixed h-screen">
    <div class="flex flex-col w-64 bg-white border-r border-purple-200">
      <!-- Logo -->
      <div class="flex items-center h-16 px-4 border-b border-purple-200 bg-purple-100">
        <a href="/admin" class="flex items-center space-x-3">
          <img src="/images/logo.jpeg" alt="Admin Logo" class="h-10 w-10 rounded-full">
          <span class="text-2xl font-bold text-purple-600">
            AdminPanel
          </span>
        </a>
      </div>
      
      <!-- Navigation -->
      <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.dashboard') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.dashboard') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          Dashboard
        </a>
        <a href="{{ route('admin.category.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.category.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.category.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
          </svg>
          Category
        </a>
        <a href="{{ route('admin.event-packages') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.event-packages') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.event-packages') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          Packages
        </a>
        {{-- <a href="{{ route('admin.booking.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.booking.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.booking.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Booking
        </a> --}}
        <a href="{{ route('admin.enquiries.all') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.enquiries.all') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.enquiries.all') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          Enquiry
        </a>
        <a href="{{ route('admin.reviews.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.reviews.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.reviews.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
          </svg>
          Reviews
        </a>
        <a href="{{ route('admin.offers.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.offers.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.offers.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Offers
        </a>
        <a href="{{ route('admin.services.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.services.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.services.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          Service
        </a>
        <a href="{{ route('admin.blogs.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.blogs.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.blogs.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Blogs
        </a>
        {{-- <a href="{{ route('gallery.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('gallery.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('gallery.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Gallery
        </a> --}}
        <a href="{{ route('admin.settings') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.settings') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.settings') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
        <a href="{{ route('admin.users.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base rounded-md {{ Route::is('admin.users.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-6 h-6 mr-3 {{ Route::is('admin.users.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          Users
        </a>
      </nav>
      
      <!-- Bottom Section -->
      <div class="p-4 border-t border-purple-200 bg-purple-50">
        <div class="flex items-center px-3 py-2 rounded-md bg-white">
          <div class="h-10 w-10 rounded-full bg-purple-400 flex items-center justify-center text-white text-lg">
            {{ substr(auth()->user()?->name ?? 'A', 0, 1) }}
          </div>
          <div class="ml-3">
            <p class="text-base text-purple-800 truncate">
              {{ auth()->user()?->name ?? 'Admin User' }}
            </p>
            <p class="text-sm text-purple-600 truncate opacity-80">
              {{ auth()->user()?->email ?? 'admin@example.com' }}
            </p>
          </div>
        </div>
        <div class="mt-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-base rounded-md text-purple-700 bg-purple-100 hover:bg-purple-500 hover:text-white">
              <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile sidebar -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-y-0 left-0 z-50 w-80 bg-white md:hidden"
       x-transition:enter="transition ease-out duration-400 transform"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-300 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full">
    <!-- Mobile sidebar content -->
    <div class="flex flex-col h-full">
      <!-- Provided header -->
      <header class="bg-purple-100 border-b border-purple-200">
        <div class="flex items-center justify-between px-6 py-4">
          <!-- Logo in mobile header -->
          <a href="/admin/" class="flex items-center space-x-3 group">
            <div class="relative">
              <img src="/images/logo.jpeg" alt="Admin Logo" class="h-10 w-10 rounded-full ring-2 ring-purple-300 group-hover:ring-purple-400 transition-all duration-300">
              <div class="absolute -top-1 -right-1 w-3 h-3 bg-purple-500 rounded-full animate-pulse group-hover:bg-purple-600"></div>
            </div>
            <span class="text-xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-600 group-hover:from-purple-600 group-hover:to-purple-500 transition-all duration-300 tracking-tight">
              AdminPanel
            </span>
          </a>
          <!-- Menu button -->
          <button @click="mobileMenuOpen = false" class="text-purple-600 hover:text-purple-700 transition-colors duration-200">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Close menu</span>
          </button>
        </div>
      </header>
      
      <nav class="flex-1 px-4 py-8 space-y-3 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.dashboard') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.dashboard') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          Dashboard
        </a>
        <a href="{{ route('admin.category.show') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.category.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.category.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
          </svg>
          Category
        </a>
        <a href="{{ route('admin.event-packages') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.event-packages') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.event-packages') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          Packages
        </a>
        {{-- <a href="{{ route('admin.booking.manage') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.booking.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.booking.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Booking
        </a> --}}
        <a href="{{ route('admin.enquiries.all') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.enquiries.all') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.enquiries.all') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          Enquiry
        </a>
        <a href="{{ route('admin.reviews.show') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.reviews.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.reviews.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
          </svg>
          Reviews
        </a>
        <a href="{{ route('admin.offers.show') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.offers.show') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.offers.show') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Offers
        </a>
        <a href="{{ route('admin.services.manage') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.services.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.services.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          Service
        </a>
        <a href="{{ route('admin.blogs.manage') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.blogs.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.blogs.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Blogs
        </a>
          {{-- <a href="{{ route('gallery.manage') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('gallery.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
            <svg class="w-7 h-7 mr-4 {{ Route::is('gallery.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Gallery
          </a> --}}
        <a href="{{ route('admin.settings') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.settings') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.settings') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
        <a href="{{ route('admin.users.manage') }}" wire:navigate class="flex items-center px-4 py-4 text-lg rounded-md {{ Route::is('admin.users.manage') ? 'bg-purple-100 text-purple-700' : 'text-purple-600' }} hover:bg-purple-100 hover:text-purple-700">
          <svg class="w-7 h-7 mr-4 {{ Route::is('admin.users.manage') ? 'text-purple-600' : 'text-purple-500' }} hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          Users
        </a>
      </nav>
      
      <div class="p-4 border-t border-purple-200 bg-purple-50">
        <div class="flex items-center px-3 py-2 rounded-md bg-white">
          <div class="h-10 w-10 rounded-full bg-purple-400 flex items-center justify-center text-white text-lg">
            {{ substr(auth()->user()?->name ?? 'A', 0, 1) }}
          </div>
          <div class="ml-3">
            <p class="text-base text-purple-800 truncate">
              {{ auth()->user()?->name ?? 'Admin User' }}
            </p>
            <p class="text-sm text-purple-600 truncate opacity-80">
              {{ auth()->user()?->email ?? 'admin@example.com' }}
            </p>
          </div>
        </div>
        <div class="mt-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-4 text-lg rounded-md text-purple-700 bg-purple-100 hover:bg-purple-500 hover:text-white">
              <svg class="w-7 h-7 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>