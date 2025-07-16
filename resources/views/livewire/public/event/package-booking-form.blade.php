<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50">
    @if(!$package)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Package not found</h2>
            <a href="{{ route('event-packages') }}" class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                Back to Packages
            </a>
        </div>
    @else
        <!-- Booking Form Section -->
        <section class="py-20">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-12">
                    
                    <!-- Booking Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-3xl shadow-xl p-8 animate-fade-in-right">
                            <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
                                <i class="fas fa-user-edit text-purple-600 mr-3"></i>
                                Your Information
                            </h2>
                            
                            @if(session('error'))
                                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if($userMessage)
                                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    {{ $userMessage }}
                                </div>
                            @endif

                            @if($isLoggedIn)
                                <div class="mb-6 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <i class="fas fa-user-check mr-2"></i>
                                            <strong>Logged in as:</strong> {{ $existingUser->name ?? 'User' }}
                                        </div>
                                        <span class="text-sm bg-blue-200 px-3 py-1 rounded-full">Account Verified</span>
                                    </div>
                                </div>
                            @endif
                            
                            <form wire:submit.prevent="submitBooking" class="space-y-6">
                                <!-- Personal Information -->
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-user text-purple-600 mr-2"></i>
                                            Full Name *
                                        </label>
                                        <input type="text" 
                                               wire:model="name"
                                               @if($isLoggedIn) readonly @endif
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('name') border-red-500 @enderror @if($isLoggedIn) bg-gray-50 @endif" 
                                               placeholder="Enter your full name">
                                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-envelope text-purple-600 mr-2"></i>
                                            Email Address
                                        </label>
                                        <input type="email" 
                                               wire:model="email"
                                               @if($isLoggedIn) readonly @endif
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror @if($isLoggedIn) bg-gray-50 @endif" 
                                               placeholder="Enter your email (optional)">
                                        @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        @if(!$isLoggedIn)
                                            <p class="text-xs text-gray-500 mt-1">If provided, we'll create an account and send password via email</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-phone text-purple-600 mr-2"></i>
                                            Phone Number *
                                        </label>
                                        <input type="tel" 
                                               wire:model="phone"
                                               @if($isLoggedIn) readonly @endif
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('phone') border-red-500 @enderror @if($isLoggedIn) bg-gray-50 @endif" 
                                               placeholder="+91 98765 43210">
                                        @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        @if(!$isLoggedIn)
                                            <p class="text-xs text-gray-500 mt-1">We'll check if you have an existing account and auto-fill your details</p>
                                        @endif
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-calendar text-purple-600 mr-2"></i>
                                            Event Date *
                                        </label>
                                        <input type="date" 
                                               wire:model="eventDate"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventDate') border-red-500 @enderror">
                                        @error('eventDate') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>
                                            Event End Date
                                        </label>
                                        <input type="date" 
                                               wire:model="eventEndDate"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventEndDate') border-red-500 @enderror">
                                        @error('eventEndDate') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        <p class="text-xs text-gray-500 mt-1">Leave blank if single day event</p>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-semibold mb-2">
                                            <i class="fas fa-users text-purple-600 mr-2"></i>
                                            Expected Guests (Optional)
                                        </label>
                                        <input type="number" 
                                               wire:model="guestCount"
                                               min="1"
                                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('guestCount') border-red-500 @enderror"
                                               placeholder="Number of guests (optional)">
                                        @error('guestCount') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Event Details -->
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>
                                        Event Venue/Location *
                                    </label>
                                    <textarea wire:model="location"
                                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('location') border-red-500 @enderror" 
                                              rows="3"
                                              placeholder="Enter complete venue address with pin code: {{ $pinCode }}"></textarea>
                                    @error('location') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Special Requirements -->
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        <i class="fas fa-comment text-purple-600 mr-2"></i>
                                        Special Requirements (Optional)
                                    </label>
                                    <textarea wire:model="specialRequests"
                                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" 
                                              rows="4" 
                                              placeholder="Any special requests, dietary requirements, or additional services... (optional)"></textarea>
                                    @error('specialRequests') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Payment Method -->
                                <div class="bg-gray-50 rounded-2xl p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-credit-card text-purple-600 mr-2"></i>
                                        Payment Method
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 gap-4">
                                        <label class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition-all duration-300 bg-white">
                                            <input type="radio" wire:model="paymentMethod" value="cash" class="mr-3" checked>
                                            <div class="flex-1">
                                                <div class="font-semibold text-gray-800">Cash Payment</div>
                                                <div class="text-sm text-gray-600">Pay on the day of event</div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            Currently only cash payment is available. You can pay on the event day.
                                        </p>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-6">
                                    <button type="submit" 
                                            wire:loading.attr="disabled"
                                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-4 rounded-2xl font-bold text-lg hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-300 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove>
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Confirm Booking
                                        </span>
                                        <span wire:loading>
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Processing Booking...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-3xl shadow-xl p-8 sticky top-24 animate-fade-in-left">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-receipt text-purple-600 mr-3"></i>
                                Order Summary
                            </h3>
                            
                            <!-- Package Info -->
                            <div class="border-b border-gray-200 pb-6 mb-6">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=100&h=100&fit=crop' }}" 
                                         alt="{{ $package->name }}" 
                                         class="w-16 h-16 rounded-xl object-cover">
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $package->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $package->category->name ?? 'Event Package' }}</p>
                                        @if($package->duration)
                                            <p class="text-sm text-purple-600">{{ $package->formatted_duration }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Price Breakdown -->
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Base Package</span>
                                    <span class="font-semibold">₹{{ number_format($package->price) }}</span>
                                </div>
                                
                                @if($package->discount_type && $package->price != $package->discounted_price)
                                    <div class="flex justify-between items-center text-green-600">
                                        <span>
                                            @if($package->discount_type === 'percentage')
                                                Discount ({{ $package->discount_value }}%)
                                            @else
                                                Discount
                                            @endif
                                        </span>
                                        <span>-₹{{ number_format($package->price - $package->discounted_price) }}</span>
                                    </div>
                                @endif
                                
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between items-center text-lg font-bold text-gray-800">
                                        <span>Total Amount</span>
                                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">₹{{ number_format($this->totalPrice) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Service Area -->
                            <div class="bg-green-50 rounded-2xl p-4 mb-6">
                                <h4 class="font-bold text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
                                    Service Area
                                </h4>
                                <p class="text-sm text-gray-700">Pin Code: {{ $pinCode }}</p>
                                <p class="text-xs text-green-600 mt-1">✓ Services available in your area</p>
                            </div>
                            
                            <!-- Features Included -->
                            <div class="bg-purple-50 rounded-2xl p-4">
                                <h4 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Included Services
                                </h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-700">Professional Event Planning</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-700">Complete Setup & Decoration</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-700">Photography & Videography</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-700">Catering Coordination</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-700">Entertainment Management</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Support -->
                            <div class="mt-6 text-center">
                                <p class="text-sm text-gray-600 mb-2">Need help?</p>
                                <a href="tel:+919876543210" 
                                   class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold">
                                    <i class="fas fa-phone mr-2"></i>
                                    Call +91 98765 43210
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Custom Styles -->
    <style>
        /* Custom Animations */
        .animate-fade-in-right {
            animation: fadeInRight 1s ease-in-out;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 1s ease-in-out;
        }

        @keyframes fadeInRight {
            0% { opacity: 0; transform: translateX(30px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInLeft {
            0% { opacity: 0; transform: translateX(-30px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        .pulse-green {
            animation: pulseGreen 2s infinite;
        }

        @keyframes pulseGreen {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('user-found', (event) => {
                // Add visual feedback when user is found
                const phoneInput = document.querySelector('input[wire\\:model="phone"]');
                const nameInput = document.querySelector('input[wire\\:model="name"]');
                const emailInput = document.querySelector('input[wire\\:model="email"]');
                
                if (phoneInput) {
                    phoneInput.classList.add('pulse-green');
                    setTimeout(() => {
                        phoneInput.classList.remove('pulse-green');
                    }, 3000);
                }
                
                // Show success message
                if (event.message) {
                    const successDiv = document.createElement('div');
                    successDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce';
                    successDiv.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${event.message}`;
                    document.body.appendChild(successDiv);
                    
                    setTimeout(() => {
                        successDiv.remove();
                    }, 5000);
                }
            });
            
            @this.on('user-not-found', () => {
                // Remove any existing messages
                const existingMessages = document.querySelectorAll('.fixed.top-4.right-4');
                existingMessages.forEach(msg => msg.remove());
            });
        });
    </script>
</div>

