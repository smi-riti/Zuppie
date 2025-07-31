<div class="p-4 bg-gradient-to-br from-zuppie-50 to-zuppie-pink-50 ">
    <div class="">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-zuppie-800">Event Packages</h2>
                <p class="text-sm text-zuppie-600 mt-1">Manage all your event packages</p>
            </div>
            <a href="{{ route('admin.event-packages.create') }}" class="px-4 py-2 bg-gradient-to-r from-zuppie-500 to-zuppie-pink-500 text-white rounded-lg hover:from-zuppie-600 hover:to-zuppie-pink-600 transition flex items-center shadow-lg">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Package
            </a>
        </div>
        
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        @endif
        
        <!-- Search and Filter Bar -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="relative">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search packages..." 
                       class="pl-10 pr-4 py-2 w-full border border-zuppie-200 rounded-lg focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 bg-white shadow-sm transition">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-zuppie-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="relative">
                <select wire:model="categoryFilter" class="pl-10 pr-4 py-2 w-full border border-zuppie-200 rounded-lg focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 bg-white shadow-sm transition">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-zuppie-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto bg-white rounded-2xl shadow-xl border border-zuppie-100">
            <div class="p-4 border-b border-zuppie-100 bg-gradient-to-r from-zuppie-50 to-zuppie-pink-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-zuppie-700">
                        <span class="font-medium">{{ $packages->total() }}</span> packages found
                        @if(!empty($search) || !empty($categoryFilter))
                            <span class="ml-1">
                                with current filters
                                <button wire:click="$set('search', ''); $set('categoryFilter', '');" class="ml-2 text-zuppie-600 hover:text-zuppie-800 underline text-xs focus:outline-none">
                                    Clear filters
                                </button>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <table class="min-w-full divide-y divide-zuppie-100">
                <thead class="bg-zuppie-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Discounted Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Images</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-zuppie-50">
                    @foreach($packages as $package)
                        <tr class="hover:bg-zuppie-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zuppie-900">{{ $package->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-700">{{ $package->category->name ?? 'None' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-700">₹{{ number_format($package->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-700">₹{{ number_format($package->discounted_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-700">{{ $package->formatted_duration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if (count($package->images) > 0)
                                    <div class="flex space-x-2">
                                        <div class="relative">
                                            <img src="{{ $package->images->first()->image_url }}" alt="Package Image" class="h-14 w-14 object-cover rounded-lg shadow-sm border border-zuppie-200">
                                        </div>
                                        @if (count($package->images) > 1)
                                            <div class="relative">
                                                <img src="{{ $package->images[1]->image_url }}" alt="Package Image" class="h-14 w-14 object-cover rounded-lg shadow-sm border border-zuppie-200">
                                                @if (count($package->images) > 2)
                                                    <div class="absolute -top-2 -right-2 h-6 w-6 bg-zuppie-500 text-white rounded-full flex items-center justify-center text-xs font-semibold shadow">
                                                        +{{ count($package->images) - 2 }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-zuppie-300 italic">No images</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <label class="flex items-center cursor-pointer" wire:click.prevent="toggleActive({{ $package->id }})" wire:loading.class="opacity-50" wire:target="toggleActive({{ $package->id }})">
                                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                                <div class="block w-10 h-6 rounded-full shadow-inner {{ $package->is_active ? 'bg-zuppie-400' : 'bg-zuppie-200' }}"></div>
                                                <div class="absolute inset-y-0 left-0 w-6 h-6 bg-white rounded-full shadow transform transition-transform duration-200 ease-in-out {{ $package->is_active ? 'translate-x-full' : '' }}"></div>
                                            </div>
                                            <span class="text-xs {{ $package->is_active ? 'text-zuppie-700 font-medium' : 'text-zuppie-500' }}">
                                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="flex items-center cursor-pointer" wire:click.prevent="toggleSpecial({{ $package->id }})" wire:loading.class="opacity-50" wire:target="toggleSpecial({{ $package->id }})">
                                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                                <div class="block w-10 h-6 rounded-full shadow-inner {{ $package->is_special ? 'bg-zuppie-pink-400' : 'bg-zuppie-pink-200' }}"></div>
                                                <div class="absolute inset-y-0 left-0 w-6 h-6 bg-white rounded-full shadow transform transition-transform duration-200 ease-in-out {{ $package->is_special ? 'translate-x-full' : '' }}"></div>
                                            </div>
                                            <span class="text-xs {{ $package->is_special ? 'text-zuppie-pink-700 font-medium' : 'text-zuppie-pink-500' }}">
                                                {{ $package->is_special ? 'Special' : 'Regular' }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="openViewModal({{ $package->id }})" class="px-3 py-1.5 bg-zuppie-100 text-zuppie-700 rounded-lg hover:bg-zuppie-200 transition shadow-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </button>
                                    <a href="{{ route('admin.event-packages.edit', $package->id) }}" class="px-3 py-1.5 bg-zuppie-pink-100 text-zuppie-pink-700 rounded-lg hover:bg-zuppie-pink-200 transition shadow-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <button wire:click="openDeleteModal({{ $package->id }})" class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition shadow-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-zuppie-100 bg-gradient-to-r from-zuppie-50 to-zuppie-pink-50">
                {{ $packages->links() }}
            </div>
        </div>
    </div>
    
    <!-- View Modal (keeping only this one) -->
    @if($showViewModal)
        <livewire:admin.event-package.view-package :package-id="$packageIdToView" />
    @endif

    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50" x-data="{ show: true }" x-show="show" x-transition wire:ignore.self>
            <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all animate-fade-in">
                <div class="flex items-center mb-6 pb-3 border-b border-gray-200">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Confirm Delete</h3>
                </div>
                
                <div class="p-4 mb-5 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-200">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Are you sure you want to delete this package? This action will only soft delete the package and it can be restored later.
                    </p>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                    <button wire:click="deletePackage" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>