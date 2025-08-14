<div>
    <div class="fixed inset-0 bg-white/80 text-black z-40 transition-opacity" wire:click="closeModal"></div>
    <div>
        <h1>All Reviews</h1>
        <div class="bg-yellow-500">
            <div class="space-y-8">
                @foreach ($reviews as $review)
                    <div class="p-6 border border-purple-100 rounded-lg hover:shadow-md transition-shadow">
                        {{ $review->comment }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>