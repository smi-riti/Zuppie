<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use App\Models\EventPackage;
use Livewire\WithPagination; 
class ManageBooking extends Component
{
    use WithPagination;

    public $showViewModal = false;
    public $showDeleteModal = false;
    public $bookingToDelete;
    public $bookingIdToView;
    
    // Search and filter properties
    public $search = '';
    public $statusFilter = '';
    public $userFilter = '';
    public $packageFilter = '';
    
    // For toggling status
    public $updatingStatus = false;

    protected $listeners = [
        'bookingUpdated' => '$refresh',
        'closeViewModal' => 'closeViewModal',
    ];

    public function openViewModal($bookingId)
    {
        $this->bookingIdToView = $bookingId;
        $this->showViewModal = true;
    }

    public function openDeleteModal($bookingId)
    {
        $this->bookingToDelete = $bookingId;
        $this->showDeleteModal = true;
    }
    
    public function closeViewModal()
    {
        $this->showViewModal = false;
    }

    public function deleteBooking()
    {
        $booking = Booking::findOrFail($this->bookingToDelete);
        $booking->delete();
        
        $this->showDeleteModal = false;
        session()->flash('message', 'Booking deleted successfully!');
    }

    // Reset pagination when filters change
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatingUserFilter()
    {
        $this->resetPage();
    }
    
    public function updatingPackageFilter()
    {
        $this->resetPage();
    }
    
    // Update booking status
    public function updateStatus($bookingId, $status)
    {
        $this->updatingStatus = true;
        $booking = Booking::findOrFail($bookingId);
        
        if (!in_array($status, ['pending', 'confirmed', 'cancelled'])) {
            $this->updatingStatus = false;
            return;
        }
        
        $booking->status = $status;
        $booking->save();
        $this->updatingStatus = false;
    }
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Booking::query()
            ->with(['user', 'eventPackage.category']);
            
            
        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('location', 'like', '%' . $this->search . '%')
                  ->orWhere('special_requests', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('phone_no', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('eventPackage', function($packageQuery) {
                      $packageQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }
        
        // Apply status filter
        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }
        
        // Apply user filter
        if (!empty($this->userFilter)) {
            $query->where('user_id', $this->userFilter);
        }
        
        // Apply package filter
        if (!empty($this->packageFilter)) {
            $query->where('event_package_id', $this->packageFilter);
        }
        
        $perPage = 5;
        
        return view('livewire.admin.booking.manage-booking', [
            'bookings' => $query->orderBy('event_date', 'desc')->paginate($perPage),
            'users' => User::where('is_admin', false)->orderBy('name')->get(),
            'packages' => EventPackage::orderBy('name')->get(),
            'statusOptions' => ['pending', 'confirmed', 'cancelled'],
        ]);
    }
}



