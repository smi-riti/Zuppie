<?php

namespace App\Livewire\Admin\Booking;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\User;
use App\Models\EventPackage;
use Livewire\WithPagination;

class ManageBooking extends Component
{
    use WithPagination;

    // Modal control properties
    public $showCreateModal = false;
    public $showUpdateModal = false;
    public $confirmingDeletion = false;
    public $bookingIdToUpdate;
    public $bookingIdToDelete;

    // Search and filter properties
    public $search = '';
    public $statusFilter = '';
    public $userFilter = '';
    public $packageFilter = '';
    
    protected $listeners = [
        'bookingCreated' => 'handleBookingCreated',
        'bookingUpdated' => 'handleBookingUpdated',
        'closeModal' => 'closeModals',
    ];

    public function openCreateModal()
    {
        $this->showCreateModal = true;
    }

    public function openUpdateModal($bookingId)
    {
        $this->bookingIdToUpdate = $bookingId;
        $this->showUpdateModal = true;
    }

    public function confirmDelete($bookingId)
    {
        $this->bookingIdToDelete = $bookingId;
        $this->confirmingDeletion = true;
    }

    public function deleteBooking()
    {
        Booking::findOrFail($this->bookingIdToDelete)->delete();
        
        $this->confirmingDeletion = false;
        $this->bookingIdToDelete = null;
        
        session()->flash('message', 'Booking deleted successfully!');
    }

    public function handleBookingCreated()
    {
        $this->showCreateModal = false;
        session()->flash('message', 'Booking created successfully!');
    }

    public function handleBookingUpdated()
    {
        $this->showUpdateModal = false;
        session()->flash('message', 'Booking updated successfully!');
    }

    public function closeModals()
    {
        $this->showCreateModal = false;
        $this->showUpdateModal = false;
        $this->confirmingDeletion = false;
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
        $booking = Booking::findOrFail($bookingId);
        
        if (!in_array($status, ['pending', 'confirmed', 'cancelled'])) {
            return;
        }
        
        $booking->status = $status;
        $booking->save();
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
        
        $bookings = $query->orderBy('event_date', 'desc')->paginate(4);
        
        return view('livewire.admin.booking.manage-booking', [
            'bookings' => $bookings,
            'users' => User::where('is_admin', false)->orderBy('name')->get(),
            'packages' => EventPackage::orderBy('name')->get(),
            'statusOptions' => ['pending', 'confirmed', 'cancelled'],
        ]);
    }
}