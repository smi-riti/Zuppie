<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Category;
use App\Models\EventPackage;
use Livewire\WithPagination; 
class ManageBooking extends Component
{
    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'perPage' => ['except' => 10]
    ];
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $bookings = Booking::with(['user', 'category', 'eventPackage'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('email', 'like', '%'.$this->search.'%');
                })
                ->orWhere('location', 'like', '%'.$this->search.'%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->categoryFilter, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('id', $this->categoryFilter);
                });
            })
            ->orderBy('event_date', 'desc')
            ->paginate($this->perPage);

        $categories = Category::all();
        $statuses = ['pending', 'confirmed', 'cancelled', 'completed'];

        return view('livewire.admin.booking.manage-booking', [
            'bookings' => $bookings,
            'categories' => $categories,
            'statuses' => $statuses
        ]);
    }
}

