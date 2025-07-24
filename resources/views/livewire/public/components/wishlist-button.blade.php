<div>
    <!-- resources/views/livewire/wishlist-button.blade.php -->
    <button wire:click="toggle" class="focus:outline-none">
        @if($isWishlisted)
            <i class="fa-solid fa-heart text-red-500 text-2xl"></i>
        @else
            <i class="fa-regular fa-heart text-2xl"></i>
        @endif
    </button>

    <!-- Loading indicator -->
    <div wire:loading wire:target="toggle">
        <i class="fas fa-spinner fa-spin text-2xl"></i>
    </div>
</div>