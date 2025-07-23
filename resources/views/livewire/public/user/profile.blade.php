<div class="min-h-screen bg-gradient-to-br pt-10 from-slate-50 via-white to-purple-50">

    {{-- Loading Component for Payment Processing --}}
    @if($isProcessingPayment)
        <livewire:components.loader 
            message="Processing payment..." 
            size="large" 
            type="spinner" />
    @endif

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

                    <button wire:click="openEditProfileModal({{ auth()->id() }})"
                        class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Profile
                    </button>
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
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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

                                        <div class="grid md:grid-cols-5 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}
                                                </p>
                                                @if($booking->event_time)
                                                    <p class="text-gray-600 text-sm">
                                                        {{ \Carbon\Carbon::parse($booking->event_time)->format('h:i A') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$booking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount Details</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    Total: ₹{{ number_format($booking->eventPackage->price, 2) }}
                                                </p>
                                                <p class="text-green-600 text-sm">
                                                    After Discount: ₹{{ number_format($this->getTotalAmountAfterDiscount($booking), 2) }}
                                                </p>
                                                <p class="text-blue-600 text-sm">
                                                    Paid: ₹{{ number_format($this->getTotalPaidAmount($booking), 2) }}
                                                </p>
                                                @if($this->hasUnpaidBalance($booking))
                                                    <p class="text-orange-600 text-sm font-semibold">
                                                        Due: ₹{{ number_format($this->getDueAmount($booking), 2) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Payment</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    {{ $this->getPaymentMethod($booking) }}
                                                </p>
                                                <p class="text-sm 
                                                    @if($this->getPaymentStatus($booking) === 'paid') text-green-600
                                                    @elseif($this->getPaymentStatus($booking) === 'pending') text-yellow-600
                                                    @else text-red-600
                                                    @endif">
                                                    {{ ucfirst($this->getPaymentStatus($booking)) }}
                                                </p>
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

                                                @if ($booking->status === 'confirmed')
                                                    <button wire:click="downloadInvoice({{ $booking->id }})"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Download Invoice
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
                                                        <i class="fas fa-star mr-2"></i>
                                                        Leave Review
                                                    </button>
                                                </div>
                                            @else
                                                @if($this->hasUnpaidBalance($booking))
                                                    <div class="text-right">
                                                        <p class="text-orange-600 font-semibold text-sm">
                                                            Balance: ₹{{ number_format($this->getBalanceAmount($booking)) }}
                                                        </p>
                                                        <button wire:click="initiatePayment({{ $booking->id }})"
                                                            class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1 shadow-md border-2 border-orange-600"
                                                            style="background-color: #f97316 !important; color: white !important; min-height: 32px;">
                                                            <i class="fas fa-credit-card mr-1"></i>
                                                            Pay Now
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="text-right">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                            <i class="fas fa-clock mr-2"></i>
                                                            Event Pending
                                                        </span>
                                                    </div>
                                                @endif
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
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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

                                        <div class="grid md:grid-cols-5 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($upBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                @if($upBooking->event_time)
                                                    <p class="text-gray-600 text-sm">
                                                        {{ \Carbon\Carbon::parse($upBooking->event_time)->format('h:i A') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$upBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount Details</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    Total: ₹{{ number_format($upBooking->eventPackage->price, 2) }}
                                                </p>
                                                <p class="text-green-600 text-sm">
                                                    After Discount: ₹{{ number_format($this->getTotalAmountAfterDiscount($upBooking), 2) }}
                                                </p>
                                                <p class="text-blue-600 text-sm">
                                                    Paid: ₹{{ number_format($this->getTotalPaidAmount($upBooking), 2) }}
                                                </p>
                                                @if($this->hasUnpaidBalance($upBooking))
                                                    <p class="text-orange-600 text-sm font-semibold">
                                                        Due: ₹{{ number_format($this->getDueAmount($upBooking), 2) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Payment</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    {{ $this->getPaymentMethod($upBooking) }}
                                                </p>
                                                <p class="text-sm 
                                                    @if($this->getPaymentStatus($upBooking) === 'paid') text-green-600
                                                    @elseif($this->getPaymentStatus($upBooking) === 'pending') text-yellow-600
                                                    @else text-red-600
                                                    @endif">
                                                    {{ ucfirst($this->getPaymentStatus($upBooking)) }}
                                                </p>
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
                                                @if($this->hasUnpaidBalance($upBooking))
                                                    <div class="text-right">
                                                        <p class="text-orange-600 font-semibold text-sm">
                                                            Balance: ₹{{ number_format($this->getBalanceAmount($upBooking)) }}
                                                        </p>
                                                        <button wire:click="initiatePayment({{ $upBooking->id }})"
                                                            class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1 shadow-md border-2 border-orange-600"
                                                            style="background-color: #f97316 !important; color: white !important; min-height: 32px;">
                                                            <i class="fas fa-credit-card mr-1"></i>
                                                            Pay Now
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="text-right">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                            <i class="fas fa-clock mr-2"></i>
                                                            Event Pending
                                                        </span>
                                                    </div>
                                                @endif
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
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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

                                        <div class="grid md:grid-cols-5 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($pastBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                @if($pastBooking->event_time)
                                                    <p class="text-gray-600 text-sm">
                                                        {{ \Carbon\Carbon::parse($pastBooking->event_time)->format('h:i A') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$pastBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount Details</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    Total: ₹{{ number_format($pastBooking->eventPackage->price, 2) }}
                                                </p>
                                                <p class="text-green-600 text-sm">
                                                    After Discount: ₹{{ number_format($this->getTotalAmountAfterDiscount($pastBooking), 2) }}
                                                </p>
                                                <p class="text-blue-600 text-sm">
                                                    Paid: ₹{{ number_format($this->getTotalPaidAmount($pastBooking), 2) }}
                                                </p>
                                                @if($this->hasUnpaidBalance($pastBooking))
                                                    <p class="text-orange-600 text-sm font-semibold">
                                                        Due: ₹{{ number_format($this->getDueAmount($pastBooking), 2) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Payment</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    {{ $this->getPaymentMethod($pastBooking) }}
                                                </p>
                                                <p class="text-sm 
                                                    @if($this->getPaymentStatus($pastBooking) === 'paid') text-green-600
                                                    @elseif($this->getPaymentStatus($pastBooking) === 'pending') text-yellow-600
                                                    @else text-red-600
                                                    @endif">
                                                    {{ ucfirst($this->getPaymentStatus($pastBooking)) }}
                                                </p>
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
                                                @if($this->hasUnpaidBalance($pastBooking))
                                                    <div class="text-right">
                                                        <p class="text-orange-600 font-semibold text-sm">
                                                            Balance: ₹{{ number_format($this->getBalanceAmount($pastBooking)) }}
                                                        </p>
                                                        <button wire:click="initiatePayment({{ $pastBooking->id }})"
                                                            class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm font-semibold hover:bg-orange-600 transition-all duration-300 mt-1 shadow-md border-2 border-orange-600"
                                                            style="background-color: #f97316 !important; color: white !important; min-height: 32px;">
                                                            <i class="fas fa-credit-card mr-1"></i>
                                                            Pay Now
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="text-right">
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                            <i class="fas fa-check-circle mr-2"></i>
                                                            Event Past
                                                        </span>
                                                    </div>
                                                @endif
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
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
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

                                        <div class="grid md:grid-cols-5 gap-4 mb-6">
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Event Date & Time</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($cancelBooking->event_date)->format('M d, Y') }}
                                                </p>
                                                @if($cancelBooking->event_time)
                                                    <p class="text-gray-600 text-sm">
                                                        {{ \Carbon\Carbon::parse($cancelBooking->event_time)->format('h:i A') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Guests</p>
                                                <p class="font-semibold text-gray-800">
                                                    {{$cancelBooking->guest_count ?? 'not provided'}}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Amount Details</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    Total: ₹{{ number_format($cancelBooking->eventPackage->price, 2) }}
                                                </p>
                                                <p class="text-green-600 text-sm">
                                                    After Discount: ₹{{ number_format($this->getTotalAmountAfterDiscount($cancelBooking), 2) }}
                                                </p>
                                                <p class="text-blue-600 text-sm">
                                                    Paid: ₹{{ number_format($this->getTotalPaidAmount($cancelBooking), 2) }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600 text-sm font-medium">Payment</p>
                                                <p class="font-semibold text-gray-800 text-sm">
                                                    {{ $this->getPaymentMethod($cancelBooking) }}
                                                </p>
                                                <p class="text-sm text-red-600">Cancelled</p>
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


    @if ($showEditProfileModal)
        <livewire:public.user.edit-profile-modal :user-id="$userIdToEdit" />
    @endif
    @if($showViewModal)
        <livewire:public.user.my-package-modal :booking-id="$bookingIdToView" />
    @endif

    @if ($showReviewModal)
        <livewire:public.user.review-modal :package-id="$packageIdToReview" />
    @endif

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if Razorpay is available
            if (typeof Razorpay === 'undefined') {
                console.error('Razorpay script not loaded properly');
            } else {
                console.log('Razorpay script loaded successfully');
            }
        });

        // Listen for Livewire events
        document.addEventListener('livewire:init', () => {
            // Listen for Razorpay payment initiation
            Livewire.on('initiate-razorpay-payment', (data) => {
                console.log('Received payment initiation event:', data);
                if (data && data.length > 0) {
                    initiateRazorpayPayment(data[0]);
                } else {
                    console.error('No payment data received');
                    alert('Payment initialization failed. Please try again.');
                }
            });
        });

        function initiateRazorpayPayment(paymentData) {
            console.log('Initiating Razorpay payment with data:', paymentData);
            
            // Validate payment data
            if (!paymentData || !paymentData.order_id || !paymentData.amount) {
                console.error('Invalid payment data:', paymentData);
                alert('Payment data is invalid. Please try again.');
                return;
            }

            const options = {
                key: '{{ config("services.razorpay.key") }}',
                amount: paymentData.amount,
                currency: paymentData.currency || 'INR',
                name: 'Zuppie',
                description: 'Balance Payment for Booking #' + paymentData.booking_id,
                order_id: paymentData.order_id,
                prefill: {
                    name: paymentData.customer_name || '',
                    email: paymentData.customer_email || '',
                    contact: paymentData.customer_phone || ''
                },
                theme: {
                    color: '#8B5CF6'
                },
                handler: function(response) {
                    console.log('Payment successful:', response);
                    // Call Livewire method to complete payment
                    @this.call('completeRazorpayPayment', 
                        response.razorpay_payment_id,
                        response.razorpay_order_id,
                        response.razorpay_signature
                    );
                },
                modal: {
                    ondismiss: function() {
                        console.log('Payment modal closed');
                        alert('Payment was cancelled. Please try again if needed.');
                    }
                }
            };

            try {
                const rzp = new Razorpay(options);
                rzp.open();
            } catch (error) {
                console.error('Failed to open Razorpay:', error);
                alert('Failed to open payment gateway. Please try again.');
            }
        }
    </script>
</div>