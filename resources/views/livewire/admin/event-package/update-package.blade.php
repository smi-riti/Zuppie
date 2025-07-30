<div class="min-h-screen bg-gradient-to-br from-zuppie-50 via-zuppie-pink-50 to-indigo-50 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.event-packages') }}" 
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Packages
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Update Package</h1>
                        <p class="text-gray-600 mt-1">Modify package details and settings</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-green-800">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <!-- Scrollable Form Container -->
        <div class="max-h-[80vh] overflow-y-auto pr-2 space-y-8 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            <form wire:submit.prevent="update" id="update-package-form" class="space-y-8">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Basic Information Section -->
                    <div class="bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Basic Information
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Row 1: Name and Category -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Package Name* 
                                    <span class="text-gray-500 font-normal">(Slug: {{ $package->slug ?? 'auto-generated' }})</span>
                                </label>
                                <input type="text" wire:model.live="name"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                       placeholder="Enter package name">
                                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select wire:model.live="category_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    <!-- Row 3: Price and Discount -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price (₹)*</label>
                            <input type="number" step="0.01" wire:model.live="price"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                   placeholder="0.00">
                            @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discount Type</label>
                            <select wire:model.live="discount_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors">
                                <option value="">No Discount</option>
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed Amount (₹)</option>
                            </select>
                            @error('discount_type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discount Value</label>
                            <input type="number" step="0.01" wire:model.live="discount_value"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                   placeholder="0.00"
                                   {{ empty($discount_type) ? 'disabled' : '' }}>
                            @error('discount_value') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Row 4: Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                        <div class="grid grid-cols-2 gap-4 max-w-md">
                            <div>
                                <input type="number" wire:model.live="duration_hours" min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                       placeholder="Hours">
                                <label class="text-xs text-gray-500 mt-1">Hours</label>
                            </div>
                            <div>
                                <input type="number" wire:model.live="duration_minutes" min="0" max="59"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                       placeholder="Minutes">
                                <label class="text-xs text-gray-500 mt-1">Minutes</label>
                            </div>
                        </div>
                        @error('duration_hours') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        @error('duration_minutes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Description & Features Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-info-600 to-indigo-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Description & Features
                    </h2>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model.live="description" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors"
                                  placeholder="Enter package description..."></textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Features with Rich Text Editor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                        <div wire:ignore>
                            <div id="features-editor" style="height: 200px;"></div>
                            <input type="hidden" id="features-content" wire:model="features">
                        </div>
                        @error('features') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Package Images
                    </h2>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Existing Images -->
                    @if(count($packageImages) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($packageImages as $image)
                                    <div class="relative group">
                                        <img src="{{ $image['image_url'] }}" alt="Package Image" 
                                             class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                        <button type="button" wire:click="confirmDeleteImage({{ $image['id'] }})"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors opacity-0 group-hover:opacity-100">
                                            ×
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Images -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Add New Images</label>
                        <input type="file" wire:model.live="newImages" multiple
                               class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-zuppie-500 focus:border-zuppie-500 transition-colors text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-zuppie-50 file:text-zuppie-700 hover:file:bg-zuppie-100">
                        <p class="text-xs text-gray-500 mt-2">Accepted formats: JPG, PNG, GIF, SVG, WEBP. Max 2MB per file.</p>
                        @error('newImages.*') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

                        @if($newImages)
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($newImages as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" 
                                             class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                        <button type="button" wire:click="$set('newImages.{{ $index }}', null)"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                            ×
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Package Settings
                    </h2>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Active Status Toggle -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Active Status</label>
                                <p class="text-xs text-gray-500">Package will be visible to customers</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" wire:model.live="is_active" 
                                       class="sr-only" id="is_active">
                                <label for="is_active" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full transition-colors duration-200 {{ $is_active ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform duration-200 {{ $is_active ? 'transform translate-x-6' : '' }}"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Special Status Toggle -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Special Package</label>
                                <p class="text-xs text-gray-500">Mark as featured/popular package</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" wire:model.live="is_special" 
                                       class="sr-only" id="is_special">
                                <label for="is_special" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <div class="block bg-gray-300 w-14 h-8 rounded-full transition-colors duration-200 {{ $is_special ? 'bg-zuppie-500' : 'bg-gray-300' }}"></div>
                                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition-transform duration-200 {{ $is_special ? 'transform translate-x-6' : '' }}"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <button type="submit" 
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600 text-white rounded-lg hover:from-zuppie-700 hover:to-zuppie-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Package
            </button>
        </form>
    </div>

    <!-- Fixed Action Buttons at Bottom -->
    <div class="mt-6 flex justify-between items-center bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <a href="{{ route('admin.event-packages') }}" 
           class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Cancel
        </a>
        
        <button type="submit" form="update-package-form"
                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600 text-white rounded-lg hover:from-zuppie-700 hover:to-zuppie-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Update Package
        </button>
    </div>
</div>

    <!-- Delete Image Confirmation Modal -->
    @if($showDeleteImageModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50" 
             wire:click.self="$set('showDeleteImageModal', false)">
            <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Delete Image</h3>
                        <p class="text-sm text-gray-500">Are you sure you want to delete this image? This action cannot be undone.</p>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button wire:click="$set('showDeleteImageModal', false)" 
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                    <button wire:click="removeImage" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif


<!-- Include Quill CSS and JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.Quill) {
        const quill = new Quill('#features-editor', {
            theme: 'snow',
            placeholder: 'Enter package features...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Update Livewire property when content changes
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            document.getElementById('features-content').value = content;
            @this.set('features', content);
        });

        // Set initial content if exists
        const initialContent = @this.features || '';
        if (initialContent) {
            quill.root.innerHTML = initialContent;
        }
    }
});
</script>

<!-- Custom Scrollbar Styles -->
<style>
    .scrollbar-thin {
        scrollbar-width: thin;
    }
    .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 6px;
    }
    .scrollbar-track-gray-100::-webkit-scrollbar-track {
        background-color: #f3f4f6;
    }
    .scrollbar-thin::-webkit-scrollbar {
        width: 8px;
    }
</style>
</div>