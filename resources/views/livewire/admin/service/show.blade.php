<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-100 p-6">
    <div class="">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-purple-800">Services Management</h1>
            <button 
                wire:click="openCreateModal"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all"
            >
                <span wire:loading.class="hidden">Add New Service</span>
                <span wire:loading>Loading...</span>
            </button>
        </div>

        @if(session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('message') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-purple-400 to-pink-400 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pin Code</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($services as $service)
                    <tr class="hover:bg-purple-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $service->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-600">{{ $service->pin_code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button 
                                wire:click="openCreateModal({{ $service->id }})"
                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                            >
                                Edit
                            </button>
                            <button 
                                wire:click="deleteService({{ $service->id }})" 
                                class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to delete this service?')"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>

    @if($showModal)
        <div class="fixed inset-0 z-[1000] overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
                <div class="fixed inset-0 bg-black bg-opacity-50" aria-hidden="true"></div>
                <div class="inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white rounded-2xl shadow-xl">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 pb-2 border-b">
                        {{ $editingId ? 'Edit Service' : 'Create New Service' }}
                    </h3>
                    @livewire('admin.service.create', ['editingId' => $editingId], key('create-modal'))
                </div>
            </div>
        </div>
    @endif
</div>