<?php

namespace App\Livewire\Public\Section;

use App\Models\EventPackage;
use Livewire\Component;
use App\Traits\HasSettings;
#[Title('Other Section')]

class OtherSection extends Component
{
    use HasSettings;

    public function mount()
    {
        $this->loadSiteSettings();
    }

    public function render()
    {
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