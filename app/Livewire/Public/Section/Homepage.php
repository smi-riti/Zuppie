<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
use App\Models\Category; 

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

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.public.section.homepage');
    }
}