<div>
   <div x-data="{ isWishlisted: @entangle('isWishlisted'), isLoading: false }" class="relative inline-block">
    <button id="submitReview"
        wire:click="toggle" 
        @click="isLoading = true; setTimeout(() => isLoading = false, 1000)" 
        class="relative flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 transform hover:scale-110 focus:outline-none group"
        :class="{ 'pointer-events-none': isLoading }"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-75"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <!-- Heart Icon -->
        <template x-if="!isLoading">
            <span x-show="isWishlisted" 
                  class="text-2xl animate-pulse group-hover:animate-bounce"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 scale-50"
                  x-transition:enter-end="opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-200"
                  x-transition:leave-start="opacity-100 scale-100"
                  x-transition:leave-end="opacity-0 scale-50">
                <i class="fa-solid fa-heart text-2xl  text-zuppie-pink-600"></i>
            </span>
        </template>
        <template x-if="!isLoading">
            <span x-show="!isWishlisted"
                  class="text-2xl group-hover:animate-pulse"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 scale-50"
                  x-transition:enter-end="opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-200"
                  x-transition:leave-start="opacity-100 scale-100"
                  x-transition:leave-end="opacity-0 scale-50">
                <i class="fa-regular fa-heart text-black"></i>
            </span>
        </template>

        <!-- Spinner -->
        <template x-if="isLoading">
            <span class="text-2xl animate-spin">
    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="10" stroke="url(#gradient)" stroke-width="2" stroke-linecap="round" opacity="0.3"></circle>
        <path d="M12 2a10 10 0 0110 10" stroke="url(#gradient)" stroke-width="2" stroke-linecap="round" opacity="1"></path>
        <defs>
            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#9333EA;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
            </linearGradient>
        </defs>
    </svg>
</span>
        </template>
    </button>
</div>

<!-- Alpine.js Setup -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('wishlistButton', () => ({
        isWishlisted: false,
        isLoading: false,
    }));
});
</script>

<!-- Tailwind CSS Custom Animation -->
<style>
.animate-pulse {
    animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
.animate-bounce {
    animation: bounce 0.6s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}
.animate-spin {
    animation: spin 1s linear infinite;
}
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
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