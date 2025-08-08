<div class="min-h-screen bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="flex items-center justify-center space-x-2 group">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-10 w-10 text-pink-600 group-hover:text-pink-700 transition" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span
                    class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-600 to-purple-600 group-hover:from-pink-700 group-hover:to-purple-700 transition">
                    Zuppie
                </span>
            </a>
            <h1 class="text-2xl font-bold text-gray-800 mt-4">Verify OTP</h1>
            <p class="text-gray-600">
                Enter the OTP sent to your email
            </p>
        </div>

        <!-- Verify Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Decoration -->
            <div class="h-2 bg-gradient-to-r from-pink-500 to-purple-600"></div>

            <div class="p-8">
                <p class="mb-4 text-center">For phone: <strong>{{ $phone_no }}</strong></p>
                
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($error)
                    <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                        {{ $error }}
                    </div>
                @endif
                
                <form wire:submit.prevent="verifyOtp" class="space-y-6">
                    <div>
                        <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">OTP Code</label>
                        <div class="relative">
                            <input wire:model="otp" id="otp" name="otp" type="text" maxlength="6" required autofocus
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 placeholder-gray-400 text-center tracking-widest"
                                placeholder="XXXXXX">
                            @error('otp')
                                <span class="absolute right-3 top-3.5 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            @enderror
                        </div>
                        @error('otp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white font-medium bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition transform hover:-translate-y-0.5">
                            Verify OTP
                            <svg wire:loading wire:target="verifyOtp" xmlns="http://www.w3.org/2000/svg"
                                class="animate-spin ml-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="px-8 py-4 bg-gray-50 text-center border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Didn't receive the code? 
                    <button wire:click="resendOtp" class="font-medium text-pink-600 hover:text-pink-500">Resend</button>
                </p>
            </div>
        </div>
    </div>
</div>