<div>

    <div class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 transition-opacity" wire:click="closeViewModal"></div>

    <!-- Modal Container -->
    <div class=" fixed inset-0 z-50 flex items-center justify-center p-4" wire:click.stop>
        <div class="relative mx-auto w-full max-w-4xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all" wire:click.stop>
                <!-- Close button -->
                <button wire:click="closeViewModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-purple-600 transition-colors z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Booking Content Area -->
                <div class="p-6 md:p-8 space-y-6 max-h-[80vh] overflow-y-auto bg-gray-50 rounded-lg shadow-sm">
                    <!-- Main Booking Header -->
                    <div class="pb-4 border-b border-gray-200">
                        <h2 class="text-2xl font-2xl text-purple-800">Booking Summary</h2>
                        <div class="flex items-center mt-2">
                            <span class="px-3 py-1 text-sm font-medium rounded-full 
                {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                            <span class="ml-4 text-gray-600">Booking ID: #{{ $booking->id }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column - Booking & Event Details -->
                        <div class="space-y-6">
                            <!-- Booking Details Card -->
                            <div class="p-5 bg-white rounded-lg shadow">
                                <h4
                                    class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Booking Details
                                </h4>
                                <div class="mt-4 space-y-3">
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Event Date:</span>
                                        <span
                                            class="text-gray-800">{{ \Carbon\Carbon::parse($booking->event_date)->format('D, M j, Y') }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Event End Date:</span>
                                        <span
                                            class="text-gray-800">{{ \Carbon\Carbon::parse($booking->event_end_date)->format('D, M j, Y') }}</span>
                                    </div>
                                    @if(!empty($booking->guest_count))
                                        <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                            <span class="font-medium text-gray-600">Total Guests:</span>
                                            <span class="text-gray-800">{{ $booking->guest_count }}</span>
                                        </div>
                                    @endif
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Location:</span>
                                        <span class="text-gray-800">{{ $booking->location }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Pincode:</span>
                                        <span class="text-gray-800">{{ $booking->pin_code }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2">
                                        <span class="font-medium text-gray-600">Total Price:</span>
                                        <span
                                            class="text-xl font-2xl text-purple-700">₹{{ number_format($booking->total_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Event Details Card -->
                            <div class="p-5 bg-white rounded-lg shadow">
                                <h4
                                    class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                    Event Details
                                </h4>
                                <div class="mt-4 space-y-3">
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Package Name:</span>
                                        <span class="text-gray-800">{{ $booking->eventPackage->name }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Category:</span>
                                        <span class="text-gray-800">{{ $booking->eventPackage->category->name }}</span>
                                    </div>
                                     @if ($booking->eventPackage->duration)
                                    <div class="grid grid-cols-2 gap-4 py-2">
                                         <span class="font-medium text-gray-600">Duration:</span>
                                         <span class="text-gray-800"> {{ $booking->eventPackage->formatted_duration }}</span>
                                    </div>
                                @endif
                                    
                                       
                                </div>
                            </div>

                            <!-- Special Requests Card -->
                            @if($booking->special_request)
                                <div class="p-5 bg-white rounded-lg shadow">
                                    <h4
                                        class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                                            </path>
                                        </svg>
                                        Special Requests
                                    </h4>
                                    <div class="mt-3 p-3 bg-gray-50 rounded text-gray-700">
                                        {{ $booking->special_request }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column - Customer Information -->
                        <div class="space-y-6">
                            <!-- Customer Information Card -->
                            <div class="p-5 bg-white rounded-lg shadow">
                                <h4
                                    class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Customer Information
                                </h4>
                                <div class="mt-4 space-y-3">
                                    <div class="flex items-center py-3 border-b border-gray-100">
                                        <div
                                            class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-2xl">
                                            {{ substr($booking->booking_name, 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <h5 class="font-2xl text-gray-800">{{ $booking->booking_name }}</h5>
                                            <p class="text-sm text-gray-600">{{ $booking->booking_email }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2 border-b border-gray-100">
                                        <span class="font-medium text-gray-600">Phone:</span>
                                        <span class="text-gray-800">{{ $booking->booking_phone_no }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 py-2">
                                        <span class="font-medium text-gray-600">Contact Method:</span>
                                        <span class="text-gray-800">Email & Phone</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Timeline Card -->
                            <div class="p-5 bg-white rounded-lg shadow">
                                <h4
                                    class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Booking Timeline
                                </h4>
                                <div class="mt-4 space-y-4">
                                    <div class="flex">
                                        <div class="flex flex-col items-center mr-4">
                                            <div class="w-3 h-3 rounded-full bg-purple-500 mt-1"></div>
                                            <div class="w-px h-full bg-gray-300"></div>
                                        </div>
                                        <div class="pb-4">
                                            <p class="text-sm font-medium text-gray-600">Booking Created</p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($booking->created_at)->format('M j, Y g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex flex-col items-center mr-4">
                                            <div class="w-3 h-3 rounded-full 
                                {{ $booking->status === 'confirmed' ? 'bg-green-500' : 'bg-gray-300' }} 
                                mt-1"></div>
                                            <div class="w-px h-full bg-gray-300"></div>
                                        </div>
                                        <div class="pb-4">
                                            <p class="text-sm font-medium text-gray-600">Confirmation</p>
                                            @if($booking->status === 'confirmed')
                                                <p class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->updated_at)->format('M j, Y g:i A') }}
                                                </p>
                                            @else
                                                <p class="text-xs text-gray-500">Pending</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex flex-col items-center mr-4">
                                            <div class="w-3 h-3 rounded-full 
                                {{ $booking->status === 'completed' ? 'bg-green-500' : 'bg-gray-300' }} 
                                mt-1"></div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Event Completion</p>
                                            @if($booking->status === 'completed')
                                                <p class="text-xs text-gray-500">Completed</p>
                                            @else
                                                <p class="text-xs text-gray-500">Upcoming</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions Card -->
                             @if ($booking->is_completed == 1)
                            <div class="p-5 bg-white rounded-lg shadow">
                                <h4 class="text-lg font-2xl text-purple-700 pb-2 border-b border-gray-200">Actions
                                </h4>
                                <div class="mt-4 flex flex-col space-y-3">
                                    @if ($booking->is_completed == 1)
                                        <h2 class="text-red-500 font-2xl">Download Invoice</h2>
                                    @endif

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button wire:click="closeViewModal"
                        class="px-4 py-2 text-gray-700 hover:text-purple-600 font-medium rounded-lg transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>