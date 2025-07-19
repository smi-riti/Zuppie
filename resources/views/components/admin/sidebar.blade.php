<div class="flex h-screen" x-data="{ mobileMenuOpen: false }">
  <!-- Mobile sidebar overlay -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-0 z-40 bg-black bg-opacity-60 md:hidden" 
       @click="mobileMenuOpen = false"
       x-transition:enter="transition-opacity ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
  </div>
  
  <!-- Sidebar - Desktop -->
  <div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-gradient-to-br from-purple-50 via-pink-50 to-pink-100 border-r border-pink-200 shadow-lg">
      <!-- Logo -->
      <div class="flex items-center h-16 px-4 border-b border-pink-300/50 bg-gradient-to-r from-purple-100 to-pink-100">
        <a href="/admin" class="flex items-center space-x-3 group">
          <div class="relative">
            <img src="/images/logo.jpeg" alt="Admin Logo" class="h-10 w-10 rounded-full ring-2 ring-pink-300 group-hover:ring-pink-400 transition-all duration-300">
            <div class="absolute -top-1 -right-1 w-3 h-3 bg-pink-500 rounded-full animate-pulse group-hover:bg-purple-500"></div>
          </div>
          <span class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-pink-600 group-hover:from-pink-600 group-hover:to-purple-500 transition-all duration-300 tracking-tight">
            AdminPanel
          </span>
        </a>
      </div>
      
      <!-- Navigation -->
      <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 bg-white/90 backdrop-blur-sm text-purple-700 border border-pink-200/50 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-pink-500 group-hover:text-purple-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          Dashboard
        </a>
        <a href="{{ route('admin.category.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          Category
        </a>
        <a href="{{ route('admin.reviews.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
          </svg>
          Reviews
        </a>
        <a href="{{ route('admin.offers.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Offers
        </a>
         <a href="{{ route('admin.enquiries.all') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Enquiry
        </a>
        <a href="{{ route('admin.event-packages') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Packages
        </a>
        <a href="{{ route('admin.booking.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Booking
        </a>
        <a href="{{ route('admin.services.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          Service
        </a>
        <a href="{{ route('admin.blogs.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Blogs
        </a>
        <a href="{{ route('admin.settings') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
        <a href="{{ route('admin.users.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          Users
        </a>
      </nav>
      
      <!-- Bottom Section -->
      <div class="p-4 border-t border-pink-300/50 bg-gradient-to-r from-purple-50 to-pink-50">
        <div class="flex items-center px-3 py-2 rounded-lg bg-white/50 backdrop-blur-sm">
          <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-lg shadow-md">
            {{ substr(auth()->user()?->name ?? 'A', 0, 1) }}
          </div>
          <div class="ml-3">
            <p class="text-base font-semibold text-purple-800 truncate">
              {{ auth()->user()?->name ?? 'Admin User' }}
            </p>
            <p class="text-sm text-pink-600 truncate opacity-80">
              {{ auth()->user()?->email ?? 'admin@example.com' }}
            </p>
          </div>
        </div>
        <div class="mt-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-base font-semibold rounded-xl text-pink-700 bg-gradient-to-r from-pink-100 to-purple-100 hover:from-pink-500 hover:to-purple-500 hover:text-white transition-all duration-300 border border-pink-300/50 hover:border-pink-400 group hover:shadow-lg hover:shadow-pink-300/30">
              <svg class="w-6 h-6 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span class="group-hover:font-bold transition-all duration-300">Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile sidebar -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-br from-purple-50 via-pink-50 to-pink-100 shadow-2xl md:hidden"
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full">
    <!-- Mobile sidebar content -->
    <div class="flex flex-col h-full">
      <div class="flex items-center h-16 px-4 border-b border-pink-300/50 bg-gradient-to-r from-purple-100 to-pink-100">
        <button @click="mobileMenuOpen = false" class="ml-auto text-pink-500 hover:text-purple-600">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group bg-white/90 backdrop-blur-sm text-purple-700 border border-pink-200/50 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-pink-500 group-hover:text-purple-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          Dashboard
        </a>
        <a href="{{ route('admin.category.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
          </svg>
          Category
        </a>
        <a href="{{ route('admin.reviews.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
          </svg>
          Reviews
        </a>
        <a href="{{ route('admin.offers.show') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
          </svg>
          Offers
        </a>
        <a href="{{ route('admin.event-packages') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Packages
        </a>
        <a href="{{ route('admin.booking.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Booking
        </a>
        <a href="{{ route('admin.settings') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
        <a href="{{ route('admin.services.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Service
        </a>
        <a href="{{ route('admin.users.manage') }}" wire:navigate class="flex items-center px-4 py-3 text-base font-semibold rounded-xl group transition-all duration-300 text-purple-600 hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 hover:text-pink-700 hover:shadow-md hover:shadow-pink-200/30">
          <svg class="w-6 h-6 mr-3 text-purple-400 group-hover:text-pink-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          Users
        </a>
      </nav>
      
      <div class="p-4 border-t border-pink-300/50 bg-gradient-to-r from-purple-50 to-pink-50">
        <div class="flex items-center px-3 py-2 rounded-lg bg-white/50 backdrop-blur-sm">
          <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-lg shadow-md">
            {{ substr(auth()->user()?->name ?? 'A', 0, 1) }}
          </div>
          <div class="ml-3">
            <p class="text-base font-semibold text-purple-800 truncate">
              {{ auth()->user()?->name ?? 'Admin User' }}
            </p>
            <p class="text-sm text-pink-600 truncate opacity-80">
              {{ auth()->user()?->email ?? 'admin@example.com' }}
            </p>
          </div>
        </div>
        <div class="mt-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-base font-semibold rounded-xl text-pink-700 bg-gradient-to-r from-pink-100 to-purple-100 hover:from-pink-500 hover:to-purple-500 hover:text-white transition-all duration-300 border border-pink-300/50 hover:border-pink-400 group hover:shadow-lg hover:shadow-pink-300/30">
              <svg class="w-6 h-6 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span class="group-hover:font-bold transition-all duration-300">Logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content area -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <!-- Mobile header - Only menu button -->
    <header class="md:hidden bg-gradient-to-r from-purple-100 to-pink-100 border-b border-pink-300/50 shadow-sm">
      <div class="flex items-center justify-start px-4 py-3">
        <button @click="mobileMenuOpen = true" class="text-purple-600 hover:text-pink-600 transition-colors duration-200">
          <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <span class="sr-only">Open menu</span>
        </button>
      </div>
    </header>
    
    <!-- Main content - Takes full width below menu button -->

  </div>
</div>