<div class="min-h-screen bg-gradient-to-br from-pink-100 to-purple-100 py-24 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <!-- Decorative header with gradient -->
        <div class="bg-gradient-to-r from-pink-400 to-purple-500 p-6 text-center">
            <h1 class="text-3xl font-2xl text-white">Join Our Event Community</h1>
            <p class="mt-2 text-pink-100">
                @if(session('booking_step3_data'))
                    Complete your registration to continue with your booking
                @else
                    Register to book your next unforgettable experience
                @endif
            </p>
        </div>

        <div class="p-8">
            @if ($message)
                <div class="mb-6 p-3 rounded-lg {{ strpos($message, 'failed') !== false ? 'bg-red-100 border-l-4 border-red-500 text-red-700' : 'bg-green-100 border-l-4 border-green-500 text-green-700' }}">
                    {{ $message }}
                </div>
            @endif

            <form wire:submit.prevent="register" class="space-y-6">
                <!-- Name Field -->
                <div class="relative">
                    <label class="block text-sm font-medium text-purple-900 mb-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input wire:model="name" type="text" class="pl-10 block w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 placeholder-pink-300" placeholder="John Doe">
                    </div>
                    @error('name') <span class="text-pink-600 text-xs mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</span> @enderror
                </div>

                <!-- Email Field -->
                <div class="relative">
                    <label class="block text-sm font-medium text-purple-900 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input wire:model="email" type="email" class="pl-10 block w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 placeholder-pink-300" placeholder="your@email.com">
                    </div>
                    @error('email') <span class="text-pink-600 text-xs mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</span> @enderror
                </div>

                <!-- Password Field -->
                <div class="relative">
                    <label class="block text-sm font-medium text-purple-900 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input wire:model="password" type="password" class="pl-10 block w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 placeholder-pink-300" placeholder="••••••••">
                    </div>
                    @error('password') <span class="text-pink-600 text-xs mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="relative">
                    <label class="block text-sm font-medium text-purple-900 mb-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <input wire:model="password_confirmation" type="password" class="pl-10 block w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 placeholder-pink-300" placeholder="••••••••">
                    </div>
                    @error('password_confirmation') <span class="text-pink-600 text-xs mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</span> @enderror
                </div>

                <!-- Phone Number Field -->
                <div class="relative">
                    <label class="block text-sm font-medium text-purple-900 mb-1">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input wire:model="phone_no" type="text" class="pl-10 block w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 placeholder-pink-300" placeholder="+1 (555) 123-4567">
                    </div>
                    @error('phone_no') <span class="text-pink-600 text-xs mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all duration-300 transform hover:scale-105">
                        Create Account
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-purple-600">
                    Already have an account?
                    <a href="#" class="font-medium text-pink-600 hover:text-pink-500">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>