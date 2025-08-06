<div class="p-6 bg-gradient-to-br from-purple-50 to-pink-50 min-h-screen">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Upcoming Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-pink-400 hover:shadow-md transition">
            <div class="text-3xl font-bold text-purple-700">24</div>
            <div class="text-sm text-purple-500">Upcoming Events</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full"></div>
        </div>

        <!-- Birthdays Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-purple-400 hover:shadow-md transition">
            <div class="text-3xl font-bold text-purple-700">18</div>
            <div class="text-sm text-purple-500">Birthdays</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full"></div>
        </div>

        <!-- Baby Showers Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-pink-300 hover:shadow-md transition">
            <div class="text-3xl font-bold text-purple-700">6</div>
            <div class="text-sm text-purple-500">Baby Showers</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-pink-200 to-purple-200 rounded-full"></div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-purple-300 hover:shadow-md transition">
            <div class="text-3xl font-bold text-purple-700"> ₹ {{ number_format($totalRevenue, 2, '.', ',') }}</div>
            <div class="text-sm text-purple-500">Total Revenue</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-purple-200 to-pink-200 rounded-full"></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Events (2/3 width) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
            <div class="flex justify-between items-center border-b border-purple-100 pb-4 mb-6">
                <h2 class="text-lg font-semibold text-purple-800">Upcoming Events</h2>
                <!-- Removed "View All" button since we have pagination -->
            </div>

            <div class="space-y-4">
                @foreach ($upComingBookings as $booking)
                    <div
                        class="flex items-center py-3 border-b border-purple-100 hover:bg-purple-50 transition rounded-lg px-2">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($booking->eventPackage->name, 0, 1) }}
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold text-purple-800">{{ $booking->eventPackage->name }}</div>
                            <div class="text-xs text-purple-500">
                                {{ $booking->event_date->format('M d, Y') }} •
                                {{ $booking->guest_count ?? 'N/A' }} Guests
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class=" rounded bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition px-2 text-lg py-1 font-semibold  ">View</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $upComingBookings->links() }}
            </div>
        </div>

        <div class="space-y-6">
            <!-- Calendar -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition" id="admin-calendar">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-purple-800" id="calendar-month-year">
                        {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                    </h2>
                    <div class="flex space-x-2">
                        <button wire:click="goToPreviousMonth"
                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">←</button>
                        <button wire:click="goToNextMonth"
                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">→</button>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-sm font-medium text-purple-700">
                            @if($selectedDate)
                                Events on {{ $selectedDate->format('M j, Y') }}
                            @else
                                Select a date to view events
                            @endif
                        </div>
                    </div>
                    @if($selectedDate)
                        @if($this->getEventsCountForSelectedDate() > 0)
                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full bg-pink-500 mr-2"></div>
                                    <span class="text-sm font-medium text-purple-800">Total Events</span>
                                </div>
                                <span
                                    class="text-lg font-bold text-purple-700">{{ $this->getEventsCountForSelectedDate() }}</span>
                            </div>
                        @else
                            <div class="p-3 bg-purple-50 rounded-lg text-center">
                                <span class="text-sm text-gray-500">No events found on this date</span>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center">
                    <!-- Day headers -->
                    <div class="text-xs text-purple-500 py-1">Sun</div>
                    <div class="text-xs text-purple-500 py-1">Mon</div>
                    <div class="text-xs text-purple-500 py-1">Tue</div>
                    <div class="text-xs text-purple-500 py-1">Wed</div>
                    <div class="text-xs text-purple-500 py-1">Thu</div>
                    <div class="text-xs text-purple-500 py-1">Fri</div>
                    <div class="text-xs text-purple-500 py-1">Sat</div>

                    <!-- Calendar days -->
                    @php
                        $firstDay = \Carbon\Carbon::create($currentYear, $currentMonth, 1)->dayOfWeek;
                        $daysInMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1)->daysInMonth;
                        $daysInPrevMonth = \Carbon\Carbon::create($currentYear, $currentMonth - 1, 1)->daysInMonth;
                        $today = now();
                        $isCurrentMonth = ($currentMonth == $today->month && $currentYear == $today->year);
                    @endphp

                    <!-- Previous month days -->
                    @for ($i = $firstDay - 1; $i >= 0; $i--)
                        <div class="py-1 text-sm text-purple-400">{{ $daysInPrevMonth - $i }}</div>
                    @endfor

                    <!-- Current month days -->
                    @for ($i = 1; $i <= $daysInMonth; $i++)
                        @php
                            $dateKey = $currentYear . '-' . $currentMonth . '-' . $i;
                            $hasEvent = isset($calendarEvents[$dateKey]);
                            $isToday = $isCurrentMonth && $i == $today->day;
                        @endphp

                        @if($isToday)
                            <div wire:click="selectDate({{ $i }})"
                                class="py-1 text-sm border-2 border-purple-500 rounded-md font-medium cursor-pointer hover:bg-purple-50 transition">
                                {{ $i }}
                            </div>
                        @elseif($hasEvent)
                            <div wire:click="selectDate({{ $i }})"
                                class="py-1 text-sm bg-pink-500 text-white rounded-md font-medium cursor-pointer hover:bg-pink-600 transition">
                                {{ $i }}
                            </div>
                        @else
                            <div wire:click="selectDate({{ $i }})" class="py-1 text-sm text-purple-700 cursor-pointer">{{ $i }}
                            </div>
                        @endif
                    @endfor

                    <!-- Next month days -->
                    @php
                        $totalCells = $firstDay + $daysInMonth;
                        $remainingCells = $totalCells > 35 ? 42 - $totalCells : 35 - $totalCells;
                    @endphp

                    @for ($i = 1; $i <= $remainingCells; $i++)
                        <div class="py-1 text-sm text-purple-400">{{ $i }}</div>
                    @endfor
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-purple-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.event-packages.create') }}" wire:navigate
                        class="bg-gradient-to-r text-center from-purple-500 to-pink-500 text-white py-2 px-3 rounded-md text-sm font-medium hover:opacity-90 transition shadow-md hover:shadow-lg">
                        + New Package
                    </a>
                    <a href="{{ route('admin.booking.manage') }}" wire:navigate
                        class="bg-white border border-purple-200 text-purple-700 py-2 px-3 rounded-md text-sm font-medium hover:bg-purple-50 transition">
                        Add New Booking
                    </a>
                    <a href="{{ route('admin.enquiries.all') }}" wire:navigate
                        class="bg-white border border-purple-200 text-purple-700 py-2 px-3 rounded-md text-sm font-medium hover:bg-purple-50 transition">
                        Enquiry
                    </a>
                    <a href="{{ route('admin.reviews.show') }}" wire:navigate
                        class="bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 px-3 rounded-md text-sm font-medium hover:opacity-90 transition shadow-md hover:shadow-lg">
                        Reviews
                    </a>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        Livewire.on('show-event-details', (data) => {
            // You can implement a modal or other UI to show event details
            // For now, we'll just show an alert
            alert('Event ID: ' + data.bookingId);

            // In a real implementation, you might do something like:
            // const modal = new Modal(document.getElementById('event-modal'));
            // modal.show();
            // Livewire.dispatch('load-booking-details', { id: data.bookingId });
        });
    </script>
    @endscript
</div>