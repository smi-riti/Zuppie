<div class="min-h-screen bg-gradient-to-br from-zuppie-50 to-zuppie-pink-50 p-4 sm:p-6">
    <div class="">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zuppie-800">User Management</h1>
            <p class="text-zuppie-600">Manage all registered users</p>
        </div>

        <!-- Search and Actions -->
        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
            <div class="relative w-full sm:w-96">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search users..." 
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-zuppie-200 focus:ring-2 focus:ring-zuppie-300 focus:border-zuppie-400 transition"
                >
                <div class="absolute left-3 top-2.5 text-zuppie-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zuppie-100">
                    <thead class="bg-zuppie-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zuppie-700 uppercase tracking-wider">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-zuppie-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-zuppie-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-zuppie-400 to-zuppie-pink-400 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-zuppie-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zuppie-800">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-zuppie-800">{{ $user->phone_no ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_admin ? 'bg-zuppie-100 text-zuppie-800' : 'bg-zuppie-pink-100 text-zuppie-pink-800' }}">
                                        {{ $user->is_admin ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-zuppie-600">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-zuppie-600">
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 bg-zuppie-50 border-t border-zuppie-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>