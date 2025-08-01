<?php

namespace App\Livewire\Admin\EventPackage;


use App\Models\EventPackage;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

use App\Helpers\ImageKitHelper;

class ListPackage extends Component
{
    use WithPagination;

    public $showDeleteModal = false;
    public $showViewModal = false;
    public $packageToDelete;
    public $packageIdToView;
    
    // Search and filter properties
    public $search = '';
    public $categoryFilter = '';
    public $categories = [];
    
    // For toggling status
    public $updatingStatus = false;
    public $updatingSpecial = false;

    protected $listeners = [
        'closeViewModal' => 'closeViewModal',
    ];

    public function createPackage()
    {
        return redirect()->route('admin.event-packages.create');
    }

    public function editPackage($packageId)
    {
        return redirect()->route('admin.event-packages.edit', $packageId);
    }

    public function openViewModal($packageId)
    {
        $this->packageIdToView = $packageId;
        $this->showViewModal = true;
    }

    public function openDeleteModal($packageId)
    {
        $this->packageToDelete = $packageId;
        $this->showDeleteModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
    }

    public function deletePackage()
    {
        $package = EventPackage::with('images')->findOrFail($this->packageToDelete);
        $package->delete();
        
        $this->showDeleteModal = false;
        session()->flash('message', 'Package deleted successfully!');
    }
    // Reset pagination when filters change
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }
    
    // Toggle package active status
    public function toggleActive($packageId)
    {
        $this->updatingStatus = true;
        $package = EventPackage::findOrFail($packageId);
        $package->is_active = !$package->is_active;
        $package->save();
        $this->updatingStatus = false;
    }
    
    // Toggle package special status
    public function toggleSpecial($packageId)
    {
        $this->updatingSpecial = true;
        $package = EventPackage::findOrFail($packageId);
        $package->is_special = !$package->is_special;
        $package->save();
        $this->updatingSpecial = false;
    }
    
    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = EventPackage::query()
            ->with(['category', 'images']);
            
        // Apply search filter
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }
        
        // Apply category filter
        if (!empty($this->categoryFilter)) {
            $query->where('category_id', $this->categoryFilter);
        }
        
        // Make sure we're using an integer for pagination
        $perPage = 5;
        
        return view('livewire.admin.event-package.list-package', [
            'packages' => $query->orderBy('created_at', 'desc')->paginate($perPage),
            'categories' => $this->categories,
        ]);
    }
}