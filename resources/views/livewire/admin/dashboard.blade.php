<div class="p-4 lg:p-6 bg-gradient-to-br from-purple-50 to-pink-50 w-full">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <!-- Upcoming Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-pink-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl text-purple-700">{{ $upcomingEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-purple-500 font-medium">Upcoming Events</div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-pink-100 to-purple-100">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full"></div>
        </div>

        <!-- Past Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-purple-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl text-purple-700">{{ $pastEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-purple-500 font-medium">Past Events</div>
                </div>
                <div class="p-3 rounded-full bg-gradient-to-r from-purple-100 to-pink-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 h-1 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full"></div>
        </div>

        <!-- Cancelled Events Card -->
        <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 border-t-4 border-red-400 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl lg:text-3xl text-purple-700">{{ $cancelledEventsCount }}</div>
                    <div class="text-xs lg:text-sm text-purple-500 font-medium">Cancelled Events</div>
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
                    <div class="text-xl lg:text-2xl text-purple-700">₹{{ number_format($totalRevenue, 0, '.', ',') }}</div>
                    <div class="text-xs lg:text-sm text-purple-500 font-medium">Total Revenue</div>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Revenue Chart (2/3 width on large screens) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-purple-100 pb-4 mb-6">
                <div>
                    <h2 class="text-lg lg:text-xl text-purple-800">Revenue Trend</h2>
                    <p class="text-sm text-purple-500 mt-1">Last 12 months performance</p>
                </div>
            </div>

            <!-- Revenue Chart Canvas -->
            <div class="relative h-64 lg:h-80">
                <canvas id="revenueChart" class="w-full h-full"></canvas>
                <!-- Loading indicator -->
                <div id="chartLoading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-90 rounded-lg">
                    <div class="text-center">
                        <svg class="animate-spin h-8 w-8 text-purple-600 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-sm text-purple-600 font-medium">Loading chart...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <!-- Quick Links -->
            <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow">
                <h3 class="text-lg text-purple-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Quick Links
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.booking.manage') }}" class="flex items-center p-3 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors text-sm font-medium text-purple-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Bookings
                    </a>
                    <a href="{{ route('admin.categories') }}" class="flex items-center p-3 rounded-lg bg-pink-50 hover:bg-pink-100 transition-colors text-sm font-medium text-purple-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categories
                    </a>
                    <a href="{{ route('admin.offers.show') }}" class="flex items-center p-3 rounded-lg bg-green-50 hover:bg-green-100 transition-colors text-sm font-medium text-purple-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Offers
                    </a>
                    <a href="{{ route('admin.event-packages') }}" class="flex items-center p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors text-sm font-medium text-purple-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Packages
                    </a>
                </div>
            </div>
            
            <!-- Calendar -->
            <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow" id="admin-calendar">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg text-purple-800" id="calendar-month-year">
                        {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                    </h2>
                    <div class="flex space-x-2">
                        <button wire:click="goToPreviousMonth"
                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">←</button>
                        <button wire:click="goToNextMonth"
                            class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">→</button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center text-xs lg:text-sm">
                    <!-- Days of week header -->
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="p-2  text-purple-600">{{ $day }}</div>
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
                             class="p-2 rounded cursor-pointer transition-all hover:bg-purple-50
                                    {{ $isCurrentMonth ? 'text-purple-800' : 'text-purple-300' }}
                                    {{ $isToday ? 'bg-pink-100 font-2xl' : '' }}
                                    {{ $hasEvents && $isCurrentMonth ? 'bg-purple-100 font-2xl' : '' }}">
                            {{ $currentDate->day }}
                            @if($hasEvents && $isCurrentMonth)
                                <div class="w-1 h-1 bg-pink-500 rounded-full mx-auto mt-1"></div>
                            @endif
                        </div>
                        @php $currentDate->addDay(); @endphp
                    @endwhile
                </div>

                @if($selectedDate)
                    <div class="mt-4 p-3 bg-purple-50 rounded-lg">
                        <p class="text-sm text-purple-700">
                            <strong>{{ $selectedDate->format('M d, Y') }}</strong><br>
                            {{ $this->getEventsCountForSelectedDate() }} events scheduled
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Latest Upcoming Events -->
    <div class="mt-8 bg-white rounded-xl shadow-sm p-4 lg:p-6 hover:shadow-md transition-shadow">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-purple-100 pb-4 mb-6">
            <div>
                <h2 class="text-lg lg:text-xl text-purple-800">Latest Upcoming Events</h2>
                <p class="text-sm text-purple-500 mt-1">Next {{ $perPage }} events scheduled</p>
            </div>
        </div>

        @if($upComingBookings->count() > 0)
            <div class="space-y-4">
                @foreach ($upComingBookings as $booking)
                    <div class="flex flex-col sm:flex-row items-start sm:items-center py-4 border-b border-purple-50 hover:bg-purple-50 transition rounded-lg px-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white font-2xl mr-0 sm:mr-4 mb-3 sm:mb-0">
                            {{ substr($booking->eventPackage->name ?? 'Event', 0, 1) }}
                        </div>
                        <div class="flex-grow">
                            <div class=" text-purple-800 text-lg">{{ $booking->eventPackage->name ?? 'N/A' }}</div>
                            <div class="text-sm text-purple-500 mt-1">
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
                            <button class="px-4 py-2 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition font-medium text-sm">
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
                <div class="mx-auto w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-purple-700 mb-2">No Upcoming Events</h3>
                <p class="text-purple-500">There are no upcoming events scheduled at the moment.</p>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @script
    <script>
        // Global chart instance for updates
        window.revenueChart = null;
        window.chartInitialized = false;
        
        // Revenue Chart initialization - Production Ready
        function initializeRevenueChart() {
            const ctx = document.getElementById('revenueChart');
            const loadingEl = document.getElementById('chartLoading');
            
            if (!ctx) {
                console.error('Canvas element not found');
                return false;
            }

            if (typeof Chart === 'undefined') {
                console.error('Chart.js not loaded');
                if (loadingEl) loadingEl.style.display = 'none';
                ctx.parentElement.innerHTML = '<div class="flex items-center justify-center h-full text-red-500"><div class="text-center"><p class="text-lg font-medium">Chart Library Error</p><p class="text-sm">Please refresh the page</p></div></div>';
                return false;
            }

            const monthlyData = @json($monthlyRevenueData);
            
            // Debug: Check current year display
            console.log('Current year:', new Date().getFullYear());
            console.log('Current month:', new Date().toLocaleDateString('en-US', {month: 'short'}));
            console.log('Chart showing months:', monthlyData.map(item => item.month));
            console.log('Total months displayed:', monthlyData.length);
            
            // Always show chart, even with no data
            const months = monthlyData.map(item => item.month);
            const revenues = monthlyData.map(item => parseFloat(item.revenue) || 0);
            
            // Calculate dynamic scale with future growth in mind
            const maxRevenue = Math.max(...revenues);
            const hasData = maxRevenue > 0;
            
            // Dynamic scale calculation for future-proofing
            let suggestedMax;
            if (!hasData) {
                // For empty chart, show a reasonable scale
                suggestedMax = 100000; // 1 Lakh
            } else if (maxRevenue < 10000) {
                suggestedMax = 25000; // 25K
            } else if (maxRevenue < 50000) {
                suggestedMax = Math.ceil(maxRevenue * 1.5 / 10000) * 10000; // Round to nearest 10K with 50% buffer
            } else if (maxRevenue < 100000) {
                suggestedMax = Math.ceil(maxRevenue * 1.4 / 25000) * 25000; // Round to nearest 25K with 40% buffer
            } else if (maxRevenue < 500000) {
                suggestedMax = Math.ceil(maxRevenue * 1.3 / 50000) * 50000; // Round to nearest 50K with 30% buffer
            } else {
                suggestedMax = Math.ceil(maxRevenue * 1.2 / 100000) * 100000; // Round to nearest 1L with 20% buffer
            }

            try {
                // Hide loading indicator
                if (loadingEl) {
                    loadingEl.style.display = 'none';
                }
                
                // Destroy existing chart if it exists
                if (window.revenueChart) {
                    window.revenueChart.destroy();
                }
                
                // Create gradient based on data availability
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
                if (hasData) {
                    gradient.addColorStop(0, 'rgba(236, 72, 153, 0.2)');
                    gradient.addColorStop(1, 'rgba(236, 72, 153, 0.05)');
                } else {
                    gradient.addColorStop(0, 'rgba(156, 163, 175, 0.1)');
                    gradient.addColorStop(1, 'rgba(156, 163, 175, 0.02)');
                }
                
                window.revenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Revenue (₹)',
                            data: revenues,
                            borderColor: hasData ? 'rgb(236, 72, 153)' : 'rgb(156, 163, 175)',
                            backgroundColor: gradient,
                            borderWidth: hasData ? 3 : 2,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: hasData ? 'rgb(236, 72, 153)' : 'rgb(156, 163, 175)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: hasData ? 6 : 4,
                            pointHoverRadius: hasData ? 8 : 6,
                            pointHoverBackgroundColor: hasData ? 'rgb(219, 39, 119)' : 'rgb(107, 114, 128)',
                            pointHoverBorderColor: '#fff',
                            pointHoverBorderWidth: 3,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: hasData,
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                borderColor: hasData ? 'rgb(236, 72, 153)' : 'rgb(156, 163, 175)',
                                borderWidth: 1,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        if (context.parsed.y === 0) {
                                            return 'No revenue data';
                                        }
                                        return 'Revenue: ₹' + context.parsed.y.toLocaleString('en-IN');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: suggestedMax,
                                ticks: {
                                    color: hasData ? '#9333ea' : '#9ca3af',
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        if (value === 0) return '₹0';
                                        if (value >= 100000) {
                                            return '₹' + (value / 100000).toFixed(value % 100000 === 0 ? 0 : 1) + 'L';
                                        } else if (value >= 1000) {
                                            return '₹' + (value / 1000).toFixed(value % 1000 === 0 ? 0 : 1) + 'K';
                                        }
                                        return '₹' + value.toLocaleString('en-IN');
                                    }
                                },
                                grid: {
                                    color: hasData ? 'rgba(147, 51, 234, 0.1)' : 'rgba(156, 163, 175, 0.1)',
                                    borderColor: hasData ? 'rgba(147, 51, 234, 0.2)' : 'rgba(156, 163, 175, 0.2)'
                                },
                                border: {
                                    color: hasData ? 'rgba(147, 51, 234, 0.2)' : 'rgba(156, 163, 175, 0.2)'
                                }
                            },
                            x: {
                                ticks: {
                                    color: hasData ? '#9333ea' : '#9ca3af',
                                    font: {
                                        size: 11
                                    }
                                },
                                grid: {
                                    display: false
                                },
                                border: {
                                    color: hasData ? 'rgba(147, 51, 234, 0.2)' : 'rgba(156, 163, 175, 0.2)'
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        elements: {
                            point: {
                                hoverRadius: hasData ? 8 : 6
                            }
                        },
                        // Add animation for better UX
                        animation: {
                            duration: hasData ? 1000 : 500,
                            easing: 'easeInOutQuart'
                        }
                    }
                });
                
                // Add empty state indicator if no data
                if (!hasData) {
                    const chartArea = window.revenueChart.chartArea;
                    const centerX = (chartArea.left + chartArea.right) / 2;
                    const centerY = (chartArea.top + chartArea.bottom) / 2;
                    
                    // Add text overlay for empty state
                    const emptyStatePlugin = {
                        id: 'emptyState',
                        afterDraw: function(chart) {
                            if (!hasData) {
                                const ctx = chart.ctx;
                                ctx.save();
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';
                                ctx.fillStyle = '#9ca3af';
                                ctx.font = 'bold 16px Inter, sans-serif';
                                ctx.fillText('No revenue data available', centerX, centerY - 10);
                                ctx.font = '12px Inter, sans-serif';
                                ctx.fillText('Chart will populate as bookings are made', centerX, centerY + 15);
                                ctx.restore();
                            }
                        }
                    };
                    
                    Chart.register(emptyStatePlugin);
                }
                
                window.chartInitialized = true;
                console.log('Chart initialized successfully. Has data:', hasData, 'Max scale:', suggestedMax);
                return true;
                
            } catch (error) {
                console.error('Error creating chart:', error);
                if (loadingEl) loadingEl.style.display = 'none';
                ctx.parentElement.innerHTML = '<div class="flex items-center justify-center h-full text-red-500"><div class="text-center"><p class="text-lg font-medium">Chart Error</p><p class="text-sm">' + error.message + '</p></div></div>';
                return false;
            }
        }

        // Chart update function for real-time updates
        function updateChartData() {
            if (window.revenueChart && window.chartInitialized) {
                // Re-fetch data and update chart
                $wire.call('$refresh').then(() => {
                    setTimeout(initializeRevenueChart, 100);
                });
            }
        }

        // Initialize chart with proper timing
        let initAttempts = 0;
        const maxAttempts = 3;

        function tryInitializeChart() {
            if (window.chartInitialized || initAttempts >= maxAttempts) {
                return;
            }
            
            initAttempts++;
            
            if (initializeRevenueChart()) {
                console.log('Revenue chart ready');
            } else {
                setTimeout(tryInitializeChart, 300);
            }
        }

        // Start initialization
        setTimeout(tryInitializeChart, 100);

        // Re-initialize on Livewire navigation
        document.addEventListener('livewire:navigated', function() {
            if (!window.chartInitialized) {
                setTimeout(tryInitializeChart, 200);
            }
        });

        // Listen for data updates
        if (typeof Livewire !== 'undefined') {
            Livewire.on('chartDataUpdated', () => {
                updateChartData();
            });
        }
    </script>
    @endscript
</div>
