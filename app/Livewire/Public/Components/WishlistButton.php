<?php

namespace App\Livewire\Public\Components;

use App\Services\WishlistService;
use Livewire\Component;

class WishlistButton extends Component
{

    public $packageId;
    public $isWishlisted = false;
    protected $wishlistService;

    public function boot(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function mount($packageId)
    {
        $this->packageId = $packageId;
        $this->isWishlisted = $this->wishlistService->isWishlisted($packageId);
    }

    public function toggle()
    {
        $result = $this->wishlistService->toggleWishlist($this->packageId);

        if ($result['status'] === 'login_required') {
            return redirect()->route('login');
        }

        $this->isWishlisted = !$this->isWishlisted;
        $this->dispatch('wishlist-updated');
    }
    public function render()
    {
        return view('livewire.public.components.wishlist-button');
    }
}
