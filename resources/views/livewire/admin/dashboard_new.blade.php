<div class="p-4 lg:p-6 bg-gradient-to-br from-zuppie-50 to-zuppie-pink-50 min-h-screen">
    <!-- Flash Messages -->
    @if (session('message'))
        <div class="mb-6 mx-auto max-w-7xl">
            <div class="px-4 py-3 rounded-lg bg-green-50 text-green-700 font-medium border border-green-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8 max-w-7xl mx-auto">
        <!-- Upcoming Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-zuppie-pink-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl font-bold text-zuppie-700">{{ $upcomingEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-zuppie-500 font-medium">Upcoming Events</div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-zuppie-pink-100 to-zuppie-100">
                    <svg class="w-6 h-6 text-zuppie-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-zuppie-pink-300 to-zuppie-300 rounded-full"></div>
        </div>

        <!-- Past Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-zuppie-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl font-bold text-zuppie-700">{{ $pastEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-zuppie-500 font-medium">Past Events</div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-zuppie-100 to-zuppie-pink-100">
                    <svg class="w-6 h-6 text-zuppie-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-zuppie-300 to-zuppie-pink-300 rounded-full"></div>
        </div>

        <!-- Cancelled Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-red-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl font-bold text-zuppie-700">{{ $cancelledEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-zuppie-500 font-medium">Cancelled Events</div>
                </div>
                <div class="p-3 rounded-full bg-red-100">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-red-200 to-red-300 rounded-full"></div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-green-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xl lg:text-2xl font-bold text-zuppie-700">₹{{ number_format($totalRevenue, 0, '.', ',') }}</div>
                    <div class="text-xs lg:text-sm text-zuppie-500 font-medium">Total Revenue</div>
                </div>
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-green-200 to-green-300 rounded-full"></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
        <!-- Revenue Chart (2/3 width on large screens) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-zuppie-100 pb-4 mb-6">
                <div>
                    <h2 class="text-lg lg:text-xl font-semibold text-zuppie-800">Revenue Trend</h2>
                    <p class="text-sm text-zuppie-500 mt-1">Last 12 months performance</p>
                </div>
            </div>

            <!-- Revenue Chart Canvas -->
            <div class="relative h-64 lg:h-80">
                <canvas id="revenueChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Calendar -->
            <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow" id="admin-calendar">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-zuppie-800" id="calendar-month-year">
                        {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                    </h2>
                    <div class="flex space-x-2">
                        <button wire:click="goToPreviousMonth"
                            class="w-8 h-8 rounded-full bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition">←</button>
                        <button wire:click="goToNextMonth"
                            class="w-8 h-8 rounded-full bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition">→</button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center text-xs lg:text-sm">
                    <!-- Days of week header -->
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="p-2 font-semibold text-zuppie-600">{{ $day }}</div>
                    @endforeach

                    <!-- Calendar days -->
                    @php
                        $firstDay = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                        $startOfWeek = $firstDay->copy()->startOfWeek();
                        $endOfMonth = $firstDay->copy()->endOfMonth();
                        $endOfWeek = $endOfMonth->copy()->endOfWeek();
                        $currentDate = $startOfWeek->copy();
                    @endphp

                    @while($currentDate <= $endOfWeek)
                        @php
                            $isCurrentMonth = $currentDate->month == $currentMonth;
                            $isToday = $currentDate->isToday();
                            $hasEvents = isset($calendarEvents[$currentDate->format('Y-n-j')]);
                        @endphp
                        <div wire:click="selectDate({{ $currentDate->day }})"
                             class="p-2 rounded cursor-pointer transition-all hover:bg-zuppie-50
                                    {{ $isCurrentMonth ? 'text-zuppie-800' : 'text-zuppie-300' }}
                                    {{ $isToday ? 'bg-zuppie-pink-100 font-bold' : '' }}
                                    {{ $hasEvents && $isCurrentMonth ? 'bg-zuppie-100 font-semibold' : '' }}">
                            {{ $currentDate->day }}
                            @if($hasEvents && $isCurrentMonth)
                                <div class="w-1 h-1 bg-zuppie-pink-500 rounded-full mx-auto mt-1"></div>
                            @endif
                        </div>
                        @php $currentDate->addDay(); @endphp
                    @endwhile
                </div>

                @if($selectedDate)
                    <div class="mt-4 p-3 bg-zuppie-50 rounded-lg">
                        <p class="text-sm text-zuppie-700">
                            <strong>{{ $selectedDate->format('M d, Y') }}</strong><br>
                            {{ $this->getEventsCountForSelectedDate() }} events scheduled
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Latest Upcoming Events -->
    <div class="mt-8 bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-zuppie-100 pb-4 mb-6">
            <div>
                <h2 class="text-lg lg:text-xl font-semibold text-zuppie-800">Latest Upcoming Events</h2>
                <p class="text-sm text-zuppie-500 mt-1">Next {{ $perPage }} events scheduled</p>
            </div>
        </div>

        @if($upComingBookings->count() > 0)
            <div class="space-y-4">
                @foreach ($upComingBookings as $booking)
                    <div class="flex flex-col sm:flex-row items-start sm:items-center py-4 border-b border-zuppie-50 hover:bg-zuppie-25 transition rounded-lg px-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 flex items-center justify-center text-white font-bold mr-0 sm:mr-4 mb-3 sm:mb-0">
                            {{ substr($booking->eventPackage->name ?? 'Event', 0, 1) }}
                        </div>
                        <div class="flex-grow">
                            <div class="font-semibold text-zuppie-800 text-lg">{{ $booking->eventPackage->name ?? 'N/A' }}</div>
                            <div class="text-sm text-zuppie-500 mt-1">
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $booking->event_date->format('M d, Y') }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $booking->guest_count ?? 'N/A' }} Guests
                                </span>
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-3 sm:mt-0">
                            <button class="px-4 py-2 rounded-lg bg-zuppie-100 flex items-center justify-center text-zuppie-600 hover:bg-zuppie-200 transition font-medium text-sm">
                                View Details
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $upComingBookings->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-zuppie-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-zuppie-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-zuppie-700 mb-2">No Upcoming Events</h3>
                <p class="text-zuppie-500">There are no upcoming events scheduled at the moment.</p>
            </div>
        @endif
    </div>

    @script
    <script>
        // Chart.js Revenue Chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const monthlyData = @json($monthlyRevenueData);
            
            const months = monthlyData.map(item => item.month);
            const revenues = monthlyData.map(item => item.revenue);
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Revenue (₹)',
                        data: revenues,
                        borderColor: 'rgb(236, 72, 153)',
                        backgroundColor: 'rgba(236, 72, 153, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(236, 72, 153)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '₹' + value.toLocaleString();
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        });

        Livewire.on('show-event-details', (data) => {
            // Handle event details display
        });
    </script>
    @endscript

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</div>
