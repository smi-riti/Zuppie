<?php
namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    /**
     * Check if a package is in the user's wishlist
     */
    public function isWishlisted(int $packageId): bool
    {
        if (!Auth::check()) return false;
        
        return Wishlist::where('user_id', Auth::id())
            ->where('event_package_id', $packageId)
            ->exists();
    }

    /**
     * Toggle wishlist status for a package
     */
    public function toggleWishlist(int $packageId): array
    {
        if (!Auth::check()) {
            return ['status' => 'login_required'];
        }

        if ($this->isWishlisted($packageId)) {
            $this->removeFromWishlist($packageId);
            return ['status' => 'removed'];
        }

        $this->addToWishlist($packageId);
        return ['status' => 'added'];
    }

    /**
     * Add a package to wishlist
     */
    public function addToWishlist(int $packageId): void
    {
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'event_package_id' => $packageId,
        ]);
    }

    /**
     * Remove a package from wishlist
     */
    public function removeFromWishlist(int $packageId): void
    {
        Wishlist::where('user_id', Auth::id())
            ->where('event_package_id', $packageId)
            ->delete();
    }

    /**
     * Get wishlist statuses for multiple packages at once
     */
    public function getWishlistStatuses(array $packageIds): array
    {
        if (!Auth::check()) {
            return array_fill_keys($packageIds, false);
        }

        return Wishlist::where('user_id', Auth::id())
            ->whereIn('event_package_id', $packageIds)
            ->pluck('event_package_id')
            ->mapWithKeys(fn($id) => [$id => true])
            ->toArray();
    }

    /**
     * Get all wishlisted package IDs for current user
     */
    public function getUserWishlist(): array
    {
        if (!Auth::check()) {
            return [];
        }

        return Wishlist::where('user_id', Auth::id())
            ->pluck('event_package_id')
            ->toArray();
    }
}