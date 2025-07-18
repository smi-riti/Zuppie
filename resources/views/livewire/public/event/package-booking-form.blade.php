
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50 py-12 md:py-24">
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg" id="success-message">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg" id="error-message">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-blue-500 text-white px-6 py-4 rounded-xl shadow-lg" id="info-message">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    {{ session('info') }}
                </div>
            </div>
        </div>
    @endif
    @if(!$package)
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold text-gray-800">Package not found</h2>
            <a href="{{ route('event-packages') }}" class="mt-4 inline-block bg-purple-600 text-white px-6 py-3 rounded-lg">
                Back to Packages
            </a>
        </div>
    @else
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Booking Form (2/3 width) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Progress Steps -->
                        <div class="px-8 pt-8">
                            <div class="flex justify-between relative mb-8">
                                <!-- Progress line -->
                                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
                                <div class="absolute top-1/2 left-0 h-1 bg-purple-600 -translate-y-1/2 z-10 transition-all duration-500" 
                                     style="width: {{ ($currentStep / 4) * 100 }}%"></div>
                                
                                <!-- Steps -->
                                @foreach(['Event Details', 'Requirements', 'Your Info', 'Confirmation'] as $index => $step)
                                    <div class="relative z-20">
                                        <button class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300
                                            @if($currentStep > $index + 1) bg-green-100 text-green-600 border-2 border-green-500
                                            @elseif($currentStep === $index + 1) bg-purple-600 text-white border-2 border-purple-600 shadow-lg
                                            @else bg-white text-gray-500 border-2 border-gray-300 @endif">
                                            @if($currentStep > $index + 1)
                                                <i class="fas fa-check"></i>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </button>
                                        <span class="absolute top-full left-1/2 -translate-x-1/2 mt-2 text-sm font-medium 
                                            @if($currentStep === $index + 1) text-purple-600 @else text-gray-500 @endif">
                                            {{ $step }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Form Content -->
 <!-- Form Content -->
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <!-- Package Summary Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                                <p class="text-purple-100">{{ $package->category->name ?? 'Event Package' }}</p>
                            </div>
                            <div class="mt-4 md:mt-0 text-right">
                                <p class="text-sm text-purple-100">Total Price</p>
                                <p class="text-2xl font-bold">₹{{ number_format($this->totalPrice) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Event Details -->
                    @if($currentStep === 1)
                    <div class="p-6 animate-fade-in">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-calendar-day text-purple-600 mr-3"></i>
                            When & Where is Your Event?
                        </h3>
                        
                        <div class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
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
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        <i class="fas fa-calendar-check text-purple-600 mr-2"></i>
                                        Event End Date
                                    </label>
                                    <input type="date" 
                                           wire:model="eventEndDate"
                                           min="{{ $eventDate ?: date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('eventEndDate') border-red-500 @enderror">
                                    @error('eventEndDate') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    <p class="text-xs text-gray-500 mt-1">Leave blank if single day event</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>
                                    Event Venue/Location *
                                </label>
                                <textarea wire:model="location"
                                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('location') border-red-500 @enderror" 
                                          rows="3"
                                          placeholder="Enter complete venue address with pin code"></textarea>
                                @error('location') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-4">
                                <button wire:click="validateStep1" 
                                        class="w-full bg-purple-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-purple-700 transition-all duration-300">
                                    Continue to Requirements <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Step 2: Requirements -->
                    @if($currentStep === 2)
                    <div class="p-6 animate-fade-in">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-clipboard-list text-purple-600 mr-3"></i>
                            Event Requirements
                        </h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-users text-purple-600 mr-2"></i>
                                    Expected Guests 
                                </label>
                                <input type="number" 
                                       wire:model="guestCount"
                                       min="1"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('guestCount') border-red-500 @enderror"
                                       placeholder="Approximate number of guests">
                                @error('guestCount') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
                                    Special Requirements (Optional)
                                </label>
                                <textarea wire:model="specialRequests"
                                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" 
                                          rows="4" 
                                          placeholder="Any special requests, dietary requirements, or additional services..."></textarea>
                                @error('specialRequests') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <button wire:click="goToStep(1)" 
                                        class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i> Back
                                </button>
                                <button wire:click="validateStep2" 
                                        class="bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-all duration-300">
                                    Continue <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Step 3: Personal Info -->
                    @if($currentStep === 3)
                    <div class="p-6 animate-fade-in">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user-circle text-purple-600 mr-3"></i>
                            Your Information
                        </h3>
                        
                        @if($isLoggedIn)
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                <div class="flex items-center">
                                    <i class="fas fa-user-check text-green-500 mr-3 text-xl"></i>
                                    <div>
                                        <p class="font-semibold text-green-800">Welcome back, {{ $existingUser->name }}!</p>
                                        <p class="text-sm text-green-700">{{ $existingUser->email ?: $existingUser->phone_no }}</p>
                                        <p class="text-xs text-green-600 mt-1">Your booking details are pre-filled but can be edited below.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- User Details Form -->
                        <div class="space-y-6">
                            <!-- Info note -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                                    <div class="text-sm text-blue-700">
                                        <p class="font-medium">Booking Details</p>
                                        <p>These details are specifically for this booking and can be different from your account information.</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-user text-purple-600 mr-2"></i>
                                    Full Name (for booking) *
                                </label>
                                <input type="text" 
                                       wire:model="name"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('name') border-red-500 @enderror" 
                                       placeholder="Enter name for this booking">
                                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                <p class="text-sm text-gray-500 mt-1">This name will be used for the booking details</p>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        <i class="fas fa-phone text-purple-600 mr-2"></i>
                                        Phone Number (for booking) *
                                    </label>
                                    <input type="tel" 
                                           wire:model="phone"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('phone') border-red-500 @enderror" 
                                           placeholder="+91 98765 43210">
                                    @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    <p class="text-sm text-gray-500 mt-1">Contact number for this booking</p>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-2">
                                        <i class="fas fa-envelope text-purple-600 mr-2"></i>
                                        Email Address (Optional)
                                    </label>
                                    <input type="email" 
                                           wire:model="email"
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror" 
                                           placeholder="your@email.com (optional)">
                                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                    <p class="text-sm text-gray-500 mt-1">Email for booking confirmations (optional)</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <button wire:click="goToStep(2)" 
                                        class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i> Back
                                </button>
                                <button wire:click="validateStep3" 
                                        class="bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-all duration-300">
                                    Review Booking <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Step 4: Confirmation -->
                    @if($currentStep === 4)
                    <div class="p-6 animate-fade-in">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-clipboard-check text-purple-600 mr-3"></i>
                            Review Your Booking
                        </h3>
                        
                        <div class="space-y-6">
                            <!-- Booking Summary -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Booking Summary</h4>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Package:</span>
                                        <span class="font-medium">{{ $package->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Event Date:</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($eventDate)->format('D, M j, Y') }}</span>
                                    </div>
                                    @if($eventEndDate && $eventEndDate != $eventDate)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">End Date:</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($eventEndDate)->format('D, M j, Y') }}</span>
                                    </div>
                                    @endif
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Location:</span>
                                        <span class="font-medium text-right">{{ $location }}</span>
                                    </div>
                                    @if($guestCount)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Expected Guests:</span>
                                        <span class="font-medium">{{ $guestCount }}</span>
                                    </div>
                                    @endif
                                    @if($specialRequests)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Special Requests:</span>
                                        <span class="font-medium text-right">{{ $specialRequests }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Personal Info Summary -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Your Information</h4>
                                
                                <div class="space-y-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Name:</span>
                                        <span class="font-medium">{{ $name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Phone:</span>
                                        <span class="font-medium">{{ $phone }}</span>
                                    </div>
                                    @if($email)
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Email:</span>
                                        <span class="font-medium">{{ $email }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Payment Options -->
                            <div class="bg-purple-50 rounded-xl p-6">
                                <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Payment Method</h4>
                                
                                <div class="space-y-3">
                                    <label class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 transition-all duration-300 bg-white">
                                        <input type="radio" wire:model="paymentMethod" value="cash" class="mr-3" checked>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800">Cash Payment</div>
                                            <div class="text-sm text-gray-600">Pay on the day of event</div>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-blue-800">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Currently only cash payment is available. You can pay on the event day.
                                    </p>
                                </div>
                            </div>

                            <!-- Package Price Summary -->
                            <div class="bg-white border border-gray-200 rounded-xl p-6">
                                <h4 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2">Price Summary</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Package Price:</span>
                                        <span class="font-medium">₹{{ number_format($package->price) }}</span>
                                    </div>
                                    
                                    @if($package->discount_type && $package->price != $package->discounted_price)
                                    <div class="flex justify-between text-green-600">
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
                                    
                                    <div class="border-t border-gray-200 pt-3 mt-3">
                                        <div class="flex justify-between text-lg font-bold text-gray-800">
                                            <span>Total Amount:</span>
                                            <span class="text-purple-600">₹{{ number_format($this->totalPrice) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="bg-gray-50 rounded-xl p-4">
                                <label class="flex items-start">
                                    <input type="checkbox" wire:model="acceptTerms" class="mt-1 mr-3">
                                    <span class="text-sm text-gray-700">
                                        I agree to the <a href="#" class="text-purple-600 hover:underline">Terms & Conditions</a> and 
                                        <a href="#" class="text-purple-600 hover:underline">Privacy Policy</a>. I understand that my booking 
                                        is subject to availability and will be confirmed by the event organizer.
                                    </span>
                                </label>
                                @error('acceptTerms') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <button wire:click="goToStep(3)" 
                                        class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i> Back
                                </button>
                                <button wire:click="submitBooking" 
                                        wire:loading.attr="disabled"
                                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-xl font-bold hover:from-purple-700 hover:to-pink-700 transition-all duration-300 disabled:opacity-50">
                                    <span wire:loading.remove>
                                        <i class="fas fa-check-circle mr-2"></i> Confirm Booking
                                    </span>
                                    <span wire:loading>
                                        <i class="fas fa-spinner fa-spin mr-2"></i> Processing...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                    </div>
                </div>

                <!-- Package Details Sidebar (1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-xl sticky top-8">
                        <!-- Package Header -->
                        <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white rounded-t-3xl">
                            <h2 class="text-2xl font-bold">{{ $package->name }}</h2>
                            <p class="text-purple-100">{{ $package->category->name ?? 'Event Package' }}</p>
                        </div>

                        <!-- Package Image -->
                        @if($package->images->count() > 0)
                        <div class="p-6 border-b border-gray-200">
                            <img src="{{ $package->images->first()->image_url }}" 
                                 alt="{{ $package->name }}" 
                                 class="w-full h-48 object-cover rounded-lg">
                        </div>
                        @endif

                        <!-- Package Description -->
                        <div class="p-6">
                            <h3 class="font-bold text-gray-800 mb-3">Package Includes</h3>
                            <div class="prose text-gray-700">
                                {!! $package->description !!}
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="p-6 bg-gray-50 rounded-b-3xl">
                            <h3 class="font-bold text-gray-800 mb-3">Price Summary</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Base Price:</span>
                                    <span class="font-medium">₹{{ number_format($package->price) }}</span>
                                </div>
                                
                                @if($package->discount_type && $package->price != $package->discounted_price)
                                <div class="flex justify-between text-green-600">
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
                                
                                <div class="border-t border-gray-200 pt-2 mt-2">
                                    <div class="flex justify-between font-bold text-lg text-gray-800">
                                        <span>Total:</span>
                                        <span class="text-purple-600">₹{{ number_format($this->totalPrice) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
  
    <livewire:public.section.enquiry-form />
    <livewire:public.components.bottom-navigation />
    <!-- Custom Styles -->
    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- Auto-hide flash messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide flash messages after 5 seconds
            const messages = ['success-message', 'error-message', 'info-message'];
            messages.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    setTimeout(() => {
                        element.style.opacity = '0';
                        element.style.transform = 'translateX(400px)';
                        setTimeout(() => element.remove(), 300);
                    }, 5000);
                }
            });
        });
        
        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            Livewire.on('user-found', (event) => {
                console.log('User found:', event.message);
                // You can add additional UI feedback here
            });
            
            Livewire.on('user-not-found', () => {
                console.log('User not found');
                // You can add additional UI feedback here
            });
        });
    </script>
</div>