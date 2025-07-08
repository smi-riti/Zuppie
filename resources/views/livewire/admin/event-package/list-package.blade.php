<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Event Packages</h2>
    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
    <button wire:click="openCreateModal" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">Create New Package</button>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Discounted Price</th>
                    <th class="px-4 py-2 border">Duration</th>
                    <th class="px-4 py-2 border">Active</th>
                    <th class="px-4 py-2 border">Special</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td class="px-4 py-2 border">{{ $package->name }}</td>
                        <td class="px-4 py-2 border">{{ $package->category->name ?? 'None' }}</td>
                        <td class="px-4 py-2 border">₹{{ number_format($package->price, 2) }}</td>
                        <td class="px-4 py-2 border">₹{{ number_format($package->discounted_price, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $package->duration ? $package->duration . ' min' : 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $package->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-2 border">{{ $package->is_special ? 'Yes' : 'No' }}</td>
                        <td class="px-4 py-2 border">
                            <button wire:click="openUpdateModal({{ $package->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <button wire:click="openDeleteModal({{ $package->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $packages->links() }}
    </div>

    @if($showCreateModal)
        <livewire:admin.event-package.create-package />
    @endif

    @if($showUpdateModal)
        <livewire:admin.event-package.update-package :package-id="$packageIdToUpdate" />
    @endif

    @if($showDeleteModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-data="{ show: true }" x-show="show" wire:ignore.self>
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h3 class="text-lg font-medium mb-4">Confirm Delete</h3>
                <p class="mb-4">Are you sure you want to delete this package?</p>
                <div class="flex justify-end">
                    <button wire:click="$set('showDeleteModal', false)" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button wire:click="deletePackage" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>