<div class="min-h-screen bg-gradient-to-br pt-10 from-slate-50 via-white to-purple-50">

    <!-- Profile Section -->
    <section class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Profile Image -->
                    <div class="relative">
                        <div
                            class="w-24 h-24 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white  text-3xl font-bold">
                            {{ substr(auth()->user()->name ?? 'User', 0, 1) }}
                        </div>
                        <div
                            class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 border-4 border-white rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-2xl font-bold text-gray-800">{{ auth()->user()->name}}</h2>
                        <p class="text-gray-600">{{ auth()->user()->email}}</p>

                        <!-- Quick Stats -->
                        <div class="flex justify-center md:justify-start space-x-6 mt-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-800">{{ count($bookings) }}</div>
                                <div class="text-xs text-gray-600">Total Bookings</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ count($completedBookings) ?? 0 }}</div>
                                <div class="text-xs text-gray-600">Completed</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ count($upComingBookings) ?? 0 }}</div>
                                <div class="text-xs text-gray-600">Upcoming Event</div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Actions -->
                    <div class="flex flex-col space-y-3">
                        <button
                            class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profile
                        </button>
                        <button
                            class="border border-gray-300 text-gray-700 px-6 py-2 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300">
                            <i class="fas fa-cog mr-2"></i>
                            Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section x-data="{ activeTab: 'All Bookings' }" class="">
        <!-- Tabs Navigation -->
        <div class="flex max-w-8xl p-2 mx-auto w-fit justify-center bg-white shadow-xl rounded-lg mb-6">
            <template x-for="tab in ['All Bookings', 'Upcoming', 'Past Event','Cancelled']" :key="tab">
                <button @click="activeTab = tab"
                    class="px-3 sm:px-4 md:px-6 py-2 sm:py-3 text-sm sm:text-base md:text-lg focus:outline-none transition-all duration-150 whitespace-nowrap"
                    :class="{
        'font-semibold rounded-lg transition-all duration-300 bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-md': activeTab === tab,
        'text-gray-800': activeTab !== tab
    }" x-text="tab">
                </button>
            </template>
        </div>

        <!-- Tab Content -->
        <div class="p-2">
            <template x-if="activeTab === 'All Bookings'">
                <section class="pb-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="space-y-6">
                            @foreach ($bookings as $booking)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg capitalize">
                                                    {{ substr($booking->eventPackage->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-800">
                                                        {{$booking->eventPackage->name}}
                                                    </h3>
                                                    <p class="text-gray-600">Booking ID: #000{{$booking->id}}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                                                                @if($booking->status == 'confirmed')
                                                                                                                    bg-green-100 text-green-800
                                                                                                                @elseif($booking->status == 'pending')
                                                                                                                    bg-yellow-100 text-yellow-800
                                                                                                                @else
                                                                                                                    bg-red-100 text-red-800
                                                                                                                @endif">

                                                    @if ($booking->status == 'confirmed')
                                                        Confirmed
                                                    @elseif ($booking->status == 'pending')
                                                        Pending
                                                    @elseif ($booking->status == 'cancelled')
                                                        Cancelled
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-4 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    {{ \Carbon\Carbon::parse($booking->event_datetime)->format('h:i A') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$booking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $booking->eventPackage->price }}
                                                </p>
                                                <p class="text-green-600 text-sm">{{ $booking->total_price }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Location</p>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $booking->location }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div class="flex space-x-3">
                                                <button wire:click="openViewModal({{ $booking->id }})"
                                                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </button>

                                                @if ($booking->is_completed == 1)
                                                    <button
                                                        class="border border-purple-300 text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition-all duration-300">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Invoice
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($booking->is_completed == 1)
                                                <div class="flex gap-5 items-center">
                                                    <div
                                                        class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-all duration-300">
                                                        <i class="fas fa-check mr-2"></i>
                                                        Completed
                                                    </div>
                                                    <button wire:click="openReviewModal({{ $booking->eventPackage->id }})"
                                                        class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-all duration-300">
                                                        leave review
                                                    </button>
                                                </div>
                                            @else
                                                <div class="text-right">
                                                    <p class="text-orange-600 font-semibold text-sm">
                                                        Balance: ₹50,000
                                                    </p>
                                                    <button
                                                        class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1">
                                                        Pay Now
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- No Booking State -->
                            @if($bookings->isEmpty())
                                <div class="text-center py-20">
                                    <div
                                        class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-calendar-times text-purple-600 text-3xl"></i>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">No Bookings Found</h2>
                                    <p class="text-gray-600 mb-8">You don't have any bookings yet. Start by exploring our
                                        amazing event
                                        packages.</p>
                                    <a href="{{ route('event-packages') }}"
                                        class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-8 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                        <i class="fas fa-search mr-2"></i>
                                        Browse Packages
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </section>
            </template>
            <template x-if="activeTab === 'Upcoming'">
                <section class="pb-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="space-y-6">
                            @if ($upComingBookings->isEmpty())
                                <div class="text-center text-gray-500">
                                    <p>No cancelled bookings found.</p>
                                </div>
                            @endif
                            @foreach ($upComingBookings as $upBooking)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg capitalize">
                                                    {{ substr($upBooking->eventPackage->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-800">
                                                        {{$upBooking->eventPackage->name}}
                                                    </h3>
                                                    <p class="text-gray-600">Booking ID: #000{{$upBooking->id}}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                                                                @if($upBooking->status == 'confirmed')
                                                                                                                    bg-green-100 text-green-800
                                                                                                                @elseif($upBooking->status == 'pending')
                                                                                                                    bg-yellow-100 text-yellow-800
                                                                                                                @else
                                                                                                                    bg-red-100 text-red-800
                                                                                                                @endif">
                                                    {{$upBooking->status == 'confirmed' ? 'Confirmed' : 'Pending'}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-4 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($upBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    {{ \Carbon\Carbon::parse($upBooking->event_datetime)->format('h:i A') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$upBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $upBooking->eventPackage->price }}
                                                </p>
                                                <p class="text-green-600 text-sm">{{ $upBooking->total_price }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Location</p>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $upBooking->location }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </button>

                                                @if ($upBooking->is_completed == 1)
                                                    <button
                                                        class="border border-purple-300 text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition-all duration-300">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Invoice
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($upBooking->is_completed == 1)
                                                <div
                                                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-all duration-300">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Completed
                                                </div>
                                            @else
                                                <div class="text-right">
                                                    <p class="text-orange-600 font-semibold text-sm">
                                                        Balance: ₹50,000
                                                    </p>
                                                    <button
                                                        class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1">
                                                        Pay Now
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </template>
            <template x-if="activeTab === 'Past Event'">
                <section class="pb-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="space-y-6">
                            @if ($pastBookings->isEmpty())
                                <div class="text-center text-gray-500">
                                    <p>No cancelled bookings found.</p>
                                </div>
                            @endif
                            @foreach ($pastBookings as $pastBooking)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg capitalize">
                                                    {{ substr($pastBooking->eventPackage->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-800">
                                                        {{$pastBooking->eventPackage->name}}
                                                    </h3>
                                                    <p class="text-gray-600">Booking ID: #000{{$pastBooking->id}}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                                                                @if($pastBooking->status == 'confirmed')
                                                                                                                    bg-green-100 text-green-800
                                                                                                                @elseif($pastBooking->status == 'pending')
                                                                                                                    bg-yellow-100 text-yellow-800
                                                                                                                @else
                                                                                                                    bg-red-100 text-red-800
                                                                                                                @endif">
                                                    {{$pastBooking->status == 'confirmed' ? 'Confirmed' : 'Pending'}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-4 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($pastBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    {{ \Carbon\Carbon::parse($pastBooking->event_datetime)->format('h:i A') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$pastBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $pastBooking->eventPackage->price }}
                                                </p>
                                                <p class="text-green-600 text-sm">{{ $pastBooking->total_price }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Location</p>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $pastBooking->location }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </button>

                                                @if ($pastBooking->is_completed == 1)
                                                    <button
                                                        class="border border-purple-300 text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition-all duration-300">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Invoice
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($pastBooking->is_completed == 1)
                                                <div
                                                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-all duration-300">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Completed
                                                </div>
                                            @else
                                                <div class="text-right">
                                                    <p class="text-orange-600 font-semibold text-sm">
                                                        Balance: ₹50,000
                                                    </p>
                                                    <button
                                                        class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1">
                                                        Pay Now
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </template>
            <template x-if="activeTab === 'Cancelled'">
                <section class="pb-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="space-y-6">
                            @if ($cancelledBookings->isEmpty())
                                <div class="text-center text-gray-500">
                                    <p>No cancelled bookings found.</p>
                                </div>
                            @endif
                            @foreach ($cancelledBookings as $cancelBooking)
                                <div
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-lg capitalize">
                                                    {{ substr($cancelBooking->eventPackage->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-800">
                                                        {{$cancelBooking->eventPackage->name}}
                                                    </h3>
                                                    <p class="text-gray-600">Booking ID: #000{{$cancelBooking->id}}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                                                                                @if($cancelBooking->status == 'confirmed')
                                                                                                                    bg-green-100 text-green-800
                                                                                                                @elseif($cancelBooking->status == 'pending')
                                                                                                                    bg-yellow-100 text-yellow-800
                                                                                                                @else
                                                                                                                    bg-red-100 text-red-800
                                                                                                                @endif">
                                                    @if ($cancelBooking->status == 'confirmed')
                                                        Confirmed
                                                    @elseif ($cancelBooking->status == 'pending')
                                                        Pending
                                                    @elseif ($cancelBooking->status == 'cancelled')
                                                        Cancelled
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid md:grid-cols-4 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($cancelBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                <p class="text-gray-600 text-sm">
                                                    {{ \Carbon\Carbon::parse($cancelBooking->event_datetime)->format('h:i A') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$cancelBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $cancelBooking->eventPackage->price }}
                                                </p>
                                                <p class="text-green-600 text-sm">{{ $cancelBooking->total_price }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Location</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    {{ $cancelBooking->location }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div class="flex space-x-3">
                                                <button
                                                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 py-2 rounded-lg font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    View Details
                                                </button>

                                                @if ($cancelBooking->is_completed == 1)
                                                    <button
                                                        class="border border-purple-300 text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition-all duration-300">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Invoice
                                                    </button>
                                                @endif
                                            </div>

                                            @if ($cancelBooking->is_completed == 1)
                                                <div
                                                    class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition-all duration-300">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Completed
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </template>
        </div>
    </section>

    <!-- view booking modal -->
    @if($showViewModal)
        <livewire:public.user.my-package-modal :booking-id="$bookingIdToView" />
    @endif

    @if ($showReviewModal)
        <livewire:public.user.review-modal :package-id="$packageIdToReview" />
    @endif
    <!-- Custom Styles -->
    <style>
        /* Sparkle Animation */
        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            animation: sparkle 3s infinite ease-in-out;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 20%;
        }

        .sparkle:nth-child(2) {
            top: 40%;
            right: 30%;
        }

        .sparkle:nth-child(3) {
            bottom: 30%;
            left: 40%;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Custom Animations */
        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-in-out 0.2s both;
        }

        .animate-zoom-in {
            animation: zoomIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</div>