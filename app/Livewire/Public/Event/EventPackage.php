<?php

namespace App\Livewire\Public\Event;

use App\Models\Wishlist;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\EventPackage as EventPackageModel;
use App\Models\Category;

class EventPackage extends Component
{

    public $searchQuery = '';
    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $packagesPerPage = 15;
    public $loadMoreCount = 0;
    public $showAllCategoriesMode = false;
    protected $listeners = [
        'subcategory-selected' => 'handleSubcategorySelected'
    ];
    
     public $wishlistStatus = [];
    protected $wishlistService;

    public function boot(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function mount()
    {
        $this->selectedCategory = request()->query('category');
        $this->selectedSubCategory = request()->query('subcategory');

        $this->packages = $this->filteredPackages;
        
        // Initialize wishlist statuses
        $packageIds = collect($this->packages)->pluck('id')->toArray();
        $this->wishlistStatus = $this->wishlistService->getWishlistStatuses($packageIds);
    }
    public function toggleWishlist($packageId)
    {
        $result = $this->wishlistService->toggleWishlist($packageId);
        
        if ($result['status'] === 'login_required') {
            return redirect()->route('login');
        }
        
        // Update local status
        $this->wishlistStatus[$packageId] = !($this->wishlistStatus[$packageId] ?? false);
    }

    public function handleSubcategorySelected($data)
    {
        $this->selectedCategory = $data['categorySlug'];
        $this->selectedSubCategory = $data['subCategorySlug'];
        $this->loadMoreCount = 0; // Reset pagination
    }



    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->selectedSubCategory = null;
        $this->loadMoreCount = 0;
        $this->dispatch('category-selected', ['category' => $category]);
    }

    public function openCategoryModal($categorySlug)
    {
        $this->dispatch('openCategoryModal', categorySlug: $categorySlug);
    }



    public function loadMorePackages()
    {
        $this->loadMoreCount++;
    }

    public function showAllCategories()
    {
        $this->selectedCategory = null;
        $this->selectedSubCategory = null;
        $this->loadMoreCount = 0;
        $this->showAllCategoriesMode = !$this->showAllCategoriesMode;
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
        $this->loadMoreCount = 0;
    }

