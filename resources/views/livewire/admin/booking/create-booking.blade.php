<div
    class="fixed inset-0 backdrop-blur-sm bg-black/30 transition-opacity duration-300 flex items-center justify-center z-50 p-4 ">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-4xl">
        <!-- Gradient Header -->
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 p-6 text-white">
            <h2 class="text-2xl font-bold text-center">Create New Booking</h2>
            <p class="mt-1 text-center text-purple-100 text-sm">Fill in the details to create a new booking</p>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            @if (session('message'))
                <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 rounded text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Customer Information Section -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-purple-800 border-b border-purple-200 pb-2 mb-3">
                        Customer Information
                    </h3>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Full Name</label>
                    <input type="text" wire:model="name"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    @error('name')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Email</label>
                    <input type="email" wire:model="email"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    @error('email')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Phone Number</label>
                    <input type="text" wire:model="phone_no"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    @error('phone_no')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Spacer -->
                <div class="md:col-span-2 h-4"></div>

                <!-- Event Details Section -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold text-purple-800 border-b border-purple-200 pb-2 mb-3">
                        Event Details
                    </h3>
                </div>

                <!-- Package -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Event Package</label>
                    <select wire:model="event_package_id" wire:change="calculateTotal"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                        <option value="">Select Package</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }} - ₹{{ number_format($package->price, 2) }}</option>
                        @endforeach
                    </select>
                    @error('event_package_id')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Guest Count -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Number of Guests</label>
                    <input type="number" wire:model="guest_count" min="1" wire:change="calculateTotal"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    @error('guest_count')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Event Date -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Event Date</label>
                    <div class="flex gap-2">
                        <input type="date" wire:model="event_date_date"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                        <input type="text" wire:model="event_date_time" placeholder="hh:mm AM/PM"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    </div>
                    @error('event_date_date')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                    @error('event_date_time')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Event End Date -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Event End Date</label>
                    <div class="flex gap-2">
                        <input type="date" wire:model="event_end_date_date"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                        <input type="text" wire:model="event_end_date_time" placeholder="hh:mm AM/PM"
                            class="flex-1 px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    </div>
                    @error('event_end_date_date')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                    @error('event_end_date_time')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>


                <!-- PIN Code -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">PIN Code</label>
                    <input type="text" wire:model.live.debounce.500ms="pin_code" maxlength="6"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm">
                    @error('pin_code')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Total Price -->
                <div>
                    <label class="block text-sm font-medium text-purple-700 mb-1">Total Price</label>
                    <div
                        class="px-3 py-1.5 bg-purple-50 rounded-lg border border-purple-200 text-purple-800 font-medium text-sm">
                        ₹{{ number_format($total_price, 2) }}
                    </div>
                </div>

                <!-- Location -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-purple-700 mb-1">Event Location</label>
                    <input type="text" wire:model="location"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm"
                        placeholder="Enter event location">
                    @error('location')
                        <span class="text-xs text-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Special Requests -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-purple-700 mb-1">Special Requests</label>
                    <textarea wire:model="special_requests" rows="2"
                        class="w-full px-3 py-1.5 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition text-sm"></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="md:col-span-2 pt-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                    <button type="button" wire:click="$dispatch('closeModal')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow transition text-sm">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-medium rounded-lg shadow transition text-sm">
                        Create Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.addEventListener('phoneNumberExists', event => {
        alert(event.detail.message);
    });
</script>