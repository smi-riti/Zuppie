<div class="flex h-screen" x-data="{ mobileMenuOpen: false }">
  <!-- Mobile sidebar overlay -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" 
       @click="mobileMenuOpen = false"
       x-transition:enter="transition-opacity ease-linear duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity ease-linear duration-300"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
  </div>
  
  <!-- Sidebar - Desktop -->
  <div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-gradient-to-b from-pink-200 to-purple-200">
      <!-- Logo -->
      <div class="flex items-center h-16 px-4 border-b border-gray-200">
        <a href="/admin" class="flex items-center space-x-2 group">
          <div class="animate-pulse">
            <img src="/images/logo.jpeg" alt="Admin Logo" class="h-8 w-8 rounded-full">
          </div>
          <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600 group-hover:from-purple-700 group-hover:to-pink-700 transition">
            AdminPanel
          </span>
        </a>
      </div>
      
      <!-- Navigation -->
      <nav class="flex-1 px-2 py-4 space-y-1">
        <a href="/admin/dashboard" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 bg-white shadow-sm text-pink-700 border border-pink-200">
          <svg class="w-5 h-5 mr-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
          </svg>
          Dashboard
        </a>
        
        <a href="/admin/users" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 text-gray-700 hover:bg-white hover:text-pink-700 hover:shadow-sm">
          <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          Users
        </a>
        
        <a href="/admin/content" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 text-gray-700 hover:bg-white hover:text-pink-700 hover:shadow-sm">
          <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
          </svg>
          Content
        </a>
        
        <a href="/admin/products" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 text-gray-700 hover:bg-white hover:text-pink-700 hover:shadow-sm">
          <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          Products
        </a>
        
        <a href="/admin/orders" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 text-gray-700 hover:bg-white hover:text-pink-700 hover:shadow-sm">
          <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          Orders
        </a>
        
        <a href="/admin/settings" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group transition-all duration-200 text-gray-700 hover:bg-white hover:text-pink-700 hover:shadow-sm">
          <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
          Settings
        </a>
      </nav>
      
      <!-- Bottom Section -->
      <div class="px-2 py-4 border-t border-gray-200">
        <div class="flex items-center px-3 py-2">
          <div class="h-8 w-8 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center text-white font-medium">A</div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-700">Admin User</p>
            <p class="text-xs text-gray-500">admin@example.com</p>
          </div>
        </div>
        <div class="mt-3">
          <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-white hover:text-pink-700 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Sign out
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile sidebar -->
  <div x-show="mobileMenuOpen" 
       class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-pink-50 to-purple-50 shadow-lg md:hidden"
       x-transition:enter="transition ease-in-out duration-300 transform"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in-out duration-300 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full">
    <!-- Mobile sidebar content -->
    <div class="flex flex-col h-full">
      <div class="flex items-center h-16 px-4 border-b border-gray-200">
        <a href="/admin" class="flex items-center space-x-2">
          <img src="/images/logo.jpeg" alt="Admin Logo" class="h-8 w-8 rounded-full">
          <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600">
            AdminPanel
          </span>
        </a>
      </div>
      
      <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
        <a href="/admin/dashboard" class="flex items-center px-3 py-2 text-sm font-medium rounded-md group bg-white shadow-sm text-pink-700 border border-pink-200">
          <svg class="w-5 h-5 mr-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
          </svg>
          Dashboard
        </a>
        
        <!-- Repeat other navigation links as in desktop sidebar -->
      </nav>
      
      <div class="px-2 py-4 border-t border-gray-200">
        <div class="flex items-center px-3 py-2">
          <div class="h-8 w-8 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center text-white font-medium">A</div>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-700">Admin User</p>
            <p class="text-xs text-gray-500">admin@example.com</p>
          </div>
        </div>
        <div class="mt-3">
          <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-white hover:text-pink-700">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Sign out
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="flex-1 flex flex-col overflow-hidden">
    <!-- Mobile header -->
    <header class="md:hidden bg-gradient-to-r from-pink-50 to-purple-50 border-b border-gray-200">
      <div class="flex items-center justify-between px-4 py-3">
        <button @click="mobileMenuOpen = true" class="text-gray-500 hover:text-gray-700">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <a href="/admin" class="flex items-center space-x-2">
          <img src="/images/logo.jpeg" alt="Admin Logo" class="h-6 w-6 rounded-full">
          <span class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600">
            AdminPanel
          </span>
        </a>
        <div class="w-6"></div> <!-- Spacer for alignment -->
      </div>
    </header>
    
    <!-- Desktop header would go here -->
    
    <!-- Main content area -->
  
  </div>
</div>