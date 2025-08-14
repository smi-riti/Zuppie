<div class="">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 transition-opacity duration-300"
        wire:click="closeAllReviewsModal"></div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-50 mt-10 flex items-center  justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-lg sm:max-w-xl">
            <!-- Modal Content -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300">
                <!-- Close Button -->
                <button wire:click="closeAllReviewsModal"
                    class="absolute top-3 right-3 text-pink-500 hover:text-pink-700 transition-colors duration-200 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Profile Edit Form -->
                <div
                    class="p-6 sm:p-8 space-y-6 overflow-y-scroll h-[40rem] bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl">
                    <h2 class="text-2xl font-semibold text-purple-900">All Reviews</h2>
                    <!-- Reviews List -->
                    <div class="space-y-8 ">
                        @foreach ($reviews as $review)
                            <div class="p-6 border border-purple-100 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                            <span
                                                class="text-purple-600 font-medium">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                        </div>
                                        <h3 class="font-semibold text-purple-900">{{ $review->user->name }}
                                        </h3>
                                    </div>
                                    <span class="text-sm text-pink-600">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>

                                <div class="flex items-center mb-3">
                                    <div class="flex mr-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="fa-solid fa-star text-sm mr-0.5" style="color: #9333ea;"></i>
                                            @else
                                                <i class="fa-regular fa-star text-sm mr-0.5" style="color: #d8b4fe;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-xs bg-pink-100 text-pink-800 px-2 py-1 rounded-full">Verified
                                        Purchase</span>
                                </div>

                                <p class="text-gray-700 mb-4">
                                    {{ $review->comment ?? 'This user did not leave a comment' }}
                                </p>
                            </div>

                        @endforeach
                        @if ($reviews->count() < $totalReviews)
                            <div class="flex items-center justify-center">
                                <button wire:click="loadMore" wire:loading.attr="disabled"
                                    class="text-orange-500 font-semibold text-center transition-colors">
                                    <span wire:loading.remove>Load More...</span>
                                    <span wire:loading>
                                        Loading...
                                        <i class="fa-solid fa-spinner fa-spin ml-1"></i>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</div>