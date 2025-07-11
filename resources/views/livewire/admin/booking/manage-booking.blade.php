<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-4 sm:p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-purple-800">Manage Bookings</h1>
            <p class="text-purple-600">View and manage all event bookings</p>
        </div>

        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Search -->
            <div class="md:col-span-2">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search bookings..." 
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition"
                    >
                    <div class="absolute left-3 top-2.5 text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Status Filter -->
            
            <div>
                <select wire:model.live="statusFilter" class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <option value="">All Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <select wire:model.live="categoryFilter" class="w-full px-4 py-2 rounded-lg border border-purple-200 focus:ring-2 focus:ring-purple-300 focus:border-purple-400 transition">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-100">
                    <thead class="bg-purple-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Customer</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Event Details</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-purple-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-100">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-purple-50 transition">
                                <!-- Customer Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-purple-900">{{ $booking->user->name }}</div>
                                            <div class="text-sm text-purple-600">{{ $booking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Event Details Column -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-purple-900">{{ $booking->category->name }} - {{ $booking->eventPackage->name }}</div>
                                    <div class="text-sm text-purple-600">{{ $booking->location }}</div>
                                    <div class="text-xs text-purple-500 mt-1">{{ $booking->guest_count }} guests</div>
                                </td>

                                <!-- Date & Time Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-purple-900">{{ $booking->event_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-purple-600">{{ $booking->event_date->format('h:i A') }}</div>
                                </td>

                                <!-- Status Column -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                            'completed' => 'bg-purple-100 text-purple-800'
                                        ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>

                                <!-- Amount Column -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-900 font-medium">
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </td>

                                <!-- Actions Column -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-purple-600 hover:text-purple-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="text-pink-600 hover:text-pink-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-purple-600">
                                    No bookings found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div class="px-6 py-4 bg-purple-50 border-t border-purple-100">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>