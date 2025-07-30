<div>
    <!-- Backdrop - Faster fade -->
    <div x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40" wire:click="closeReviewModal">
    </div>

    <!-- Modal Container - Faster scale animation -->
    <div x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
        class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click.stop>

        <div class="relative mx-auto w-full max-w-4xl origin-center transform">
            <!-- Modal Content -->
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden" wire:click.stop>
                <!-- Close button -->
                <button wire:click="closeReviewModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-zuppie-600 transition-colors z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Content Area -->
                <div class="p-6 md:p-8 space-y-6 max-h-[80vh] overflow-y-auto bg-gray-50 rounded-lg shadow-sm">
                    <form class="space-y-5" wire:submit.prevent="submitReview">
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-1">Rating</label>
                            <div class="flex flex-row-reverse justify-end">
                                <input type="radio" id="star5" name="rating" value="5" class="hidden peer"
                                    wire:model="rating" />
                                <label for="star5"
                                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4" class="hidden peer"
                                    wire:model="rating" />
                                <label for="star4"
                                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3" class="hidden peer"
                                    wire:model="rating" />
                                <label for="star3"
                                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2" class="hidden peer"
                                    wire:model="rating" />
                                <label for="star2"
                                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1" class="hidden peer"
                                    wire:model="rating" />
                                <label for="star1"
                                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                                @error('rating')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Comment -->
                        <div>
                            <label for="comment" class="block text-sm font-medium text-zuppie-700 mb-1">Your
                                Review</label>
                            <textarea id="comment" wire:model.live="comment" rows="3"
                                class="w-full px-3 py-2 border border-zuppie-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-zuppie-pink-200 focus:border-zuppie-300 bg-white text-zuppie-900"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zuppie-700 mb-1">Add Images</label>
                            <input type="file" accept="image/*" multiple wire:model="images"
                                class="block w-full text-sm text-zuppie-700 border border-zuppie-100 rounded-lg shadow-sm">
                            <div class="flex flex-wrap gap-2 mt-2">
                                @if($images)
                                    @foreach($images as $image)
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="h-24 w-24 object-cover rounded border border-zuppie-pink-200 shadow" alt="Preview">
                                    @endforeach
                                @endif
                            </div>
                            @error('images.*')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" id="submitReview"
                            class="w-full bg-zuppie-pink-500 hover:bg-zuppie-600 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- excitment styles -->
    <style>
        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .success-message {
            animation: bounceIn 0.5s ease-out;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</div>