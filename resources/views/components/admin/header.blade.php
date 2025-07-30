<header class="fixed w-full z-50 shadow-sm border-b border-gray-200 bg-gradient-to-r from-zuppie-pink-50 to-zuppie-50" 
        x-data="{ mobileMenuOpen: false, userDropdownOpen: false }"
        @keydown.escape="mobileMenuOpen = false; userDropdownOpen = false">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">
      
      <!-- Logo -->
      <div class="flex items-center">
        <div class="flex-shrink-0 flex items-center">
          <a href="/admin" class="flex items-center space-x-2 group">
            <div class="animate-pulse">
              <img src="/images/logo.jpeg" alt="Admin Logo" class="h-8 w-8 rounded-full">
            </div>
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-zuppie-pink-600 to-zuppie-600 group-hover:from-zuppie-700 group-hover:to-zuppie-pink-700 transition">
              AdminPanel
            </span>
          </a>
        </div>
      </div>

      <!-- Right side - User and Notifications -->
      <div class="hidden md:ml-4 md:flex md:items-center md:space-x-4">
        <!-- Notification Bell -->
        <button class="p-1 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-zuppie-pink-500 relative">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <span class="absolute top-0 right-0 h-2.5 w-2.5 rounded-full bg-zuppie-pink-500 ring-2 ring-white"></span>
        </button>

        <!-- User Dropdown -->
        <div class="relative">
          <div>
            <button @click="userDropdownOpen = !userDropdownOpen" 
                    type="button" 
                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-zuppie-pink-500" 
                    id="user-menu-button">
              <span class="sr-only">Open user menu</span>
              <div class="h-8 w-8 rounded-full bg-gradient-to-r from-zuppie-pink-500 to-zuppie-500 flex items-center justify-center text-white font-medium">A</div>
              <span class="ml-2 text-gray-700 text-sm font-medium hidden lg:inline">Admin</span>
              <svg class="ml-1 h-4 w-4 text-gray-500 transition-transform duration-200" :class="{ 'transform rotate-180': userDropdownOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
          </div>

          <!-- Dropdown Menu -->
          <div x-show="userDropdownOpen" 
               x-transition:enter="transition ease-out duration-100"
               x-transition:enter-start="transform opacity-0 scale-95"
               x-transition:enter-end="transform opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-75"
               x-transition:leave-start="transform opacity-100 scale-100"
               x-transition:leave-end="transform opacity-0 scale-95"
               @click.away="userDropdownOpen = false" 
               class="origin-top-right absolute right-0 mt-2 w-56 rounded-lg shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
            <div class="px-4 py-3 border-b border-gray-100">
              <p class="text-sm font-medium text-gray-900">Admin User</p>
              <p class="text-xs text-gray-500 truncate">admin@example.com</p>
            </div>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-zuppie-pink-50 hover:text-zuppie-pink-700 transition-colors duration-150">
              <svg class="w-5 h-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              Your Profile
            </a>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-zuppie-pink-50 hover:text-zuppie-pink-700 transition-colors duration-150">
              <svg class="w-5 h-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              Settings
            </a>
            <div class="border-t border-gray-100"></div>
            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-zuppie-pink-50 hover:text-zuppie-pink-700 transition-colors duration-150">
              <svg class="w-5 h-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              Sign Out
            </a>
          </div>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="flex items-center md:hidden">
        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                type="button" 
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-zuppie-pink-100 focus:outline-none focus:ring-2 focus:ring-zuppie-pink-500"
                :aria-expanded="mobileMenuOpen">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div class="md:hidden bg-gradient-to-r from-zuppie-pink-50 to-zuppie-50" 
       x-show="mobileMenuOpen"
       x-transition:enter="transition ease-out duration-100"
       x-transition:enter-start="transform opacity-0 scale-95"
       x-transition:enter-end="transform opacity-100 scale-100"
       x-transition:leave="transition ease-in duration-75"
       x-transition:leave-start="transform opacity-100 scale-100"
       x-transition:leave-end="transform opacity-0 scale-95">
    
    <div class="pt-4 pb-3 border-t border-gray-200">
      <div class="flex items-center px-4">
        <div class="flex-shrink-0">
          <div class="h-10 w-10 rounded-full bg-gradient-to-r from-zuppie-pink-500 to-zuppie-500 flex items-center justify-center text-white font-medium">A</div>
        </div>
        <div class="ml-3">
          <div class="text-base font-medium text-gray-800">Admin User</div>
          <div class="text-sm font-medium text-gray-500">admin@example.com</div>
        </div>
      </div>
      <div class="mt-3 space-y-1">
        <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-zuppie-pink-100 flex items-center">
          <svg class="h-5 w-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          Your Profile
        </a>
        <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-zuppie-pink-100 flex items-center">
          <svg class="h-5 w-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
        <a href="#" class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-zuppie-pink-100 flex items-center">
          <svg class="h-5 w-5 mr-2 text-zuppie-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          Sign Out
        </a>
      </div>
    </div>
  </div>
</header>