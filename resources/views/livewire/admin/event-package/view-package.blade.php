<div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50" x-data="{ show: true }" x-show="show" x-transition wire:ignore.self>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-4xl p-6 max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">Package Details</h3>
                    <p class="text-sm text-gray-500">View and manage package information</p>
                </div>
            </div>
            <button wire:click="closeViewModal" class="text-gray-400 hover:text-gray-700 focus:outline-none transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        @endif

        <!-- Package Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h4 class="font-semibold text-lg text-gray-700 mb-5 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Basic Information
                </h4>
                
                <div class="space-y-4">
                    <div class="border-b border-gray-100 pb-3">
                        <span class="block text-sm font-medium text-gray-500 mb-1">Name</span>
                        <span class="block text-base font-medium text-gray-900">{{ $package->name }}</span>
                    </div>
                    
                    <div class="border-b border-gray-100 pb-3">
                        <span class="block text-sm font-medium text-gray-500 mb-1">Category</span>
                        <span class="block text-base text-gray-900">{{ $package->category->name ?? 'None' }}</span>
                    </div>
                    
                    <div class="border-b border-gray-100 pb-3">
                        <span class="block text-sm font-medium text-gray-500 mb-1">Price</span>
                        <span class="block text-base text-gray-900 font-medium">₹{{ number_format($package->price, 2) }}</span>
                    </div>
                    
                    @if($package->discount_type)
                        <div class="border-b border-gray-100 pb-3">
                            <span class="block text-sm font-medium text-gray-500 mb-1">Discount</span>
                            <div>
                                <span class="text-base text-gray-900">
                                    {{ $package->discount_type === 'percentage' ? $package->discount_value . '%' : '₹' . number_format($package->discount_value, 2) }}
                                </span>
                                <span class="text-sm text-green-600 font-medium ml-2">
                                    Final:₹{{ number_format($package->discounted_price, 2) }}
                                </span>
                            </div>
                        </div>
                    @endif
                    
                    <div class="border-b border-gray-100 pb-3">
                        <span class="block text-sm font-medium text-gray-500 mb-1">Duration</span>
                        <span class="block text-base text-gray-900">{{ $package->formatted_duration }}</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <span class="block text-sm font-medium text-gray-500 mb-2">Status</span>
                            <div class="flex items-center">
                                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                    <div class="block w-10 h-6 bg-gray-200 rounded-full shadow-inner {{ $package->is_active ? 'bg-green-400' : 'bg-gray-300' }}"></div>
                                    <div class="absolute inset-y-0 left-0 w-6 h-6 bg-white rounded-full shadow transform transition-transform {{ $package->is_active ? 'translate-x-full border-green-400' : 'border-gray-300' }}"></div>
                                </div>
                                <span class="ml-2 text-sm {{ $package->is_active ? 'text-green-600 font-medium' : 'text-gray-500' }}">
                                    {{ $package->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <span class="block text-sm font-medium text-gray-500 mb-2">Special</span>
                            <div class="flex items-center">
                                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                    <div class="block w-10 h-6 bg-gray-200 rounded-full shadow-inner {{ $package->is_special ? 'bg-purple-400' : 'bg-gray-300' }}"></div>
                                    <div class="absolute inset-y-0 left-0 w-6 h-6 bg-white rounded-full shadow transform transition-transform {{ $package->is_special ? 'translate-x-full border-purple-400' : 'border-gray-300' }}"></div>
                                </div>
                                <span class="ml-2 text-sm {{ $package->is_special ? 'text-purple-600 font-medium' : 'text-gray-500' }}">
                                    {{ $package->is_special ? 'Special' : 'Regular' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h4 class="font-semibold text-lg text-gray-700 mb-5 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                    Description
                </h4>
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                    <p class="text-gray-800 whitespace-pre-wrap leading-relaxed">{!! $package->description ?: 'No description available.' !!}</p>
                </div>
            </div>
        </div>
        
        <!-- Package Images -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h4 class="font-semibold text-lg text-gray-700 mb-5 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Package Images
                <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ count($package->images) }} {{ count($package->images) == 1 ? 'image' : 'images' }}</span>
            </h4>
            
            @if(count($package->images) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach($package->images as $image)
                        <div class="relative group transition transform hover:scale-105 duration-200">
                            <img src="{{ $image->image_url }}" alt="{{ $package->name }}" 
                                 class="w-full h-48 object-cover rounded-lg shadow-md border border-gray-200">
                            
                            <!-- Image Actions Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 
                                        rounded-lg flex items-center justify-center space-x-2 transition-all duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-3 flex justify-center space-x-3">
                                    <a href="{{ $image->image_url }}" target="_blank" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-lg shadow-lg flex items-center transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="ml-1 text-xs">View</span>
                                    </a>
                                    <button wire:click="confirmDeleteImage({{ $image->id }})" 
                                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg shadow-lg flex items-center transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        <span class="ml-1 text-xs">Delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-8 rounded-lg text-center border border-dashed border-gray-300">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-4 text-gray-500">No images available for this package</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="flex justify-end mt-8 pt-5 border-t border-gray-200">
            <button wire:click="closeViewModal" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Close
            </button>
        </div>

        <!-- Delete Image Confirmation Modal -->
        @if($showDeleteImageModal)
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-[60]" 
                 wire:click.self="$set('showDeleteImageModal', false)">
                <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md p-6 overflow-y-auto transform transition-all animate-fade-in">
                    <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Delete Image
                        </h3>
                        <button wire:click="$set('showDeleteImageModal', false)" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="p-4 mb-5 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-200">
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            This image will be soft deleted and can be restored later.
                        </p>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button wire:click="$set('showDeleteImageModal', false)" 
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </button>
                        <button wire:click="deleteImage" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
