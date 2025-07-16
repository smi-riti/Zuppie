<?php

namespace App\Livewire\Public\Event;

use Livewire\Component;
use App\Models\EventPackage as EventPackageModel;
use App\Models\Category;

class EventPackage extends Component
{
    public $searchQuery = '';
    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $showCategoryModal = false;
    public $modalCategory = null;
    public $packagesPerPage = 15;
    public $loadMoreCount = 0;

    public function mount()
    {
        // Initialize component
    }

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->selectedSubCategory = null;
        $this->loadMoreCount = 0;
        $this->closeCategoryModal();
        $this->dispatch('category-selected', ['category' => $category]);
    }

    public function openCategoryModal($categorySlug)
    {
        $this->modalCategory = Category::where('slug', $categorySlug)->first();
        $this->showCategoryModal = true;
    }

    public function closeCategoryModal()
    {
        $this->showCategoryModal = false;
        $this->modalCategory = null;
    }

    public function selectSubCategory($categorySlug, $subCategorySlug)
    {
        $this->selectedCategory = $categorySlug;
        $this->selectedSubCategory = $subCategorySlug;
        $this->loadMoreCount = 0;
        $this->closeCategoryModal();
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
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        // Category filter
        if ($this->selectedCategory) {
            if ($this->selectedSubCategory) {
                // Filter by subcategory and also include parent category packages
                $query->whereHas('category', function($q) {
                    $parentCategory = Category::where('slug', $this->selectedCategory)->first();
                    $subCategory = Category::where('slug', $this->selectedSubCategory)->first();
                    
                    if ($parentCategory && $subCategory) {
                        $q->where('slug', $this->selectedSubCategory)
                          ->orWhere('id', $parentCategory->id);
                    }
                });
            } else {
                // Filter by main category and its subcategories
                $query->whereHas('category', function($q) {
                    $category = Category::where('slug', $this->selectedCategory)->first();
                    if ($category) {
                        $q->where('slug', $this->selectedCategory)
                          ->orWhere('parent_id', $category->id);
                    }
                });
            }
        }

        $totalToShow = $this->packagesPerPage + ($this->loadMoreCount * $this->packagesPerPage);
        $packages = $query->take($totalToShow)->get();

        return $packages->map(function($package) {
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
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('description', 'like', '%' . $this->searchQuery . '%');
            });
        }

        if ($this->selectedCategory) {
            if ($this->selectedSubCategory) {
                $query->whereHas('category', function($q) {
                    $q->where('slug', $this->selectedSubCategory);
                });
            } else {
                $query->whereHas('category', function($q) {
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

        return $packages->map(function($package) {
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
        // Only show similar packages when there's a search or category selection
        if (!$this->searchQuery && !$this->selectedCategory) {
            return collect([]);
        }

        $query = EventPackageModel::with(['category', 'images'])
            ->where('is_active', true);

        // Get packages from the same category as selected category
        if ($this->selectedCategory) {
            $category = Category::where('slug', $this->selectedCategory)->first();
            if ($category) {
                $query->whereHas('category', function($q) use ($category) {
                    $q->where('id', $category->id)
                      ->orWhere('parent_id', $category->id);
                });
            }
        } else {
            // If no category selected but there's a search, show popular packages
            $query->where('is_special', true);
        }

        $packages = $query->take(6)->get();

        return $packages->map(function($package) {
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
        return view('livewire.public.event.event-package');
    }
}
