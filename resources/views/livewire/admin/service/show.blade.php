<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-purple-800">Services Management</h1>
            <p class="mt-2 text-purple-600">Manage your pin code services</p>
        </div>

        <!-- Flash Message -->
        @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg animate-pulse max-w-7xl mx-auto">
                <div class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Panel - Create/Edit Form -->
             <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden h-full">
                    <div class="p-4 bg-gradient-to-r from-purple-400 to-pink-400">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                            <h2 class="text-xl font-bold text-white">Service List</h2>
                            <div class="relative w-full sm:w-64">
                                <input 
                                    wire:model.live.debounce.300ms="search"
                                    type="text" 
                                    placeholder="Search pin codes..."
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-purple-300 bg-white bg-opacity-20 text-white placeholder-purple-200 focus:border-white focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-colors"
                                >
                                <svg class="w-5 h-5 absolute left-3 top-2.5 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Pin Code</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-purple-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($services as $service)
                                <tr class="@if($editingId == $service->id) bg-purple-50 @else hover:bg-purple-50 @endif transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            {{ $service->pin_code }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button 
                                            wire:click="editService({{ $service->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3 inline-flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            wire:click="deleteService({{ $service->id }})" 
                                            class="text-red-600 hover:text-red-900 inline-flex items-center"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="mt-4 text-purple-700 font-medium">No services found</p>
                                            <p class="text-gray-600 mt-1">Create your first pin code service</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($services->hasPages())
                        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Right Panel - Service List -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg p-6 h-full">
                    <h2 class="text-xl font-bold text-purple-700 mb-4 pb-2 border-b border-purple-100">
                        {{ $formTitle }}
                    </h2>
                    
                    <form wire:submit.prevent="saveService">
                        <div class="mb-4">
                            <label for="pin_code" class="block text-sm font-medium text-gray-700 mb-1">
                                Pin Code
                            </label>
                            <input 
                                wire:model="pin_code" 
                                id="pin_code"
                                type="text" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 transition-colors"
                                placeholder="Enter pin code"
                                autofocus
                            >
                            @error('pin_code') 
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex space-x-3 mt-6">
                            @if($editingId)
                                <button 
                                    type="button"
                                    wire:click="resetForm"
                                    class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors"
                                >
                                    Cancel Edit
                                </button>
                            @endif
                            <button 
                                type="submit"
                                class="flex-1 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-pink-500 border border-transparent rounded-lg shadow-sm hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors"
                            >
                                {{ $editingId ? 'Update Service' : 'Create Service' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

           
        </div>
    </div>
</div>