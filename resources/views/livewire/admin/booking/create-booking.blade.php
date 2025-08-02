<div
    class="fixed inset-0 backdrop-blur-sm bg-black/30 transition-opacity duration-300 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-3xl">
        <!-- Gradient Header -->
        <div class="bg-gradient-to-r from-zuppie-400 to-zuppie-pink-400 p-6 text-white">
            <h2 class="text-2xl font-bold text-center">Create New Booking</h2>
            <p class="mt-1 text-center text-zuppie-100 text-sm">Multi-step booking form (Admin)</p>
        </div>

        <div class="p-6">
            @if (session('message'))
                <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Stepper UI -->
            <div class="flex justify-between items-center mb-8">
                @foreach ([1 => 'Location', 2 => 'Event Details', 3 => 'Requirements', 4 => 'Your Info', 5 => 'Confirmation'] as $step => $label)
                    <div class="flex-1 flex flex-col items-center">
                        <div
                            class="w-10 h-10 flex items-center justify-center rounded-full font-bold text-lg
                            {{ $currentStep == $step ? 'bg-zuppie-600 text-white shadow-lg' : ($currentStep > $step ? 'bg-green-200 text-green-700' : 'bg-gray-200 text-gray-500') }}">
                            {{ $currentStep > $step ? '✓' : $step }}
                        </div>
                        <span
                            class="mt-2 text-xs font-medium {{ $currentStep == $step ? 'text-zuppie-600' : 'text-gray-500' }}">
                            {{ $label }}
                        </span>
                    </div>
                    @if ($step < 5)
                        <div class="flex-1 h-1 bg-gray-200 mx-2"></div>
                    @endif
                @endforeach
            </div>

            <!-- Step 1: Location -->
            @if ($currentStep === 1)
                <div class="mb-6 p-4 bg-info-50 rounded-2xl">
                    <h4 class="font-bold text-gray-800 mb-3 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-info-600 mr-2"></i>
                        Event Location
                    </h4>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">PIN Code</label>
                        <input type="text" wire:model.live="pin_code" maxlength="6" placeholder="6-digit PIN code"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">

                        @if (session('pin_message'))
                            <div class="mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('pin_message') }}
                            </div>
                        @endif

                        @if (session('pin_error'))
                            <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('pin_error') }}
                            </div>
                        @endif

                        @error('pin_code')
                            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow transition text-sm">
                            Cancel
                        </button>
                        <button type="button" wire:click="nextStep"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white font-medium rounded-lg shadow transition text-sm"
                            @if (!$pin_code || !$isPinCodeAvailable) disabled @endif>
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 2: Event Details -->
            @if ($currentStep === 2)
                <form wire:submit.prevent="nextStep" class="space-y-4">
                    <h3 class="text-lg font-semibold text-zuppie-800 border-b border-zuppie-200 pb-2 mb-3">
                        Event Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Package Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event Package</label>
                            <select wire:model="event_package_id" wire:change="calculateTotal"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                                <option value="">Select Package</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">
                                        {{ $package->name }} - ₹{{ number_format($package->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('event_package_id')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Guest Count -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                            <input type="number" wire:model="guest_count" min="1" wire:change="calculateTotal"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('guest_count')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Event Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                            <input type="date" wire:model="event_date_date" min="{{ date('Y-m-d') }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('event_date_date')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Event Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event Time</label>
                            <input type="time" wire:model="event_date_time"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('event_date_time')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event End Date</label>
                            <input type="date" wire:model="event_end_date_date" min="{{ $event_date_date }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('event_end_date_date')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Time -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                            <input type="time" wire:model="event_end_date_time"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('event_end_date_time')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow transition text-sm">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white font-medium rounded-lg shadow transition text-sm">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            @endif

            <!-- Step 3: Requirements -->
            @if ($currentStep === 3)
                <form wire:submit.prevent="nextStep" class="space-y-4">
                    <h3 class="text-lg font-semibold text-zuppie-800 border-b border-zuppie-200 pb-2 mb-3">
                        Event Requirements
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Special Requirements</label>
                        <textarea wire:model="special_requests" rows="4" placeholder="Any special requests, themes, or specific needs..."
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Additional Services Needed</label>
                        <div class="space-y-2">
                            @foreach (['Photography', 'Videography', 'Catering', 'Decoration', 'Music', 'Transportation'] as $service)
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model="additional_services" value="{{ $service }}"
                                        class="mr-2 rounded border-gray-300 text-zuppie-600 focus:ring-zuppie-500">
                                    <span>{{ $service }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow transition text-sm">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white font-medium rounded-lg shadow transition text-sm">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            @endif

            <!-- Step 4: Customer Information -->
            @if ($currentStep === 4)
                <form wire:submit.prevent="nextStep" class="space-y-4">
                    <h3 class="text-lg font-semibold text-zuppie-800 border-b border-zuppie-200 pb-2 mb-3">
                        Customer Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" wire:model="name"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('name')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('email')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" wire:model="phone_no"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                            @error('phone_no')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Secondary Phone</label>
                            <input type="tel" wire:model="secondary_phone"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Billing Address</label>
                        <textarea wire:model="billing_address" rows="2"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition text-sm"></textarea>
                        @error('billing_address')
                            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">Payment Method</label>
                        <div class="space-y-3">
                            <label
                                class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-zuppie-500 transition-all duration-300 bg-white">
                                <input type="radio" wire:model="payment_method" value="cash" class="mr-3">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                                        Cash Payment (20% Advance Required)
                                    </div>
                                    <div class="text-sm text-gray-600">20% advance via Razorpay, 80% cash on event day
                                    </div>
                                </div>
                            </label>

                            <label
                                class="flex items-center p-4 border border-gray-300 rounded-xl cursor-pointer hover:border-zuppie-500 transition-all duration-300 bg-white">
                                <input type="radio" wire:model="payment_method" value="online" class="mr-3">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-credit-card text-info-600 mr-2"></i>
                                        Online Payment
                                    </div>
                                    <div class="text-sm text-gray-600">Pay securely online via Razorpay</div>
                                    <div class="text-xs text-gray-500 mt-1">Supports UPI, Cards, Net Banking & Wallets
                                    </div>
                                </div>
                            </label>
                        </div>

                        @if ($payment_method === 'cash')
                            <div class="mt-4 p-3 bg-orange-50 rounded-lg border border-orange-200">
                                <p class="text-sm text-orange-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <strong>Cash Payment:</strong> 20% advance payment required online to confirm
                                    booking.
                                    Remaining 80% can be paid on event day.
                                </p>
                                <p class="text-xs text-orange-600 mt-1">
                                    Total Amount: ₹{{ number_format($total_price, 2) }} |
                                    Advance Required: ₹{{ number_format($total_price * 0.2, 2) }} |
                                    Balance on Event Day: ₹{{ number_format($total_price * 0.8, 2) }}
                                </p>
                            </div>
                        @elseif($payment_method === 'online')
                            <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                <p class="text-sm text-green-800">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    Secure online payment powered by Razorpay. Complete payment to confirm your booking
                                    instantly.
                                </p>
                            </div>
                        @endif


                        @error('payment_method')
                            <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" wire:click="previousStep"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow transition text-sm">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white font-medium rounded-lg shadow transition text-sm">
                            Next <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            @endif

            <!-- Step 5: Confirmation -->
            @if ($currentStep === 5)
                <div>
                    <h3 class="text-lg font-semibold text-zuppie-800 border-b border-zuppie-200 pb-2 mb-4">
                        Booking Confirmation
                    </h3>

                    <div class="bg-gray-50 rounded-xl p-4">
                        <label class="flex items-start">
                            <input type="checkbox" wire:model="acceptTerms"
                                class="mt-1 mr-3 @error('acceptTerms') border-red-500 @enderror">
                            <span class="text-sm text-gray-700">
                                I agree to the <a href="{{ route('terms-of-service') }}" target="_blank"
                                    class="text-zuppie-600 hover:underline font-medium">Terms &
                                    Conditions</a> and
                                <a href="{{ route('privacy-policy') }}" target="_blank"
                                    class="text-zuppie-600 hover:underline font-medium">Privacy
                                    Policy</a>.
                            </span>
                        </label>
                        @error('acceptTerms')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <button type="button" wire:click="previousStep"
                            class="bg-gray-200 text-gray-800 py-3 rounded-xl font-bold hover:bg-gray-300 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </button>
                        <button type="button" wire:click="saveBooking" wire:loading.attr="disabled" id="submit-button"
                            class="bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600 text-white py-3 rounded-xl font-bold hover:from-zuppie-700 hover:to-zuppie-pink-700 transition-all duration-300 disabled:opacity-50">
                            <span wire:loading.remove>
                                @if ($payment_method === 'online')
                                    <i class="fas fa-credit-card mr-2"></i> Pay Now
                                    ₹{{ number_format($total_price) }}
                                @else
                                    <i class="fas fa-check-circle mr-2"></i> Confirm Booking
                                @endif
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                @if ($payment_method === 'online')
                                    Initiating Payment...
                                @else
                                    Processing...
                                @endif
                            </span>
                        </button>
                    </div>
                </div>c 
        </div>
        @endif
    </div>
</div>
</div>

<!-- Razorpay Integration -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        // Fix for "childNodes" error - ensure elements exist before accessing
        const hideMessages = () => {
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
        };
        hideMessages();

        // Razorpay payment handler
        Livewire.on('initiate-razorpay-payment', (data) => {
            try {
                // Validate data
                if (!data || !data.order_id || !data.amount) {
                    throw new Error('Invalid payment data');
                }

                // Create options
                const options = {
                    key: '{{ config('services.razorpay.key_id') }}',
                    amount: data.amount,
                    currency: data.currency || 'INR',
                    name: data.name || '{{ config('app.name') }}',
                    description: data.description || 'Booking Payment',
                    order_id: data.order_id,
                    prefill: data.prefill || {},
                    theme: {
                        color: '#9333ea'
                    },
                    handler: function(response) {
                        Livewire.dispatch('complete-razorpay-payment', [
                            response.razorpay_payment_id,
                            response.razorpay_order_id,
                            response.razorpay_signature
                        ]);
                    },
                    modal: {
                        ondismiss: function() {
                            Livewire.dispatch('enable-submit-button');
                        }
                    }
                };

                // Initialize Razorpay
                const rzp = new Razorpay(options);

                rzp.on('payment.failed', function(response) {
                    console.error('Payment failed:', response.error);
                    Livewire.dispatch('payment-failed', {
                        error: response.error
                    });
                });

                rzp.open();

            } catch (error) {
                console.error('Razorpay initialization error:', error);
                Livewire.dispatch('enable-submit-button');
                alert('Payment initialization failed: ' + error.message);
            }
        });

        // Enable submit button when payment fails
        Livewire.on('enable-submit-button', () => {
            const button = document.getElementById('submit-button');
            if (button) {
                button.disabled = false;
            }
        });
    });
</script>
