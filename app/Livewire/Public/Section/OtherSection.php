<?php

namespace App\Livewire\Public\Section;

use App\Models\EventPackage;
use Livewire\Component;

class OtherSection extends Component
{
    public function render()
    {
        // Get 6 event packages (first special ones, then regular ones)
        $packages = EventPackage::with(['category', 'images'])
            ->where('is_active', true)
            ->orderByDesc('is_special')
            ->orderBy('created_at')
            ->limit(6)
            ->get();
        return view('livewire.public.section.other-section', [
            'packages' => $packages,
        ]);
    }
}
