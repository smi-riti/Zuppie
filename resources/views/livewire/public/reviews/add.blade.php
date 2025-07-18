<div class="p-6 mt-14 bg-white rounded-lg shadow-sm max-w-lg mx-auto">
    @if (session('message'))
        <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 font-semibold border border-green-200">
            {{ session('message') }}
        </div>
    @endif
    <h2 class="text-xl font-bold text-purple-700 mb-4">Leave a Review</h2>
    <form class="space-y-5" wire:submit.prevent="submitReview">
        <div>
            <label class="block text-sm font-medium text-purple-700 mb-1">Rating</label>
            <div class="flex flex-row-reverse justify-end">
                <input type="radio" id="star5" name="rating" value="5" class="hidden peer" wire:model="rating" />
                <label for="star5"
                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4" class="hidden peer" wire:model="rating" />
                <label for="star4"
                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3" class="hidden peer" wire:model="rating" />
                <label for="star3"
                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2" class="hidden peer" wire:model="rating" />
                <label for="star2"
                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1" class="hidden peer" wire:model="rating" />
                <label for="star1"
                    class="cursor-pointer text-2xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400">&#9733;</label>
                @error('rating')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Comment -->
        <div>
            <label for="comment" class="block text-sm font-medium text-purple-700 mb-1">Your
                Review</label>
            <textarea id="comment" wire:model.live="comment" rows="3"
                class="w-full px-3 py-2 border border-purple-100 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-purple-300 bg-white text-purple-900"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-purple-700 mb-1">Add Images</label>
            <input type="file" accept="image/*" multiple wire:model="images"
                class="block w-full text-sm text-purple-700 border border-purple-100 rounded-lg shadow-sm">
            <div class="flex flex-wrap gap-2 mt-2">
                @if($images)
                    @foreach($images as $image)
                        <img src="{{ $image->temporaryUrl() }}"
                            class="h-24 w-24 object-cover rounded border border-pink-200 shadow" alt="Preview">
                    @endforeach
                @endif
            </div>
            @error('images.*')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" id="submitReview"
            class="w-full bg-pink-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg shadow transition">
            Submit Review
        </button>
    </form>
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