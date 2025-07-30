<div class="min-h-screen bg-gradient-to-br from-slate-100 via-zuppie-50 to-zuppie-pink-50">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-zuppie-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-zuppie-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-info-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Header with Glass Effect -->
        <div class="mb-8">
            <div class="bg-white/70 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                <div class="bg-gradient-to-r from-zuppie-600 via-zuppie-pink-600 to-info-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-white flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block">Website Settings</span>
                                    <span class="text-zuppie-100 text-lg font-normal">Configure your brand identity</span>
                                </div>
                            </h1>
                        </div>
                        <div class="hidden md:flex items-center space-x-4">
                            <div class="text-right text-white/80">
                                <div class="text-sm">Last Updated</div>
                                <div class="text-lg font-semibold">{{ now()->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('message'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                 x-init="setTimeout(() => show = false, 5000)"
                 class="mb-6 bg-green-50/90 backdrop-blur-sm border border-green-200 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-green-800 font-semibold">Success!</h3>
                        <p class="text-green-700">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                 x-init="setTimeout(() => show = false, 5000)"
                 class="mb-6 bg-red-50/90 backdrop-blur-sm border border-red-200 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-red-800 font-semibold">Error!</h3>
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form wire:submit="save" class="space-y-8">
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Logo Section - Enhanced -->
                <div class="lg:col-span-1">
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden h-fit">
                        <div class="bg-gradient-to-r from-info-500 to-zuppie-600 px-6 py-5">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                Brand Logo
                            </h2>
                            <p class="text-info-100 text-sm mt-1">Upload your brand identity</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Current Logo Display -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Current Logo</label>
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 text-center border-2 border-dashed border-gray-200">
                                    <img src="{{ $current_logo }}" 
                                         alt="Current Logo" 
                                         class="h-20 w-auto mx-auto object-contain bg-white rounded-xl shadow-md border-2 border-white p-2">
                                </div>
                            </div>

                            <!-- Logo Upload -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Upload New Logo</label>
                                <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-xl hover:border-zuppie-400 transition-all duration-300 bg-gradient-to-br from-zuppie-50 to-zuppie-pink-50 hover:from-zuppie-100 hover:to-zuppie-pink-100">
                                    <div class="space-y-4 text-center">
                                        @if ($preview_logo)
                                            <div class="mb-6">
                                                <img src="{{ $preview_logo }}" 
                                                     alt="Logo Preview" 
                                                     class="h-24 w-auto mx-auto object-contain bg-white rounded-xl shadow-lg border-2 border-white p-2">
                                                <button type="button" 
                                                        wire:click="removeLogoPreview"
                                                        class="mt-3 px-4 py-2 text-sm text-red-600 hover:text-white hover:bg-red-500 border border-red-300 hover:border-red-500 rounded-lg transition-all duration-200 font-medium">
                                                    Remove Preview
                                                </button>
                                            </div>
                                        @endif
                                        
                                        <div class="w-16 h-16 bg-gradient-to-br from-zuppie-500 to-zuppie-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-white" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="text-center">
                                            <label for="logo-upload" class="cursor-pointer">
                                                <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600 text-white rounded-xl font-semibold hover:from-zuppie-700 hover:to-zuppie-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    Choose File
                                                </span>
                                                <input id="logo-upload" 
                                                       wire:model="logo_file" 
                                                       type="file" 
                                                       accept="image/*"
                                                       class="sr-only">
                                            </label>
                                            <p class="text-xs text-gray-500 mt-2">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, SVG up to 2MB</p>
                                    </div>
                                </div>
                                @error('logo_file') 
                                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                @enderror
                            </div>

                            <!-- Logo Guidelines -->
                            <div class="bg-gradient-to-r from-info-50 to-zuppie-50 rounded-xl p-5 border border-info-100">
                                <h4 class="text-sm font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-info-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Logo Guidelines
                                </h4>
                                <ul class="text-sm text-gray-600 space-y-2">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Recommended: 200x200px minimum
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Transparent background preferred
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        High quality for best results
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Form Section - Enhanced -->
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 px-6 py-5">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                Business Information
                            </h2>
                            <p class="text-green-100 text-sm mt-1">Configure your business details and contact information</p>
                        </div>
                        
                        <div class="p-6 max-h-[calc(100vh-300px)] overflow-y-auto custom-scrollbar">
                            <div class="space-y-8">
                                
                                <!-- Basic Information Section -->
                                <div class="bg-gradient-to-r from-info-50 to-zuppie-50 rounded-xl p-6 border border-info-100">
                                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-info-500 to-zuppie-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        Basic Information
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Site Name -->
                                        <div class="lg:col-span-2">
                                            <label for="site_name" class="block text-sm font-bold text-gray-700 mb-3">
                                                Website Name <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                                    </svg>
                                                </div>
                                                <input type="text" 
                                                       id="site_name"
                                                       wire:model="site_name" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="Enter your website name">
                                            </div>
                                            @error('site_name') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <!-- Contact Information Section -->
                                <div class="bg-gradient-to-r from-green-50 to-info-50 rounded-xl p-6 border border-green-100">
                                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-info-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        Contact Information
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Email -->
                                        <div>
                                            <label for="email" class="block text-sm font-bold text-gray-700 mb-3">
                                                Email Address <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                    </svg>
                                                </div>
                                                <input type="email" 
                                                       id="email"
                                                       wire:model="email" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="contact@yoursite.com">
                                            </div>
                                            @error('email') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div>
                                            <label for="phone_no" class="block text-sm font-bold text-gray-700 mb-3">
                                                Phone Number <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                </div>
                                                <input type="text" 
                                                       id="phone_no"
                                                       wire:model="phone_no" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="+91 9876543210">
                                            </div>
                                            @error('phone_no') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                        <!-- Address -->
                                        <div class="lg:col-span-2">
                                            <label for="address" class="block text-sm font-bold text-gray-700 mb-3">
                                                Business Address <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute top-4 left-4 pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                                <textarea id="address"
                                                          wire:model="address" 
                                                          rows="4"
                                                          class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none bg-white shadow-sm"
                                                          placeholder="Enter your complete business address..."></textarea>
                                            </div>
                                            @error('address') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Media Section -->
                                <div class="bg-gradient-to-r from-zuppie-pink-50 to-zuppie-50 rounded-xl p-6 border border-zuppie-pink-100">
                                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-zuppie-pink-500 to-zuppie-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H9a1 1 0 010 2H7.771l.062-.245L8.17 12h.601zm1.416-3H10a1 1 0 110 2H9.187l.062-.245L9.586 9z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        Social Media Presence
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Instagram -->
                                        <div>
                                            <label for="instagram_link" class="block text-sm font-bold text-gray-700 mb-3">
                                                Instagram Profile
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-zuppie-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                    </svg>
                                                </div>
                                                <input type="url" 
                                                       id="instagram_link"
                                                       wire:model="instagram_link" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-zuppie-pink-500 focus:border-zuppie-pink-500 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="https://instagram.com/yourhandle">
                                            </div>
                                            @error('instagram_link') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                        <!-- Facebook -->
                                        <div>
                                            <label for="facebook_link" class="block text-sm font-bold text-gray-700 mb-3">
                                                Facebook Page
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-info-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                    </svg>
                                                </div>
                                                <input type="url" 
                                                       id="facebook_link"
                                                       wire:model="facebook_link" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-info-500 focus:border-info-500 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="https://facebook.com/yourpage">
                                            </div>
                                            @error('facebook_link') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                        <!-- Twitter -->
                                        <div>
                                            <label for="twitter_link" class="block text-sm font-bold text-gray-700 mb-3">
                                                Twitter Profile
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-info-400" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                                    </svg>
                                                </div>
                                                <input type="url" 
                                                       id="twitter_link"
                                                       wire:model="twitter_link" 
                                                       class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-info-400 focus:border-info-400 transition-all duration-200 text-base bg-white shadow-sm"
                                                       placeholder="https://twitter.com/yourhandle">
                                            </div>
                                            @error('twitter_link') 
                                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p> 
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-center">
                <button type="submit" 
                        class="group relative inline-flex items-center px-12 py-4 bg-gradient-to-r from-zuppie-600 via-zuppie-pink-600 to-info-600 text-white text-lg font-bold rounded-2xl hover:from-zuppie-700 hover:via-zuppie-pink-700 hover:to-info-700 focus:outline-none focus:ring-4 focus:ring-zuppie-300 shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span wire:loading.remove>Save Settings</span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Saving...
                    </span>
                    <div class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>

        </form>
    </div>

    <!-- Enhanced Custom Styles -->
    <style>
        /* Animated blobs */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Glass effect enhancements */
        .backdrop-blur-lg {
            backdrop-filter: blur(16px);
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(243, 244, 246, 0.5);
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #8B5CF6, #EC4899);
            border-radius: 8px;
            border: 2px solid rgba(243, 244, 246, 0.5);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #7C3AED, #DB2777);
        }

        /* Enhanced input focus effects */
        input:focus, textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Button hover effects */
        button:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #8B5CF6, #EC4899, #3B82F6);
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Custom file upload styling */
        input[type="file"]::-webkit-file-upload-button {
            visibility: hidden;
        }

        input[type="file"]::before {
            content: 'Select Logo';
            display: inline-block;
            background: linear-gradient(to right, #8B5CF6, #EC4899);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="file"]:hover::before {
            background: linear-gradient(to right, #7C3AED, #DB2777);
        }

        /* Loading animation */
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8B5CF6, #EC4899);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #7C3AED, #DB2777);
        }
    </style>
</div>
                                               