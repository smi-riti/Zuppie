<?php

namespace App\Livewire\Public\Section;

use App\Models\EventPackage;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class Homepage extends Component
{
    public $upcomingEvents = [
        [
            'title' => 'Tech Conference 2023',
            'date' => '2023-11-15',
            'location' => 'San Francisco, CA',
            'description' => 'Annual technology conference featuring the latest innovations.',
            'category' => 'Technology'
        ],
        [
            'title' => 'Music Festival',
            'date' => '2023-12-05',
            'location' => 'Austin, TX',
            'description' => 'Three days of live music from top artists around the world.',
            'category' => 'Music'
        ],
        [
            'title' => 'Business Summit',
            'date' => '2023-10-20',
            'location' => 'New York, NY',
            'description' => 'Networking and learning opportunities for business professionals.',
            'category' => 'Business'
        ]
    ];

    public $categories = [];
    public $packages = [];

    public function mount()
    {
        $this->categories = Category::where('is_special', true)->get();

        $this->packages = EventPackage::with('images')
            ->where('is_active', true)
            ->where('is_special', true)
            ->get();
    }

    public function render()
    {
        return view('livewire.public.section.homepage');
    }
}