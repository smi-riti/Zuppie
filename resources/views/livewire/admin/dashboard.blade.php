<div class="p-6 bg-gradient-to-br from-zuppie-50 to-zuppie-pink-50 min-h-screen">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Upcoming Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-zuppie-pink-400 hover:shadow-md transition">
            <div class="text-3xl font-bold text-zuppie-700">24</div>
            <div class="text-sm text-zuppie-500">Upcoming Events</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-zuppie-pink-300 to-zuppie-300 rounded-full"></div>
        </div>

        <!-- Birthdays Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-zuppie-400 hover:shadow-md transition">
            <div class="text-3xl font-bold text-zuppie-700">18</div>
            <div class="text-sm text-zuppie-500">Birthdays</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-zuppie-300 to-zuppie-pink-300 rounded-full"></div>
        </div>

        <!-- Baby Showers Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-zuppie-pink-300 hover:shadow-md transition">
            <div class="text-3xl font-bold text-zuppie-700">6</div>
            <div class="text-sm text-zuppie-500">Baby Showers</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-zuppie-pink-200 to-zuppie-200 rounded-full"></div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-t-4 border-zuppie-300 hover:shadow-md transition">
            <div class="text-3xl font-bold text-zuppie-700">$12,450</div>
            <div class="text-sm text-zuppie-500">Revenue</div>
            <div class="mt-2 h-1 bg-gradient-to-r from-zuppie-200 to-zuppie-pink-200 rounded-full"></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Events (2/3 width) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
            <div class="flex justify-between items-center border-b border-zuppie-100 pb-4 mb-6">
                <h2 class="text-lg font-semibold text-zuppie-800">Upcoming Events</h2>
                <!-- Removed "View All" button since we have pagination -->
            </div>

            <div class="space-y-4">
                @foreach ($upComingBookings as $booking)
                    <div
                        class="flex items-center py-3 border-b border-zuppie-100 hover:bg-zuppie-50 transition rounded-lg px-2">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($booking->eventPackage->name, 0, 1) }}
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold text-zuppie-800">{{ $booking->eventPackage->name }}</div>
                            <div class="text-xs text-zuppie-500">
                                {{ $booking->event_date->format('M d, Y') }} •
                                {{ $booking->guest_count ?? 'N/A' }} Guests
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="w-8 h-8 rounded-full bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition">✏️</button>
                            <button
                                class="w-8 h-8 rounded-full bg-zuppie-pink-100 flex items-center justify-center text-zuppie-pink-600 hover:bg-zuppie-pink-200 transition">🗑️</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $upComingBookings->links() }}
            </div>
        </div>

        <!-- Right Column (1/3 width) -->
        <div class="space-y-6">
            <!-- Calendar -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-zuppie-800">June 2023</h2>
                    <div class="flex space-x-2">
                        <button
                            class="w-8 h-8 rounded-full bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition">←</button>
                        <button
                            class="w-8 h-8 rounded-full bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition">→</button>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-sm font-medium text-zuppie-700">Upcoming Events</div>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center">
                    <!-- Day headers -->
                    <div class="text-xs text-zuppie-500 py-1">Sun</div>
                    <div class="text-xs text-zuppie-500 py-1">Mon</div>
                    <div class="text-xs text-zuppie-500 py-1">Tue</div>
                    <div class="text-xs text-zuppie-500 py-1">Wed</div>
                    <div class="text-xs text-zuppie-500 py-1">Thu</div>
                    <div class="text-xs text-zuppie-500 py-1">Fri</div>
                    <div class="text-xs text-zuppie-500 py-1">Sat</div>

                    <!-- Calendar days -->
                    <div class="py-1 text-sm text-zuppie-400">28</div>
                    <div class="py-1 text-sm text-zuppie-400">29</div>
                    <div class="py-1 text-sm text-zuppie-400">30</div>
                    <div class="py-1 text-sm text-zuppie-400">31</div>
                    <div class="py-1 text-sm text-zuppie-700">1</div>
                    <div class="py-1 text-sm text-zuppie-700">2</div>
                    <div class="py-1 text-sm text-zuppie-700">3</div>

                    <div class="py-1 text-sm text-zuppie-700">4</div>
                    <div class="py-1 text-sm text-zuppie-700">5</div>
                    <div class="py-1 text-sm text-zuppie-700">6</div>
                    <div class="py-1 text-sm text-zuppie-700">7</div>
                    <div class="py-1 text-sm text-zuppie-700">8</div>
                    <div class="py-1 text-sm text-zuppie-700">9</div>
                    <div class="py-1 text-sm text-zuppie-700">10</div>

                    <div class="py-1 text-sm text-zuppie-700">11</div>
                    <div class="py-1 text-sm text-zuppie-700">12</div>
                    <div class="py-1 text-sm text-zuppie-700">13</div>
                    <div class="py-1 text-sm text-zuppie-700">14</div>
                    <div
                        class="py-1 text-sm bg-zuppie-pink-500 text-white rounded-md font-medium cursor-pointer hover:bg-zuppie-pink-600 transition">
                        15</div>
                    <div class="py-1 text-sm text-zuppie-700">16</div>
                    <div class="py-1 text-sm text-zuppie-700">17</div>

                    <div
                        class="py-1 text-sm bg-zuppie-pink-500 text-white rounded-md font-medium cursor-pointer hover:bg-zuppie-pink-600 transition">
                        18</div>
                    <div class="py-1 text-sm text-zuppie-700">19</div>
                    <div
                        class="py-1 text-sm bg-zuppie-pink-500 text-white rounded-md font-medium cursor-pointer hover:bg-zuppie-pink-600 transition">
                        20</div>
                    <div class="py-1 text-sm text-zuppie-700">21</div>
                    <div
                        class="py-1 text-sm bg-zuppie-pink-500 text-white rounded-md font-medium cursor-pointer hover:bg-zuppie-pink-600 transition">
                        22</div>
                    <div class="py-1 text-sm text-zuppie-700">23</div>
                    <div class="py-1 text-sm text-zuppie-700">24</div>

                    <div
                        class="py-1 text-sm border-2 border-zuppie-500 rounded-md font-medium cursor-pointer hover:bg-zuppie-50 transition">
                        25</div>
                    <div class="py-1 text-sm text-zuppie-700">26</div>
                    <div class="py-1 text-sm text-zuppie-700">27</div>
                    <div class="py-1 text-sm text-zuppie-700">28</div>
                    <div class="py-1 text-sm text-zuppie-700">29</div>
                    <div class="py-1 text-sm text-zuppie-700">30</div>
                    <div class="py-1 text-sm text-zuppie-400">1</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-zuppie-800 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-3">
                    <button
                        class="bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white py-2 px-3 rounded-md text-sm font-medium hover:opacity-90 transition shadow-md hover:shadow-lg">
                        + New Event
                    </button>
                    <button
                        class="bg-white border border-zuppie-200 text-zuppie-700 py-2 px-3 rounded-md text-sm font-medium hover:bg-zuppie-50 transition">
                        Add Client
                    </button>
                    <button
                        class="bg-white border border-zuppie-200 text-zuppie-700 py-2 px-3 rounded-md text-sm font-medium hover:bg-zuppie-50 transition">
                        Inventory Check
                    </button>
                    <button
                        class="bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white py-2 px-3 rounded-md text-sm font-medium hover:opacity-90 transition shadow-md hover:shadow-lg">
                        Send Reminders
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>