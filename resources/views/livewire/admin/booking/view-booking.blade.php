<div class="w-full min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 flex flex-col items-center py-10">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-5xl border border-purple-200">
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 p-8 text-white flex flex-col md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-bold text-center md:text-left">Booking Details</h2>
            <span class="mt-2 md:mt-0 text-purple-100 text-base">ID: {{ $booking->id }}</span>
<div class="fixed inset-0 backdrop-blur-sm bg-black/30 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-3xl">
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 p-6 text-white">
            <h2 class="text-2xl font-bold text-center">Booking Details</h2>
        </div>
        <div class="p-8 space-y-8">
            <!-- Booking details are shown below -->
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Customer Info</h3>
                    <div class="mb-2"><span class="font-medium">Name:</span> {{ $booking->booking_name }}</div>
                    <div class="mb-2"><span class="font-medium">Email:</span> {{ $booking->booking_email }}</div>
                    <div class="mb-2"><span class="font-medium">Phone:</span> {{ $booking->booking_phone_no }}</div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Event Info</h3>
                    <div class="mb-2"><span class="font-medium">Package:</span> {{ $booking->eventPackage->name ?? 'N/A' }}</div>
                    <div class="mb-2"><span class="font-medium">Category:</span> {{ $booking->eventPackage?->category?->name ?? 'N/A' }}</div>
                    <div class="mb-2"><span class="font-medium">Guests:</span> {{ $booking->guest_count }}</div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Event Dates</h3>
                    <div class="mb-2"><span class="font-medium">Start:</span> 
                        {{ $booking->event_date ? $booking->event_date->format('M d, Y h:i A') : 'Not set' }}
                    </div>
                    <div class="mb-2"><span class="font-medium">End:</span> 
                        {{ $booking->event_end_date ? $booking->event_end_date->format('M d, Y h:i A') : 'Not set' }}
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Location & PIN</h3>
                    <div class="mb-2"><span class="font-medium">Location:</span> {{ $booking->location }}</div>
                    <div class="mb-2"><span class="font-medium">PIN Code:</span> {{ $booking->pin_code }}</div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Payment</h3>
                    <div class="mb-2"><span class="font-medium">Total Price:</span> ₹{{ number_format($booking->total_price, 2) }}</div>
                    <div class="mb-2"><span class="font-medium">Advance Paid:</span> {{ $booking->advance_paid ? 'Yes' : 'No' }}</div>
                    <div class="mb-2"><span class="font-medium">Advance Amount:</span> ₹{{ number_format($booking->advance_amount, 2) }}</div>
                    <div class="mb-2"><span class="font-medium">Due Amount:</span> ₹{{ number_format($booking->due_amount, 2) }}</div>
                    <div class="mb-2"><span class="font-medium">Payment Method:</span> {{ $booking->payment_method ?? 'N/A' }}</div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Status & Requests</h3>
                    <div class="mb-2"><span class="font-medium">Status:</span> {{ ucfirst($booking->status) }}</div>
                    <div class="mb-2"><span class="font-medium">Completed:</span> {{ $booking->is_completed ? 'Yes' : 'No' }}</div>
                    <div class="mb-2"><span class="font-medium">Special Requests:</span> {{ $booking->special_requests ?? 'None' }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Booking Info</h3>
                    <div class="mb-2"><span class="font-medium">Booking ID:</span> {{ $booking->id }}</div>
                    <div class="mb-2"><span class="font-medium">User ID:</span> {{ $booking->user_id }}</div>
                </div>
            </div>
            
            <div class="flex justify-end pt-4">
                <button type="button" onclick="window.history.back()"
                        class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-lg shadow hover:from-purple-600 hover:to-pink-600 transition">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>