    public function getFilteredPackagesProperty()
    {
        $query = EventPackageModel::with(['category', 'images'])
            ->where('is_active', true);

        // Search filter
        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        // Category filter
        if ($this->selectedCategory) {
            $category = Category::where('slug', $this->selectedCategory)->first();

            if ($this->selectedSubCategory) {
                // Filter by specific subcategory
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedSubCategory);
                });
            } else if ($category) {
                // Filter by main category and its subcategories
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $this->selectedCategory)
                        ->orWhere('parent_id', $category->id);
                });
            }
        }

        $totalToShow = $this->packagesPerPage + ($this->loadMoreCount * $this->packagesPerPage);
        return $query->take($totalToShow)->get()->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->discounted_price,
                'original_price' => $package->price,
                'description' => $package->description,
                'duration' => $package->formatted_duration,
                'category' => $package->category->name ?? 'General',
                'image' => $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop',
                'features' => [
                    'Professional Event Planning',
                    'Venue Decoration',
                    'Photography Services',
                    'Catering Coordination',
                    'Entertainment Management'
                ],
                'rating' => rand(40, 50) / 10,
                'popular' => $package->is_special
            ];
        })->toArray();
    }

    public function getTotalPackagesCountProperty()
    {
        $query = EventPackageModel::where('is_active', true);

        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        if ($this->selectedCategory) {
            if ($this->selectedSubCategory) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedSubCategory);
                });
            } else {
                $query->whereHas('category', function ($q) {
                    $category = Category::where('slug', $this->selectedCategory)->first();
                    if ($category) {
                        $q->where('slug', $this->selectedCategory)
                            ->orWhere('parent_id', $category->id);
                    }
                });
            }
        }

        return $query->count();
    }

    public function getHasMorePackagesProperty()
    {
        $currentlyShowing = $this->packagesPerPage + ($this->loadMoreCount * $this->packagesPerPage);
        return $this->totalPackagesCount > $currentlyShowing;
    }

    public function getFeaturedPackagesProperty()
    {
        $packages = EventPackageModel::with(['category', 'images'])
            ->where('is_active', true)
            ->where('is_special', true)
            ->take(6)
            ->get();

        return $packages->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->discounted_price,
                'description' => $package->description,
                'image' => $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop',
                'features' => [
                    'Premium Event Planning',
                    'Luxury Venue Setup',
                    'Professional Photography',
                    'Gourmet Catering',
                    'Live Entertainment'
                ]
            ];
        })->toArray();
    }

    public function getCategoriesProperty()
    {
        // Get only special categories for main display (limit to 9)
        $categories = Category::where('is_special', true)
            ->whereNull('parent_id')
            ->take(9)
            ->get();

        $categoryData = [];
        foreach ($categories as $category) {
            $categoryData[$category->slug] = [
                'name' => $category->name,
                'icon' => $this->getCategoryIcon($category->slug),
                'image' => $category->image,
                'has_subcategories' => $category->children()->exists()
            ];
        }

        return $categoryData;
    }

    public function getDisplayCategoriesProperty()
    {
        if ($this->showAllCategoriesMode) {
            // Show all categories (both special and non-special)
            return Category::with('children')
                ->whereNull('parent_id')
                ->get();
        } else {
            // Show only special categories (existing behavior)
            return Category::where('is_special', true)
                ->whereNull('parent_id')
                ->take(9)
                ->get();
        }
    }

    public function getAllCategoriesProperty()
    {
        // Get all categories with their subcategories for modal
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();

        return $categories;
    }

    public function getCategoryIcon($slug)
    {
        $icons = [
            'birthday' => 'fas fa-birthday-cake',
            'wedding-anniversary' => 'fas fa-heart',
            'festival' => 'fas fa-star',
            '1st-birthday' => 'fas fa-baby',
            'haldi-mehndi' => 'fas fa-flower',
            'premium-decoration' => 'fas fa-crown',
            'flower-bouquet' => 'fas fa-seedling',
            'gift-section' => 'fas fa-gift',
            'love-theme' => 'fas fa-heart',
            'bride-to-be' => 'fas fa-ring'
        ];

        return $icons[$slug] ?? 'fas fa-star';
    }

    public function getSimilarPackagesProperty()
    {
        // Show similar packages when there's a search, category selection, or no packages found
        if (!$this->searchQuery && !$this->selectedCategory && count($this->filteredPackages) > 0) {
            return collect([]);
        }

        $query = EventPackageModel::with(['category', 'images'])
            ->where('is_active', true);

        // Get packages from the same category as selected category
        if ($this->selectedCategory) {
            $category = Category::where('slug', $this->selectedCategory)->first();
            if ($category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('id', $category->id)
                        ->orWhere('parent_id', $category->id);
                });
            }
        } else {
            // If no category selected but there's a search, or no packages found, show popular packages
            $query->where('is_special', true);
        }

        $packages = $query->take(6)->get();

        return $packages->map(function ($package) {
            return [
                'id' => $package->id,
                'name' => $package->name,
                'price' => $package->discounted_price,
                'original_price' => $package->price,
                'description' => $package->description,
                'duration' => $package->formatted_duration,
                'category' => $package->category->name ?? 'General',
                'image' => $package->images->first()->image_url ?? 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?w=400&h=300&fit=crop',
                'features' => [
                    'Professional Event Planning',
                    'Venue Decoration',
                    'Photography Services',
                    'Catering Coordination',
                    'Entertainment Management'
                ],
                'rating' => rand(40, 50) / 10,
                'popular' => $package->is_special
            ];
        });
    }


    public function render()
    {
        return view('livewire.public.event.event-package', [
            'featuredPackages' => $this->featuredPackages,
            'categories' => $this->categories,
            'filteredPackages' => $this->filteredPackages,
            'displayCategories' => $this->displayCategories,
            'similarPackages' => $this->similarPackages,
            'hasMorePackages' => $this->hasMorePackages,
            'totalPackagesCount' => $this->totalPackagesCount
        ]);
    }
}
