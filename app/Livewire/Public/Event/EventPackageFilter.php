<?php

namespace App\Livewire\Public\Event;

use App\Models\EventPackage;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class EventPackageFilter extends Component
{
    use WithPagination;

    public $searchQuery = '';
    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $packagesPerPage = 15;
    public $loadMoreCount = 0;

    protected $listeners = [
        'subcategory-selected' => 'handleSubcategorySelected',
        'category-selected' => 'handleCategorySelected'
    ];

    public function mount()
    {
        // Get from URL parameters if available
        $this->selectedCategory = request()->query('category');
        $this->selectedSubCategory = request()->query('subcategory');
    }

    public function handleSubcategorySelected($data)
    {
        $this->selectedCategory = $data['categorySlug'];
        $this->selectedSubCategory = $data['subCategorySlug'];
        $this->loadMoreCount = 0;
    }

    public function handleCategorySelected($data)
    {
        $this->selectedCategory = $data['category'];
        $this->selectedSubCategory = null;
        $this->loadMoreCount = 0;
    }

    public function loadMorePackages()
    {
        $this->loadMoreCount++;
    }

    public function clearFilters()
    {
        $this->selectedCategory = null;
        $this->selectedSubCategory = null;
        $this->searchQuery = '';
        $this->loadMoreCount = 0;
    }

    public function getFilteredPackagesProperty()
    {
        $query = EventPackage::with(['category', 'images'])
            ->where('is_active', true);

        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        if ($this->selectedCategory) {
            $category = Category::where('slug', $this->selectedCategory)->first();

            if ($this->selectedSubCategory) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedSubCategory);
                });
            } else if ($category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $this->selectedCategory)
                        ->orWhere('parent_id', $category->id);
                });
            }
        }

        $totalToShow = $this->packagesPerPage + ($this->loadMoreCount * $this->packagesPerPage);
        return $query->take($totalToShow)->get();
    }

    public function getSimilarPackagesProperty()
    {
        // Only fetch similar packages if filters are applied (category or subcategory is selected)
        if ($this->selectedCategory || $this->selectedSubCategory) {
            return EventPackage::with(['category', 'images'])
                ->where('is_active', true)
                ->where('is_special', true)
                ->take(6)
                ->get();
        }

        // Return empty collection if no filters are applied
        return collect([]);
    }

    public function getHasMorePackagesProperty()
    {
        $currentlyShowing = $this->packagesPerPage + ($this->loadMoreCount * $this->packagesPerPage);
        return EventPackage::where('is_active', true)->count() > $currentlyShowing;
    }

    public function render()
    {
        return view('livewire.public.event.event-package-filter', [
            'packages' => $this->filteredPackages,
            'similarPackages' => $this->similarPackages,
            'hasMorePackages' => $this->hasMorePackages,
        ]);
    }
}